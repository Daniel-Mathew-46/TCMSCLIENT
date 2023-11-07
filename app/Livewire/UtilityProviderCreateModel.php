<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class UtilityProviderCreateModel extends Component
{
    public $util_prov_name;
    public $util_prov_categ_id;
    public $isOpen = false;
    
    public $listeners = [
        'toggleUPCreateModal' => 'toggleUPModal'
    ];

    public function toggleUPModal() {
        $this->isOpen = !$this->isOpen;
    }


    public function createNewUtilityProvider() {
        $this->validate([
            'util_prov_name' => 'required',
            "util_prov_categ_id" => 'required'
        ]);

        $inputs = [
            'provider_name' => $this->util_prov_name,
            "provider_categories_id" => $this->util_prov_categ_id
        ];

        Log::info("Component Utility Provider Inputs:" . json_encode($inputs));
    }

    public function render()
    {
        $providerCategories = [];
        try {
            $providerCategories = Http::post('http://localhost:8000/api/listProviderCategories')['providerCategories'];
        } catch (\Exception $e) {
            Log::error("Component Utility Provider Exception:" . $e->getMessage());
        }
        return view('livewire.utility_providers.utility-provider-create-model', compact('providerCategories'));
    }
}
