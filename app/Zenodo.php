<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Zenodo
{

    //public $access_token = "OVUdfpefTBMqhGYF8eWkQSjb0QWSPDvYvyg17mEHK61TBt41VPbRB4vi277t";
    public $access_token = null;
    private $client = null;
    private $instance = false;

    function __construct() {
        $this->client();
        $this->access_token = Auth::user()->zenodo_token?->token;
    }

    private function client()
    {
        if($this->instance) {
            return $this->client;
        }
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $client = new Client([
            'headers' => $headers,
            'base_uri' => 'https://zenodo.org/api'
        ]);

        // singleton
        $this->client = $client;
        $this->instance = true;
    }

    // TEST CONNECTION
    public function test_connection($token)
    {
        try {
            $response = $this->client->request('GET', '/api/deposit/depositions',[ 'query' => ['access_token' => $token] ]);
            return $response->getStatusCode();
        }catch (Exception $e)
        {
            return 401;
        }

    }

    // API HTTP VERBS
    private function get($url = '')
    {
        $response = $this->client->request('GET', $url,[ 'query' => ['access_token' => $this->access_token] ]);
        return json_decode($response->getBody(), true);
    }

    public function get_depositions()
    {
        return $this->get($url =
            '/api/deposit/depositions');
    }

    public function get_files_by_deposition($deposition)
    {
        return $this->get($url =
            '/api/deposit/depositions/'.$deposition.'/files');
    }

}

?>