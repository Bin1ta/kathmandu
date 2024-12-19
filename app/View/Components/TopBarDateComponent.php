<?php

namespace App\View\Components;

use App\Traits\NepaliDateConverter;
use Illuminate\View\Component;

class TopBarDateComponent extends Component
{
    use NepaliDateConverter;

    public string $nepaliDate;

    public function __construct()
    {
        $this->nepaliDate = $this->formatNepaliDate();
    }

    public function render()
    {
        return view('components.top-bar-date-component', [
            'nepaliDate' => $this->nepaliDate
        ]);
    }

    protected function get_nepali_number($data): string|array
    {
        return str_replace(['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], ['१', '२', '३', '४', '५', '६', '७', '८', '९', '०'], $data);
    }

    protected function formatNepaliDate(): string
    {
        $nepaliMonthNames = [
            'बैशाख', 'जेठ', 'असार', 'साउन', 'भदौ', 'असोज',
            'कार्तिक', 'मंसिर', 'पुष', 'माघ', 'फागुन', 'चैत्र'
        ];

        $nepaliWeekDays = [
            'आइतबार', 'सोमबार', 'मंगलबार', 'बुधबार', 'बिहिबार', 'शुक्रबार', 'शनिबार'
        ];
        $todayNepaliDate = $this->get_today_nepali_date();
        list($year, $month, $day) = explode('-', $todayNepaliDate);

        $year = $this->get_nepali_number($year);
        $day = $this->get_nepali_number($day);
        $monthName = $nepaliMonthNames[(int)$month - 1];
        $weekDayIndex = $this->get_nepali_weekday();
        $weekDayName = $nepaliWeekDays[$weekDayIndex];

        return "{$year} साल {$monthName} {$day} गते, {$weekDayName}";
    }

    protected function get_nepali_weekday(): int
    {
        return 4;
    }
}
