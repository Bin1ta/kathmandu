<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'province',
        'province_en',
    ];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
