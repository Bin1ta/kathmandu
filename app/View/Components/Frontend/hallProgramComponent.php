<?php

namespace App\View\Components\frontend;

use App\Models\HallProgram;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class hallProgramComponent extends Component
{

    public $hallPrograms;
    /**
     * Create a new component instance.
     */
    public function __construct(int|null $ward = null)
    {
        $this->hallPrograms = HallProgram::with('hall')
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->orderBy('hall_id')->where('status',1)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.hall-program-component');
    }
}
