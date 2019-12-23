<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArquivosController extends Controller
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
    
    public function geraNome($nomeatual){
       
        $posicaoPonto = strpos($nomeatual, ".");
      
        $nomeSemExtensao = substr($nomeatual, 0, $posicaoPonto);
      
        $extensao = substr($nomeatual, $posicaoPonto, strlen($nomeatual));
      
    }

    public function salvar(Request $request){
       $arquivos = $request->input('arquivos');
       $this->geraNome($arquivos[0]['name']);
    //    var_dump($arquivos[0]);
      

        return response()->json([
            'teste' => 'Felipe'
        ]);
    }

    //
}
