<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CitizenCharter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'branch_id',
        'service',
        'required_document',
        'amount',
        'time',
        'responsible_person',
        'ward',
        'user_id',
        'is_displayed',
    ];

    // protected $casts = [
    //     'is_displayed' => 'boolean',
    //     'ward' => 'array'
    // ];
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
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
