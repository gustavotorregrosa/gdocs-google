<?php

namespace App;

use GuzzleHttp\Psr7\Request as GuzzleRequest;

class MOneDrive {

    public function getTokenBearer(){
        return "Bearer EwCoA8l6BAAUO9chh8cJscQLmU+LSWpbnr0vmwwAATh9DVdWjBAjCx6YcgqyCAdzsDn+Ww4UxcjIMqA193MzSSnTL2D90JnL53nDiPJlp9fXlDIoDCw149/URKbS0ryUAMQzUKOFAvlD7+BD88IjCiYufj5TuSeD2zmDCsXMDRqWd9MeNQgpMy3SEHG0C4BARLofiJP7xeUc3575thGnWOBpAu227NLY9rkBlI2h3CVzlnY+I4DKNjA3pM0qT1++ioEtqhRPu8SyyAFi2pUJjM1Ysx61hGkVL0sVCqrn3QwOpS9uqILUChgG4L3jdfM8EOD9P8LoUIzDAl6+NELAmY2eS+8XjKb1IDvUr/4DB3+ltVBj1ui0g9tJRn619qIDZgAACGgVoRkr6lckeAITZh/m3QeLqwoPk+ITO1Qkb+6AScZRatAkC5fe+Knln68vMggq5O4bEGFd2VHBAs+OKVquf/cb1cEu7hxevMgKz/3VWcyFYZNVUYll5L6J6511dExy4UZKJyh4jYpLCXo7ZjgRjBn+RSJUeiePhC6MFid/MCB+YXzbqc1LghTBwVhVjvkZ4g0c86HC5l+4BHFNkQXh4TnDmtlu9tFLd9Eab1gj5tRoXDsMGlsbJsMy/CbAGKbSzLrSUVEGIxiAAe2qpf2S0BJpeKxiYPACxcTR8XKeUgnu0uVdjJRV/QTKyUOk6ZY9VMNPuWm2KlHTNe9wIj2cU+0g5HhoEuFwXgaO49aZlsKo60/loLpEP5XgU3IXqv8KzIY0/htfVZoxjXy076Kg3dJWcwPaIlxzkrwMo6+/lF95y7cXGK5Rz3tDHYvI1g8GsV+l5jQCbSbISCdp747Nhcn2Wb8EsA3k0JkWp1OdjoGxeXwur65mUVkf9PIGkO0Jc9u4aGreWYk28mUyRpxjd8bBFXE1qDPT+TVzRw5iweZfimN18+lIaCB/wZJMrsfzd1vUhBghjhloFatxgQt86fPDMbNW/KjF06/9763j/2dTyT0dh6/z2f8Ub4UBSYVjN0oMfES4sgbO0kfUk0gUYpt37Tpxq1xxYzXxn4uevLnJk4dkIfm8mmTL5cArO1P5/710i0smwXbyPj8/kcxxaSPIuAfhdqxZfodWsDlMK6KtFNaE+vZoOul8bt3AGUXXmrWtMbJNn7bYN6Q7cTRiR/kDKvfdH3OBru9WFpfLcRCFTfwiflECDHtZx2sjHReHRrpPyNPp2mcu3GsTYb4cAfurvsUC";    
    }

    public function urlSalvar($nomeArquivo){
        return env('URL_BASE_ONE_DRIVE')."drive/root:/".env('PASTA_ONE_DRIVE')."/".$nomeArquivo.":/content";
    }

    public function urlGet($idArquivo){
        return env('URL_BASE_ONE_DRIVE')."drive/items/".$idArquivo."/content";
    }

    public function salvaArquivo(){
        $headers = [];
        $headers[] = 'Authorization: '.$this->getTokenBearer();
        $headers[] = 'Content-Type: text/plain';
        // $gRequest = new GuzzleRequest('PUT', $this->urlSalvar("gustavo.txt"), $headers, "meu teste blablabla");
        // $corpo = $gRequest->getBody();
        // var_dump("bateu aqui...");
        // var_dump($gRequest);
        $ch = curl_init();
        var_dump("meu destino eh");
        var_dump($this->urlSalvar("gustavo.txt"));

        
        curl_setopt($ch, CURLOPT_URL, $this->urlSalvar("gustavo.txt"));
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "teste...."); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        $resultado = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 

        var_dump("resultado foi...");
        var_dump($resultado);
        var_dump($httpCode);
    }


}