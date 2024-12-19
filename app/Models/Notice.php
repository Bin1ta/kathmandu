<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'date',
        'en_date',
        'description',
        'closed_at',
        'show_on_index',
        'user_id',
        'type',
        'ward',
        'is_displayed'
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

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }


    public function scopeShowInIndex($builder)
    {
        return $builder->where('show_on_index', 1);
    }

    public function scopeHideInIndex($builder)
    {
        return $builder->where('show_on_index', 0);
    }

    public function scopeNullClosedAt($builder)
    {
        return $builder->whereNull('closed_at');
    }

    public function scopeContentType($builder, string $type)
    {
        return $builder->where('type', $type);

    }
}
