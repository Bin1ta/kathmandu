<?php

namespace App\Models;

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class OfficeSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'site_address',
        'logo',
        'logo1',
        'logo2',
        'background_image',
        'google_map',
        'phone',
        'email',
        'website',
        'province_id',
        'district_id',
        'local_body_id',
        'ward_no',
    ];

    public function setLogoAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['logo'] = $value->store('office_setting/logo', 'public');
        }
    }

    public function setLogo1Attribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['logo1'] = $value->store('office_setting/logo', 'public');
        }
    }

    public function setLogo2Attribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['logo2'] = $value->store('office_setting/logo', 'public');
        }
    }

    public function setBackgroundImageAttribute($value): void
    {
        if (!empty($value) && !is_string($value)) {
            $this->attributes['background_image'] = $value->store('office_setting/logo', 'public');
        }
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->attributes['logo'] ? Storage::disk('public')->url($this->attributes['logo']) : '';
    }

    public function getLogo1UrlAttribute(): string
    {
        return $this->attributes['logo1'] ? Storage::disk('public')->url($this->attributes['logo1']) : '';
    }

    public function getLogo2UrlAttribute(): string
    {
        return $this->attributes['logo2'] ? Storage::disk('public')->url($this->attributes['logo2']) : '';
    }

    public function getBackgroundImageUrlAttribute(): string
    {
        return $this->attributes['background_image'] ? Storage::disk('public')->url($this->attributes['background_image']) : '';
    }

    public function getAddressAttribute(): array
    {
        return [
            'province_id' => $this->attributes['province_id'],
            'district_id' => $this->attributes['district_id'],
            'local_body_id' => $this->attributes['local_body_id'],
        ];
    }

    public function getWardAttribute(): array
    {
        return [
            'ward' => $this->attributes['ward_no'],
        ];
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function localBody(): BelongsTo
    {
        return $this->belongsTo(LocalBody::class);
    }
}
