<?php

namespace App\Http\Controllers;

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
