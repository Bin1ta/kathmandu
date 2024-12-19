<?php

namespace App\View\Components;

use App\Models\Header;
use App\Traits\NepaliDateConverter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    use NepaliDateConverter;
    public  $headers;

    public function __construct(int|null $ward = null)
    {

        $this->headers = Header::where(function ($q) use ($ward) {
            if (!empty($ward)) {
                $q->where('ward', $ward);
            }else{
                $q->whereNull('ward');
            }
        })
            ->orderBy('position')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-component');
    }
}
