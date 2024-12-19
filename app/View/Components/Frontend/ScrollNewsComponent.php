<?php

namespace App\View\Components\Frontend;

use App\Models\Notice;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use LaravelIdea\Helper\App\Models\_IH_Notice_C;

class ScrollNewsComponent extends Component
{
    public  $scrollNews;

    public function __construct(int|null $ward = null)
    {
        $this->scrollNews = Notice::contentType('News')
            ->showInIndex()
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->whereNull('closed_at')
            ->orderByDesc('date')
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
