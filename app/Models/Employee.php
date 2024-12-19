<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'department',
        'designation',
        'photo',
        'email',
        'phone',
        'position',
        'status',
        'is_employee',
        'show_to_mobile_app',
        'show_to_index',
        'employee_id',
        'ward',
        'is_displayed',
        'user_id',
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


    public function getPhotoUrlAttribute(): string
    {
        return $this->attributes['photo']
            ? Storage::disk('public')->url($this->attributes['photo'])
            : asset('images/user_icon.jpg');
    }

    public function setPhotoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['photo'] = $value->store('employee/' . Str::slug($this->attributes['name'], '_'), 'public');
        }
    }

    public function scopeActive($builder)
    {
        return $builder->where('status', 1);
    }

    public function scopeInactive($builder)
    {
        return $builder->where('status', 0);
    }

    public function scopeEmployee($builder)
    {
        return $builder->where('is_employee', 1);
    }

    public function scopePeopleRepresentative($builder)
    {
        return $builder->where('is_employee', 0);
    }

    public function scopeShowForMobileAppRequest($builder)
    {
        return $builder->where('show_to_mobile_app', 1);
    }

    public function scopeHideForMobileAppRequest($builder)
    {
        return $builder->where('show_to_mobile_app', 0);
    }

    public function scopeShowInIndex($builder)
    {
        return $builder->where('show_to_index', 1);
    }

    public function scopeHideInIndex($builder)
    {
        return $builder->where('show_to_index', 0);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
