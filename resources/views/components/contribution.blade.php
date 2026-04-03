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
    <div class="bg-orange-50 p-4 habit-shadow-lg overflow-x-auto">

        {{-- MONTH LABELS --}}
        <div class="flex gap-1 min-w-max mb-1 ml-0">
            @foreach ($weeks as $weekIndex => $week)
                <div class="w-3 text-[9px] text-gray-400 text-center">
                    {{ $months[$weekIndex] ?? '' }}
                </div>
            @endforeach
        </div>

        {{-- DAY CELLS --}}
        <div class="flex gap-1 min-w-max">
            @foreach ($weeks as $week)
                <div class="flex flex-col gap-1">
                    @foreach ($week as $day)
                        @if ($day === null)
                            <div class="w-3 aspect-square"></div>
                        @else
                            @php
                                $dateStr = $day->toDateString();
                                $count   = $logCounts->get($dateStr, 0);

                                if ($count === 0) {
                                    $bg = 'bg-[#DADFE9]';
                                } elseif ($count / $maxCount <= 0.25) {
                                    $bg = 'bg-[#FFCF99]';
                                } elseif ($count / $maxCount <= 0.50) {
                                    $bg = 'bg-[#FFB266]';
                                } elseif ($count / $maxCount <= 0.75) {
                                    $bg = 'bg-[#FF8C1A]';
                                } else {
                                    $bg = 'bg-[#FF6600]';
                                }
                            @endphp
                            <div
                                class="w-3 aspect-square rounded-xs cursor-default transition hover:ring-2 hover:ring-orange-400 {{ $bg }}"
                                title="{{ $day->format('d/m/Y') }}: {{ $count }} hábito(s) concluído(s)"
                            ></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    {{-- LEGEND --}}
    <div class="flex flex-wrap items-center gap-3 mt-2 text-xs text-gray-500">
        <span>Menos</span>
        <div class="w-3 h-3 rounded-xs bg-[#DADFE9]"></div>
        <div class="w-3 h-3 rounded-xs bg-[#FFCF99]"></div>
        <div class="w-3 h-3 rounded-xs bg-[#FFB266]"></div>
        <div class="w-3 h-3 rounded-xs bg-[#FF8C1A]"></div>
        <div class="w-3 h-3 rounded-xs bg-[#FF6600]"></div>
        <span>Mais</span>
    </div>

</div>