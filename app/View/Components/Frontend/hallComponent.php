<?php

namespace App\View\Components\frontend;

use App\Models\Hall;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class hallComponent extends Component
{

    public $halls;
    /**
     * Create a new component instance.
     */
    public function __construct(int|null $ward = null)
    {


        $this->halls = Hall::where(function ($q) use ($ward) {
            if (!empty($ward)) {
                // Use parameter binding here
                $q->whereRaw("FIND_IN_SET(?, ward) > 0", [$ward]);
            } else {
                $q->MainPageDisplay();
            }
        })
            ->where('status', 1)
            ->get();
    }




    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.hall-component');
    }
}
