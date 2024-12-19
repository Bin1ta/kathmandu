<?php

use App\Models\Address\District;
use App\Models\Address\LocalBody;
use App\Models\Address\Province;
use App\Models\OfficeSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

if (!function_exists('officeSetting')) {
    function officeSetting(int|null $ward = null)
    {
        $officeSettings = Cache::rememberForever('office_setting', function () {
            return OfficeSetting::all();
        });

        if (empty($ward)) {

            return $officeSettings->whereNull('ward_no')->first();
        } else {
            return $officeSettings->where('ward_no', $ward)->first();
        }
    }
}

if (!function_exists('get_provinces')) {
    function get_provinces(int $provinceId = null)
    {
        $provinces = Cache::rememberForever('provinces', function () {
            if (Schema::hasTable('provinces')) {
                return Province::all();
            }
            return [];
        });
        if ($provinceId !== null) {
            $provinces = $provinces->where('id', $provinceId)->first();
        }
        return $provinces ?? [];
    }
}

if (!function_exists('get_districts')) {
    function get_districts($province_ids = [], int $districtId = null)
    {
        $province_ids = is_array($province_ids) ? $province_ids : [$province_ids];
        $allDistricts = Cache::rememberForever('allDistricts', function () {
            if (Schema::hasTable('districts')) {
                return District::orderBy('province_id')->get();
            }
            return [];
        });
        if (!empty($province_ids)) {
            $allDistricts = $allDistricts->whereIn('province_id', $province_ids);
        }
        if ($districtId !== null) {
            $allDistricts = $allDistricts->where('id', $districtId)->first();
        }
        return $allDistricts ?? [];
    }
}

if (!function_exists('get_local_bodies')) {
    function get_local_bodies($district_ids = [], int $localBodyId = null)
    {
        $district_ids = is_array($district_ids) ? $district_ids : [$district_ids];
        $allLocalBodies = Cache::rememberForever('localBodies', function () {
            if (Schema::hasTable('local_bodies')) {
                return LocalBody::all();
            }
            return [];
        });
        if (!empty($district_ids)) {
            $allLocalBodies = $allLocalBodies->whereIn('district_id', $district_ids);
        }
        if ($localBodyId !== null) {
            $allLocalBodies = $allLocalBodies->where('id', $localBodyId)->first();
        }
        return $allLocalBodies ?? [];
    }
}

if (!function_exists('get_nepali_number')) {
    function get_nepali_number($data): string|array
    {
        return str_replace(['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], ['१', '२', '३', '४', '५', '६', '७', '८', '९', '०'], $data);
    }
}
if (!function_exists('get_english_number')) {
    function get_english_number($data): string|array
    {
        return str_replace(['१', '२', '३', '४', '५', '६', '७', '८', '९', '०'], ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], $data);
    }
}
if (!function_exists('extractBulkYouTubeVideoId')) {
    function extractBulkYouTubeVideoId($videos): ?string
    {
        $videoIds = collect();
        collect($videos)->each(function ($video) use ($videoIds) {
            $videoIds->push(extractYouTubeVideoId($video));
        });
        return implode(",",$videoIds->filter()->toArray());
    }
}

if (!function_exists('extractYouTubeVideoId')) {
    function extractYouTubeVideoId($url): ?string
    {
        // Define the regex pattern to extract video ID
        $pattern = '/youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)([a-zA-Z0-9_-]{11})/';

        // Check if the URL matches the pattern
        preg_match($pattern, $url, $matches);

        // Return the video ID if found, or null otherwise
        return $matches[1] ?? null;
    }
}
