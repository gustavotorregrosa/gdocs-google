<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Drive;

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

    public function salvar($id){

        $client = new Google_Client();
        $client->setAuthConfig($_SERVER["DOCUMENT_ROOT"]."/../suporte/credenciais.json");
        $client->addScope(Google_Service_Drive::DRIVE);
        var_dump($client);
        die();
        
        $resultado = "";
        var_dump($resultado);
        $resultado = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/../suporte/credenciais.json");
        var_dump("bateu aqui....");
        var_dump($resultado);
        // var_dump($_SERVER["DOCUMENT_ROOT"]);
        var_dump($id);
        die();
    }

    //
}
