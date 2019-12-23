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

    public function salvar(Request $request){
        var_dump($request->input('arquivos'));

        return response()->json([
            'teste' => 'Felipe'
        ]);
    }

    //
}
