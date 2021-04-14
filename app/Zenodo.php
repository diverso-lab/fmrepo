<?php

use GuzzleHttp\Client;

class Zenodo
{

    public $access_token = "OVUdfpefTBMqhGYF8eWkQSjb0QWSPDvYvyg17mEHK61TBt41VPbRB4vi277t";
    private $client = null;
    private $instance = false;

    function __construct() {
        $this->client();
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