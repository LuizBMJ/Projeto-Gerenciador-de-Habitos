<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redireciona para o Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google retorna aqui após o usuário autorizar
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $email    = $googleUser->getEmail();
        $googleId = $googleUser->getId();
        $name     = $googleUser->getName();
        $avatar   = $googleUser->getAvatar();

        // 1. Já existe conta vinculada a esse Google ID? -> Login direto
        $user = User::where('google_id', $googleId)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard.habits.index');
        }

        // 2. Existe conta com o mesmo e-mail?
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            // Já vinculada ao Google (google_id preenchido) -> loga direto e corrige o ID se necessário

            if (!is_null($existingUser->google_id)) {
                $existingUser->update([
                    'google_id'  => $googleId,
                    'avatar_url' => $avatar,
                ]);

                Auth::login($existingUser);
                return redirect()->route('dashboard.habits.index');
            }

            // Conta criada via Google anteriormente (sem senha, sem google_id) -> vincula e loga direto
            if (is_null($existingUser->password)) {
                $existingUser->update([
                    'google_id'  => $googleId,
                    'avatar_url' => $avatar,
                ]);

                Auth::login($existingUser);
                return redirect()->route('dashboard.habits.index');
            }

            // Conta com senha e sem Google vinculado -> pede confirmação antes de vincular
            session([
                'google_pending' => [
                    'google_id'  => $googleId,
                    'email'      => $email,
                    'avatar_url' => $avatar,
                ]
            ]);
            return redirect()->route('auth.google.link');
        }

        // 3. Nenhuma conta encontrada -> Cria conta nova sem senha
        $newUser = User::create([
            'name'       => $name,
            'email'      => $email,
            'google_id'  => $googleId,
            'avatar_url' => $avatar,
            'password'   => null,
        ]);

        Auth::login($newUser);
        return redirect()->route('dashboard.habits.index');
    }

    // Mostra a página de vinculação
    public function showLink()
    {
        if (!session('google_pending')) {
            return redirect()->route('site.login');
        }

        return view('auth.link-account', [
            'email' => session('google_pending.email')
        ]);
    }

    // Processa a vinculação (verifica senha e salva google_id)
    public function link(Request $request)
    {
        $pending = session('google_pending');

        if (!$pending) {
            return redirect()->route('site.login');
        }

        $user = User::where('email', $pending['email'])->first();

        if (!$user) {
            return redirect()->route('site.login');
        }

        $request->validate([
            'password' => 'required|string',
        ]);

        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Senha incorreta.']);
        }

        // Vincula o Google à conta existente
        $user->update([
            'google_id'  => $pending['google_id'],
            'avatar_url' => $pending['avatar_url'],
        ]);

        session()->forget('google_pending');

        Auth::login($user);
        return redirect()->route('dashboard.habits.index');
    }
}