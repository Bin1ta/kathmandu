<?php

namespace App\View\Components\Frontend;

use App\Models\Revenue;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RevenueComponent extends Component
{
    public $revenues;

    /**
     * Create a new component instance.
     */
    public function __construct(int|null $ward = null)
    {
        $this->revenues = Revenue::where(function ($q) use ($ward) {
            if (!empty($ward)) {
                $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
            } else {
                $q->MainPageDisplay();
            }
            })
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.revenue-component');
    }
}
