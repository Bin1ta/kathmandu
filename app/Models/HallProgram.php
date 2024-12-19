<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'hall_id',
        'program_name',
        'program_detail',
        'program_date',
        'program_time_to',
        'program_time_from',
        'remark',
        'user_id',
        'status',
        'is_displayed',
        'ward'
    ];
    public function scopeMainPageDisplay(Builder $builder, bool $display = true): void
    {
        $builder->where('is_displayed', $display);
    }
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
