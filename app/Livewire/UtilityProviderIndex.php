<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class UtilityProviderIndex extends Component
{
    public $showUPCreateModel = false;

    public function toggleModal() {
        $this->showUPCreateModel = !$this->showUPCreateModel;
    }

    public function render()
    {
        $providers = [];

        try {

            $providers = Http::post('http://localhost:8000/api/utilityProviders')['providers'];
            Log::info("Providers Message::" . json_encode($providers));
        } catch (\Exception $e) {
            Log::channel('daily')->info("UtilityProviderException:" . $e->getMessage());
        }
        return view('livewire.utility-provider-index', compact('providers'))
        ->with('i');
    }
}
