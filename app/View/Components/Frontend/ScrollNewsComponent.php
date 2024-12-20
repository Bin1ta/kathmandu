<?php

namespace App\View\Components\Frontend;

use App\Models\HallDetail;
use App\Models\Notice;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use LaravelIdea\Helper\App\Models\_IH_Notice_C;

class ScrollNewsComponent extends Component
{
    public  $hallDetails;

    public function __construct(int|null $ward = null)
    {
        $this->hallDetails = HallDetail::where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->whereNull('status')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.scroll-news-component');
    }
}
