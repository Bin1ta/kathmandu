<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateInputComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string  $nameNe = 'date',
        public string  $labelNe = 'मिति',
        public string  $nameEn = 'date_en',
        public string  $labelEn = 'Date',
        public bool    $showEnglishDate = false,
        public bool    $getTodayDate = true,
        public ?string $idNe = null,
        public ?string $idEn = null,
        public ?string $editDateNe = null,
        public ?string $editDateEn = null,
        public ?string $container = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.date-input-component');
    }
}
