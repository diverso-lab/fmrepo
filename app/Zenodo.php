<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Zenodo
{

    public string $access_token;
    private Client $client;
    private bool $instance = false;

    function __construct() {
        $this->client();
        $this->access_token = $this->get_random_token();
    }

    private function client(): void
    {
        if($this->instance) {
            return;
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

    // GET RANDOM TOKEN
    public function get_random_token() : string
    {
        $tokens = array();
        $fp = fopen(base_path('.tokens'), "r");
        while (!feof($fp)){

            // Read token from file
            $token = fgets($fp);

            // Strip whitespace (or other characters like "\n") from the end of a string
            $token = rtrim($token);

            // Add token to array
            array_push($tokens, $token);
        }
        fclose($fp);
        return $tokens[array_rand($tokens, 1)];
    }

    // API HTTP VERBS
    private function get($url)
    {
        try {
            $response = $this->client->request('GET', $url, ['query' => ['access_token' => $this->access_token]]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $e->getMessage();
        }
    }

    private function post($url, $data)
    {
        try {
            $response = $this->client->request('POST', $url, [
                'query' => ['access_token' => $this->access_token],
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $e->getMessage();
        }
    }

    private function post_file($url,$file_data,$file)
    {
        try {

            $response = $this->client->request('POST', $url, [
                'query' => ['access_token' => $this->access_token],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => $file,
                        'filename' => $file_data['name']
                    ]
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return $e->getMessage();
        }
    }

    // DEPOSITIONS
    public function get_depositions()
    {
        return $this->get($url =
            '/api/deposit/depositions');
    }

    public function post_deposition($data)
    {
        return $this->post($url = 'api/deposit/depositions',$data);
    }

    // DEPOSITION FILES
    public function get_files_by_deposition($deposition)
    {
        return $this->get($url =
            '/api/deposit/depositions/'.$deposition.'/files');
    }

    public function post_file_in_deposition($deposition,$data,$file)
    {
        return $this->post_file($url =
        'api/deposit/depositions/'.$deposition.'/files',$data,$file);
    }


}

?>