(function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    let activeCell = null;

    function formatDateBR(dateStr) {
        const [year, month, day] = dateStr.split('-').map(Number);
        const date = new Date(year, month - 1, day);
        return date.toLocaleDateString('pt-BR', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    function showLoading(show) {
        const loading = document.getElementById('day-detail-loading');
        const list    = document.getElementById('day-detail-list');
        if (show) {
            loading.classList.remove('hidden');
            loading.classList.add('flex');
            list.classList.add('hidden');
        } else {
            loading.classList.add('hidden');
            loading.classList.remove('flex');
            list.classList.remove('hidden');
        }
    }

    window.closeDayDetail = function () {
        document.getElementById('day-detail-panel').classList.add('hidden');
        if (activeCell) {
            activeCell.classList.remove('ring-2', 'ring-brand-orange');
            activeCell = null;
        }
    };

    function escapeHtml(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    document.querySelectorAll('[data-date]').forEach(function (cell) {
        cell.addEventListener('click', function () {

            const date  = cell.dataset.date;
            const count = parseInt(cell.dataset.count, 10);

            if (count === 0) {
                mostrarToast('error', 'Nenhum hábito concluído neste dia.');
                window.closeDayDetail();
                return;
            }

            if (activeCell === cell) {
                window.closeDayDetail();
                return;
            }

            if (activeCell) activeCell.classList.remove('ring-2', 'ring-brand-orange');
            activeCell = cell;
            cell.classList.add('ring-2', 'ring-brand-orange');

            const panel = document.getElementById('day-detail-panel');
            document.getElementById('day-detail-date').textContent = formatDateBR(date);
            panel.classList.remove('hidden');
            showLoading(true);

            fetch('/dashboard/habits/historico/day?date=' + date, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(res => res.json())
            .then(function (habits) {
                showLoading(false);
                const list = document.getElementById('day-detail-list');
                list.innerHTML = '';

                habits.forEach(function (habit) {
                    const li = document.createElement('li');
                    li.className = 'habit-day-item';
                    li.innerHTML =
                        '<span class="habit-day-dot"></span>' +
                        '<span>' + escapeHtml(habit.name) + '</span>';
                    list.appendChild(li);
                });
            })
            .catch(function () {
                showLoading(false);
                mostrarToast('error', 'Erro ao carregar hábitos.');
                closeDayDetail();
            });
        });
    });

})();