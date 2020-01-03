<?php

namespace App;


class MOneDrive {

    public function getTokenBearer(){
        return "Bearer EwCoA8l6BAAUO9chh8cJscQLmU+LSWpbnr0vmwwAAZr7/0Rkkww1564GTwGTvG2gxYkBiEhMay7Vhp1dFYXQO0IPHNvQSH8hKkNrUq0Wgn6VyzHNI6QkkdNhmNR7GE4mrGHU8PMT2P/KAx4SmFT+q8satOkZZ5F2W9mTxb2gBYM0yHdlR0XTqBoLoLli5QIfMkojksNEW9iLPfTVy1QigVYs2pF4umh1UCtSc6gX+A7CHioFLOtx0lCJI070nJg2xuHCB5soummcEL6o1drCVX9xmb7TW0m4XdtUT7GU2IbGbcuweeOPGN7EbfWiq/Gr2PMPBTGTvyVsxL6I/7Uxujo/4gcPysBmDReUGgKbCrV4jnbgUDRrhU9ag6D4PDQDZgAACDzr7dQ5sHTqeAIzAQCgFzbdS5QFweAmqvpauX2M2LfcZgTiKE0YBBZzYv7i9IjKmvJmj/SJ1cgREP9sxiUumHYVkEu174QOeSYZV8CityjdIm4KHENnqKUqk4ovmImdWdOsCAXu1kqfjVmvgc7Unejfrj7i7iWldglzOVdVNi79PYKh3khUmqf/IsMjMM4fYurKMGi2dmsqiGs7RIXFaSja7Y3wM11iZecVAC96KVXEaspAx3EFFQHvVCgUSNzWbz+TVqcbKf+4ZyyEp8FZkx6o72/frvHepvAhqWc0Q3JAJzZS7NQwiTBLBDrHs7hCjuEHb9QlHpbYQRIzXV5UM8e4FFsN5iJLhzshZgednJro5HakX9KWkM5XzoJuyXzDKE4Fbd4CFDVv4V0AT6vLnOs1VSsVaphk31v3QBtV0pXErpNdKViunDvsD+S0c8DbOgHd+gjy0nkv2hDo0sBdqwymQOoypPuFhY776LRIYm3KW2keU2+tVyCBHmdvgtD+ejz8GNTwu230DcTxPIyu1lcm0uSAFK5o6F4bdqk6rHZRfXoihnOM6980S3AmiF/ylNxEM8NGbPbbInTlRbiSpQQoSelypv27zJfVI+YE9Dc+6IgmpniSKORZZBiXZYgDipa8o5g2fYrbH1Oehj0muyQVw8kG5EkQQ1VwHxqC2EapVW5uk6SboSb/7uDRPsz3z6Nhw9KeXAdzRXxNevkbD5is4g8vJMd2N3PBasuZP8tuldWRALiggtQz+yVih35iqgus6cgqAAKlWzlHSxn+2secSraBAYbzEmoQ/D7k6nonvblYJ12iFmLB8h6Zz4XublA0hACAsHhqKeSeswGL4XkAJ8UC";    
    }

    public function urlSalvar($nomeArquivo){
        return env('URL_BASE_ONE_DRIVE')."drive/root:/".env('PASTA_ONE_DRIVE')."/".$nomeArquivo.":/content";
    }

    public function urlGet($idArquivo){
        return env('URL_BASE_ONE_DRIVE')."drive/items/".$idArquivo."/content";
    }

    public function salvaArquivo($nome, $conteudo){
        $headers = [];
        $headers[] = 'Authorization: '.$this->getTokenBearer();
        $headers[] = 'Content-Type: text/plain';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlSalvar($nome));
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudo); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        $resultado = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 
    }


}