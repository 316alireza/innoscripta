<?php

namespace App\Services;

use App\Services\DataResource;
use Illuminate\Support\Facades\Http;

class GuardianService implements DataResource
{

    protected string $url;
    protected string $apiKey;

    public function setURL()
    {
        $this->url = env('GUARDIAN_URL');
    }

    public function setAPIKey()
    {
        $this->apiKey = env('GUARDIAN_API_KEY');
    }

    public function fetchData()
    {
        try {
            $response = Http::get($this->url, [
                'api-key' => $this->apiKey,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $response;
    }
}
