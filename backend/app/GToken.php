<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Google_Client;
use Google_Service_Drive;

class GToken extends Model
{

    protected $table = "token";
    protected $guarded = [];
    protected $meuToken;

    public function __construct()
    {
        var_dump("bateu aqui");
        // $this->meuToken = self::firstOrCreate([
        //     'id' => 1
        // ]);
    }

    public function getAccessToken()
    {

        $this->meuToken = self::firstOrCreate([
            'id' => 1
        ]);

        $tokenExpirado = false;
        if(Carbon::now()->diffInMinutes($this->meuToken->updated_at) > 5){
            $tokenExpirado = true;
        }

     
       
        if (!$this->meuToken->access_token || $tokenExpirado) {

            var_dump("passa aqui??");
            $meuClient = new Google_Client;
            $meuClient->useApplicationDefaultCredentials();
            var_dump("passa aqui?? 2");
            $meuClient->addScope(Google_Service_Drive::DRIVE);
            // var_dump($meuClient);
            $tokenCallback = function ($cacheKey, $tokenDeAcesso) {
                var_dump($cacheKey);
                var_dump("ola mundo 123");
                var_dump($tokenDeAcesso);
                // $this->meuToken->access_token  = $accessToken;
            };
            $meuClient->setTokenCallback($tokenCallback);
            $httpClient = $meuClient->authorize(); 
            // $meuServico = new Google_Service_Drive($meuClient);
            // var_dump($httpClient);     
            $this->meuToken->save();
            // $response = $httpClient->get('https://www.googleapis.com/auth/drive');
        }
        // return $this->meuToken->access_token;
    }
}
