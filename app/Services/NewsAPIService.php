<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsAPIService
{

    protected string $url;
    protected string $apiKey;
    protected mixed $params;

    public function __construct($params)
    {
        $this->url = env('NEWSAPI_URL');
        $this->apiKey = env('NEWSAPI_API_KEY');
        $this->params = $params;
    }

    public function fetchData()
    {
        $response = null;

        if ($this->params) {
            try {
                $response = Http::get($this->url, [
                    'q' => $this->params,
                    'apiKey' => $this->apiKey,
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return $response;
    }
}
