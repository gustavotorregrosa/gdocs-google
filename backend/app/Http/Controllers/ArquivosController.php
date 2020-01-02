<?php

namespace App\Http\Controllers;

use App\Arquivo;
use Illuminate\Http\Request;
use App\MOneDrive;

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

    public function index(){
        $arquivos = Arquivo::all();

        return response()->json($arquivos);
    }

    public function delete($id){
        $arquivo = Arquivo::find($id);
        unlink($_SERVER["DOCUMENT_ROOT"]."/arquivos/".$arquivo->nome);
        $arquivo->delete();
        return response("Arquivo deletado", 200);

    
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

        $oneDrive = new MOneDrive;

        foreach($listaNomes as $a){
            $oneDrive->salvaArquivo();

        }
       
        return response()->json($listaNomes);
    }

    //
}
