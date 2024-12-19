<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PopupSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'display_duration',
        'iteration_duration',
        'is_active',
        'ward_no',
        'ward',
        'is_displayed',
        'user_id',
    ];

    protected $casts = [
        'is_displayed' => 'boolean',
    ];

    protected function ward(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value !== null ? explode(',', $value) : [];
            },
            set: function ($value) {
                if (is_array($value)) {
                    return implode(',', $value);
                }
                return $value;
            }
        );
    }

    public function scopeMainPageDisplay(Builder $builder, bool $display = true): void
    {
        $builder->where('is_displayed', $display);
    }

    public function getImageUrlAttribute(): string|null
    {
        return $this->attributes['image']
            ? Storage::disk('public')->url($this->attributes['image'])
            : null;
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('is_active', 1);
    }


    public function setImageAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['image'] = $value->store('popup/', 'public');
        }
    }

    public function popupActivations(): HasMany
    {
        return $this->hasMany(PopupActivation::class);
    }
}
