<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'particulars',
        'amount',
        'ward',
        'remarks',
        'is_displayed',
        'user_id'
    ];
    protected $casts = [
        'is_displayed' => 'boolean'
    ];

    public function scopeMainPageDisplay(Builder $builder, bool $display = true): void
    {
        $builder->where('is_displayed', $display);
    }

    protected function ward(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => explode(',', $value),
            set: fn(string|array|null $value) => !empty($value) ? is_array($value) ? implode(',', $value) : $value : null,
        );
    }

}
