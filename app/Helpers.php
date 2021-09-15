<?php

use App\Models\Dataset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class StringUtilities
{
    public static function get_acronym($string)
    {

        $res = "";

        if(preg_match_all('/\b(\w)/',strtoupper($string),$m)) {
            $res = implode('',$m[1]); // $v is now SOQTU
        }

        return $res;
    }
}

class Random
{
    public static function getRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

class Filepond
{

    public function getServerIdFromPath($path)
    {
        return Crypt::encryptString($path);
    }

    public function getPathFromServerId($serverId)
    {

        return Crypt::decryptString($serverId);
    }

    public static function getFilesFromTemporaryFolder()
    {
        $user = Auth::user();
        $token = session()->token();
        $tmp = 'tmp/'.$user->username.'/'.$token.'/';

        $collection = collect();

        foreach (Storage::files($tmp) as $filename) {

            $file_name = pathinfo($filename, PATHINFO_BASENAME);
            $collection->push($file_name);

        }

        return $collection;

    }
}

class Utilities
{

    public static function isDatasetCookiesDefined()
    {
        return self::getDatasetCookies()->count() != 0;
    }

    public static function getDatasetCookies()
    {

        $res = collect();

        if(isset($_COOKIE['datasets'])){
            $datasets = $_COOKIE['datasets'];

            $datasets_array = explode(",", $datasets);

            foreach($datasets_array as $dataset_id){
                $dataset = Dataset::where('id',intval($dataset_id))->first();
                if($dataset != null)
                    $res->push($dataset);
            }
        }

        return $res;

    }

    public static function is_dir_empty($dir)
    {
        if (!is_readable($dir)) return NULL;
        return (count(scandir($dir)) == 2);
    }

}


?>