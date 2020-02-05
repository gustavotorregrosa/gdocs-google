<?php

namespace App\Http\Controllers;

use App\GToken;
class GDriveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function getArquivos(){
        $objToken = new GToken;
        $token = $objToken->getAccessToken();
        $token = "Bearer ".$token;
        $headers = "Authorization: ".$token;
       
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://www.googleapis.com/drive/v3/files");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$headers]);
        $output = curl_exec($ch);
        var_dump($output);
        curl_close($ch);




    }

    //
}
