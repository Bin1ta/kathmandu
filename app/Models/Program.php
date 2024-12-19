<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Program extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'image',
        'date',
        'ward',
        'is_displayed',
        'user_id',
        'status'
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
//    protected function image():Attribute
//    {
//        return Attribute::make(
//            get:fn(string $value) => Storage::disk('public')->url($value),
//            set:fn($value)=>$value->store('program','public'),
//        );
//    }
    public function setImageAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['image'] = $value->store('program', 'public');
        }
    }
    public function getImageUrlAttribute(): string
    {
        return $this->attributes['image'] ? Storage::disk('public')->url($this->attributes['image']) : '';
    }
}
