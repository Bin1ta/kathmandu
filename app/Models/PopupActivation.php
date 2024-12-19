<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PopupActivation extends Model
{
    protected $fillable = [
        'popup_setting_id',
        'ward',
        'is_active',
    ];

    public function popupSetting(): BelongsTo
    {
        return $this->belongsTo(PopupSetting::class);
    }
}
