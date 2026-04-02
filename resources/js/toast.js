const toast = document.getElementById('toast');

setTimeout(() => {
    toast.style.opacity = '0';
    setTimeout(() => {
        toast.remove();
    }, 500);
}, 3500);