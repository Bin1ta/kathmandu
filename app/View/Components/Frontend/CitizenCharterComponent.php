<?php

namespace App\View\Components\Frontend;

use App\Models\CitizenCharter;
use App\Models\HallProgram;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use LaravelIdea\Helper\App\Models\_IH_CitizenCharter_C;

class CitizenCharterComponent extends Component
{
    /**
     * @var CitizenCharter[]|\Illuminate\Database\Eloquent\Builder[]|Collection|_IH_CitizenCharter_C|\LaravelIdea\Helper\App\Models\_IH_CitizenCharter_QB[]
     */
    public _IH_CitizenCharter_C|array|Collection $hallPrograms;

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
            ->orderBy('hall_id')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.citizen-charter-component');
    }
}
