@php
    $type = session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'warning');
    $message = session($type);
@endphp

{{-- TOAST --}}
<div id="toast"
    class="hidden fixed z-50 top-35 left-1/2 -translate-x-1/2 sm:left-auto sm:translate-x-0 sm:top-28 sm:right-6 border-2 p-3 flex gap-2 items-center transition-opacity duration-500 opacity-0 max-w-xs w-max habit-shadow"
>
    {{-- ICONS (all pre-rendered, JS toggles visibility) --}}
    <div id="toast-icon-success" class="hidden"><x-icons.success /></div>
    <div id="toast-icon-error"   class="hidden"><x-icons.error /></div>
    <div id="toast-icon-warning" class="hidden"><x-icons.warning /></div>

    <p id="toast-message" class="text-sm font-semibold"></p>
</div>

@if (session()->has('success') || session()->has('error') || session()->has('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        mostrarToast("{{ $type }}", "{{ $message }}");
    });
</script>
@endif