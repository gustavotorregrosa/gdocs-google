<?php

namespace App\Http\Controllers;

use App\GToken;
use CURLFile;

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


    public static function salvaArquivo($arquivo){
       
       
        $objToken = new GToken;
        $token = $objToken->getAccessToken();
        $token = "Bearer ".$token;
        $headers = ["Authorization: ".$token, "uploadType: media", "mimeType: application/pdf"];

        
        // $fp = fopen("arquivos/".$arquivo, "r");
       


     
        
        $ch = curl_init();
        $caminho = "arquivos/".$arquivo;
        $tipo = 'application/pdf';
        $arquivoUpload = new CURLFile($caminho, $tipo, "meuarquivo.pdf");
        $params = [
            'mimeType' => 'application/pdf',
            'data' => $arquivoUpload,
            'fields' => 'id'

        ];
        curl_setopt($ch,CURLOPT_URL,"https://www.googleapis.com/upload/drive/v3/files");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POST,true);
        // curl_setopt($ch,CURLOPT_FILE, $arquivo);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
        // curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        var_dump($output);
        curl_close($ch);

        // $guzzleClient = new \GuzzleHttp\Client([
        //     'timeout'  => 10.0
        // ]);

      

        // $guzzleRequest = new \GuzzleHttp\Psr7\Request('POST',  'https://www.googleapis.com/upload/drive/v3/files', $headers, $fp);

        // $promise = $guzzleClient->sendAsync($guzzleRequest);
        // $promise->wait();
        // $promise->then(
        //     function ($res) {
        //         var_dump("deu certo...");
        //         var_dump($res);
        //         echo $res->getStatusCode() . "\n";
        //     },
        //     function ($e) {
        //         var_dump("deu errado...");
        //         echo $e->getMessage() . "\n";
        //         echo $e->getRequest()->getMethod();
        //     }
        // );
    // }
       

        // $client->request('POST', 'https://www.googleapis.com/upload/drive/v3/files', ['body' => $fp], [
        //     'headers' => $headers
        // ]);

        

        
        
        // var_dump("arquivo... ");
        // var_dump($arquivo);
        // $fileMetadata = new Google_Service_Drive_DriveFile(array(
        //     'name' => 'photo.jpg'));
        // $content = file_get_contents('files/photo.jpg');
        // $file = $driveService->files->create($fileMetadata, array(
        //     'data' => $content,
        //     'mimeType' => 'image/jpeg',
        //     'uploadType' => 'multipart',
        //     'fields' => 'id'));
        // printf("File ID: %s\n", $file->id);
        


        // $objToken = new GToken;
        // $token = $objToken->getAccessToken();
        // $token = "Bearer ".$token;
        // $headers = ["Authorization: ".$token, "uploadType: media", "mimeType: application/pdf"];

        // $params = [
        //     'fields' => 'id',
        //     // 'corpo' => $arquivo
        //     'data' => "ola mundo"
        // ];
        
        // var_dump($headers);

        // $arquivo = "teste gustavo 123";

        // var_dump($arquivo);
        // // $arquivo = file_get_contents($arquivo);
        // // var_dump($arquivo);


     

    // }

    //
        }
}
