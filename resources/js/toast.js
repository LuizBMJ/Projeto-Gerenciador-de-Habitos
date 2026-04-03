let toastTimeout = null;

window.mostrarToast = function(tipo, mensagem) {

    const toast   = document.getElementById('toast');
    const message = document.getElementById('toast-message');

    if (!toast) return;

    const styles = {
        success: 'bg-green-100 border-green-400 text-green-700',
        error:   'bg-red-100 border-red-400 text-red-700',
        warning: 'bg-yellow-100 border-yellow-400 text-yellow-700',
    };

    // cancel previous timeout
    if (toastTimeout) clearTimeout(toastTimeout);

    // remove old styles
    toast.classList.remove(
        'bg-green-100', 'border-green-400', 'text-green-700',
        'bg-red-100',   'border-red-400',   'text-red-700',
        'bg-yellow-100','border-yellow-400','text-yellow-700'
    );

    // apply new style
    toast.classList.add(...styles[tipo].split(' '));

    // hide all icons, show the right one
    ['success', 'error', 'warning'].forEach(t => {
        document.getElementById('toast-icon-' + t).classList.add('hidden');
    });
    document.getElementById('toast-icon-' + tipo).classList.remove('hidden');

    // set message
    message.textContent = mensagem;

    // show
    toast.classList.remove('hidden', 'opacity-0');
    void toast.offsetWidth; // force reflow
    toast.classList.add('opacity-100');

    // auto-hide after 3s
    toastTimeout = setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
        setTimeout(() => toast.classList.add('hidden'), 500);
    }, 3000);
};