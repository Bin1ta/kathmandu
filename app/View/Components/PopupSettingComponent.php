<?php

namespace App\View\Components;

use App\Models\PopupSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopupSettingComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public ?PopupSetting $popupSetting;

    public function __construct(int|null $ward = null)
    {
        $this->popupSetting = PopupSetting::withWhereHas('popupActivations', function ($q) use ($ward) {
            if (!empty($ward)) {
                $q->whereRaw("FIND_IN_SET('$ward', ward) > 0")->where('is_active', 1);
            }
        })
            ->where(function ($q) use ($ward) {
                if (empty($ward)) {
                    $q->mainPageDisplay();
                }
            })
            ->active()
            ->latest()
            ->first();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.popup-setting-component');
    }
}
