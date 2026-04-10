/**
 * Sistema de Gerenciamento de Temas (Dark/Light Mode)
 *
 * O tema é pré-aplicado pelo script inline no <head> do layout.blade.php,
 * eliminando o FOUC (Flash of Unstyled Content) durante a navegação.
 * Este arquivo cuida apenas da lógica do botão de alternância.
 */

function initTheme() {
    const themeToggle = document.getElementById('theme-toggle');
    const darkIcon    = document.getElementById('theme-toggle-dark-icon');
    const lightIcon   = document.getElementById('theme-toggle-light-icon');

    // Sincroniza os ícones com o tema já aplicado pelo script do <head>
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';

    if (currentTheme === 'dark') {
        darkIcon?.classList.remove('hidden');
        lightIcon?.classList.add('hidden');
    } else {
        lightIcon?.classList.remove('hidden');
        darkIcon?.classList.add('hidden');
    }

    if (!themeToggle) return;

    themeToggle.addEventListener('click', () => {
        const isDark   = document.documentElement.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';

        // Aplica o novo tema com transição (o usuário clicou, então a animação é desejada)
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        // Alterna os ícones
        if (newTheme === 'dark') {
            darkIcon?.classList.remove('hidden');
            lightIcon?.classList.add('hidden');
        } else {
            darkIcon?.classList.add('hidden');
            lightIcon?.classList.remove('hidden');
        }

        // Feedback tátil opcional se disponível
        if (window.navigator.vibrate) {
            window.navigator.vibrate(5);
        }
    });
}

document.addEventListener('DOMContentLoaded', initTheme);
window.initTheme = initTheme;
