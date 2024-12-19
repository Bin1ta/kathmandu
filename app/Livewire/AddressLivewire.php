<?php

namespace App\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddressLivewire extends Component
{
    public $province_id = '';

    public $district_id = '';

    public $local_body_id = '';

    public $ward_no = '';

    public $provinces = [];

    public $districts = [];

    public $localBodies = [];

    public $wards = '';

    public function mount($address = null): void
    {
        $this->provinces = get_provinces();

        if (!empty($address)) {
            $this->province_id = $address['province_id'] ?? '';
            $this->district_id = $address['district_id'] ?? '';
            $this->local_body_id = $address['local_body_id'] ?? '';
            $this->ward_no = $address['ward_no'] ?? '';
        }
    }

    public function render()
    {
        $this->getDependentDropdown();

        return view('livewire.address-livewire');
    }

    /**
     * @return void
     */
    public function getDependentDropdown(): void
    {
        if (!empty($this->province_id)) {
            $this->districts = get_districts($this->province_id);
        }
        if (!empty($this->district_id)) {
            $this->localBodies = get_local_bodies($this->district_id);
        }
        if (!empty($this->local_body_id)) {
            $this->wards = get_local_bodies(localBodyId: $this->local_body_id)->wards;
        }
    }
}
