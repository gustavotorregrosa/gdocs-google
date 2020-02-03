<?php

namespace App\Http\Controllers;

use App\Arquivo;
use Illuminate\Http\Request;
use App\MeuLogger;
use App\GToken;
use Google_Client;
use Google_Service_Drive;
use Exception;

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

    public function teste(){
       var_dump("foi.....");
        $meuToken = new GToken;
        var_dump($meuToken->getAccessToken());
        var_dump("foi.....2");










    //     $meuClient = new Google_Client;
    //     $meuClient->useApplicationDefaultCredentials();
    //     $meuClient->addScope(Google_Service_Drive::DRIVE);
    //     // $meuClient->setSubject();
    //     $tokenCallback = function ($cacheKey, $accessToken) {
    //         // $logger->debug(sprintf('new access token received at cache key %s', $cacheKey));
    //         var_dump("meu token eh");
    //         var_dump($accessToken);
    //       };
    //     $meuClient->setTokenCallback($tokenCallback);
    //     $httpClient = $meuClient->authorize();
    //     $meuServico = new Google_Service_Drive($meuClient);
    //     // $optParams = array(
    //     //     'pageSize' => 10,
    //     //     // 'fields' => 'nextPageToken, files(id, name)'
    //     //   );

    //     // $arquivos = $files = $meuServico->files->listFiles($optParams);

    //     $response = $httpClient->get('https://www.googleapis.com/auth/drive');


    //     MeuLogger::debug(var_dump($response));
    //     // $gClient = new Google_Client;
    //     // $gClient->setApplicationName('minha-api-drive');
    //     // $gClient->setDeveloperKey('AIzaSyDRqCOEjBASPw-VQkpmP4adxAqO0x_-BkU');
    //     // $gClient->addScope(Google_Service_Drive::DRIVE);
    //     // $service = new Google_Service_Drive($gClient);
    //     // try {
    //     //     $arquivos = $service->files->listFiles()->getFiles();
    //     //     var_dump($arquivos);
    //     // } catch(Exception $e){
    //     //     var_dump("deu erro");
    //     //     var_dump($e);

    //     // }
    //     // $arquivos = $service->files->listFiles()
       
    //     // $token = $gClient->getAccessToken();
    //     // $gClient->addScope(Google_Service_Drive::DRIVE);
    //     // $gClient->getOAuth2Service();
    //     // $token = $gClient->getAccessToken();
    //     // var_dump($token);
        
    //     // $files = $service->files->listFiles([])->getItems();

    // //    var_dump($files);
    // // $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    // // var_dump($redirect_uri);


    //     // var_dump("ola mundo");
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
        return [
            'nome' => $nome,
            'conteudo' => $data
        ];
    }

    public function salvar(Request $request)
    {
        $arquivos = $request->input('arquivos');
        $listaNomes = [];
        $listaNomesConteudo = [];
        foreach($arquivos as $a){
            $arrayTempParamArquivo = $this->salvarUnit($a);
            $listaNomesConteudo[] = $arrayTempParamArquivo;
            $listaNomes[] = [
                'nomeoriginal' => $a['name'],
                'nome' => $arrayTempParamArquivo['nome']
            ];
        }
        foreach($listaNomes as $a){
            Arquivo::create($a);
        }
        // $oneDrive = new MOneDrive;
        // foreach($listaNomesConteudo as $a){
        //     $oneDrive->salvaArquivo($a['nome'], $a['conteudo']);
        // }
        return response()->json($listaNomes);
    }
}
