@props(['weeks', 'logCounts', 'maxCount', 'year'])

@php
    $months = [];
    $seenMonths = [];
    foreach ($weeks as $weekIndex => $week) {
        foreach ($week as $day) {
            if ($day && $day->day <= 7) {
                $monthKey = $day->format('Y-m');
                if (!in_array($monthKey, $seenMonths)) {
                    $months[$weekIndex] = $day->locale('pt_BR')->translatedFormat('M');
                    $seenMonths[] = $monthKey;
                }
                break;
            }
        }
    }
@endphp

<div class="mb-6 w-full">

    {{-- GRID --}}
    <div class="bg-surface/40 backdrop-blur-md border border-border-glass rounded-2xl p-3 sm:p-5 overflow-x-auto scrollbar-none shadow-sm">

        {{-- MONTH LABELS --}}
        <div class="flex gap-0.5 sm:gap-1 min-w-max mb-1 ml-0">
            @foreach ($weeks as $weekIndex => $week)
                <div class="w-2.5 sm:w-3 text-[7px] sm:text-[9px] text-text-muted text-center font-medium">
                    {{ $months[$weekIndex] ?? '' }}
                </div>
            @endforeach
        </div>

        {{-- DAY CELLS --}}
        <div class="flex gap-0.5 sm:gap-1 min-w-max">
            @foreach ($weeks as $week)
                <div class="flex flex-col gap-0.5 sm:gap-1">
                    @foreach ($week as $day)
                        @if ($day === null)
                            <div class="w-2.5 sm:w-3 aspect-square"></div>
                        @else
                            @php
                                $dateStr = $day->toDateString();
                                $count   = $logCounts->get($dateStr, 0);

                                if ($count === 0) {
                                    $bg = 'bg-surface-contribution/50';
                                } elseif ($count / $maxCount <= 0.25) {
                                    $bg = 'bg-brand-blue/20';
                                } elseif ($count / $maxCount <= 0.50) {
                                    $bg = 'bg-brand-blue/40';
                                } elseif ($count / $maxCount <= 0.75) {
                                    $bg = 'bg-brand-blue/70';
                                } else {
                                    $bg = 'bg-brand-blue';
                                }
                            @endphp
                            <div
                                class="w-2.5 sm:w-3 aspect-square rounded-[2px] sm:rounded-xs transition-all hover:ring-2 hover:ring-brand-blue/40 {{ $bg }} {{ $count > 0 ? 'cursor-pointer' : 'cursor-default' }}"
                                title="{{ $day->format('d/m/Y') }}: {{ $count }} hábito(s) concluído(s)"
                                data-date="{{ $dateStr }}"
                                data-count="{{ $count }}"
                            ></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    {{-- LEGEND --}}
    <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-4 text-[0.7rem] sm:text-xs text-text-muted">
        <span>Menos</span>
        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-[2px] bg-surface-secondary/50"></div>
        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-[2px] bg-brand-blue/20"></div>
        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-[2px] bg-brand-blue/40"></div>
        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-[2px] bg-brand-blue/70"></div>
        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-[2px] bg-brand-blue"></div>
        <span>Mais</span>
    </div>

    {{-- DAY DETAIL PANEL --}}
    <div id="day-detail-panel" class="hidden mt-6 bg-surface/60 backdrop-blur-xl border border-border-glass rounded-2xl p-4 sm:p-5 shadow-lg">

        <div class="flex items-center justify-between mb-4">
            <p id="day-detail-date" class="text-[0.95rem] font-bold text-text-primary capitalize"></p>
            <button
                onclick="closeDayDetail()"
                class="w-8 h-8 flex items-center justify-center rounded-xl bg-surface-secondary text-text-muted hover:text-text-primary transition-colors hover:bg-surface-secondary/80 outline-none"
                title="Fechar"
            >&times;</button>
        </div>

        {{-- LOADING --}}
        <div id="day-detail-loading" class="hidden items-center gap-2 text-sm text-text-muted">
            <svg class="animate-spin w-4 h-4 text-brand-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <span>Carregando...</span>
        </div>

        {{-- HABIT LIST --}}
        <ul id="day-detail-list" class="flex flex-col gap-2.5"></ul>

    </div>

</div>
