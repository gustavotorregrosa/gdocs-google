<?php

namespace App\Http\Controllers;

use App\Arquivo;
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

    public function geraNome($nomeatual)
    {
        $nomeSemExtensao = $nomeatual;
        $posicaoPonto = strpos($nomeatual, ".");
        $extensao = "";
        if ($posicaoPonto) {
            $nomeSemExtensao = substr($nomeatual, 0, $posicaoPonto);
            $extensao = substr($nomeatual, $posicaoPonto, strlen($nomeatual));
        }
        $nomeNovo = md5($nomeSemExtensao);
        $nomeNovo .= time();
        if ($posicaoPonto) {
            $nomeNovo .= $extensao;
        }
        return $nomeNovo;
    }

    public function salvarUnit($arq)
    {
        $nome = $this->geraNome($arq['name']);
        $fp = fopen("arquivos/".$nome, "w");
        $data = base64_decode($arq['base64']);
        fwrite($fp, $data);
        fclose($fp);
        return $nome;
    }

    public function salvar(Request $request)
    {
        $arquivos = $request->input('arquivos');
        $listaNomes = [];
        foreach($arquivos as $a){
            $listaNomes[] = [
                'nomeoriginal' => $a['name'],
                'nome' => $this->salvarUnit($a)
            ];
        }
        foreach($listaNomes as $a){
            Arquivo::create($a);
        }
       
        return response()->json($listaNomes);
    }

    //
}
