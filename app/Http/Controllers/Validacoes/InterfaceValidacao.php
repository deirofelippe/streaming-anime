<?php

namespace App\Http\Controllers\Validacoes;

use Illuminate\Http\Request;

interface InterfaceValidacao{

    public function validar(Request $request);

    public function gerarInstanciaDoValidator(Request $request);
}
