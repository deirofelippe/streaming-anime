<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase{

    /*
    faz testes unitarios, varios metodos
    faz teste de integracao, conjunto de metodos
    1 teste p errar, 2 teste p passar, 3 refatore o codigo do teste
    varios inputs diferentes p ver as possibilidades
    */
    public function testOrdemDecrescente(){
        $this->nums = [
            1=>"Geladeira",
            2=>"Carro"
        ];

        $num = 2;

        $this->assertEquals("Carro", $this->nums[$num]);
    }

    private $nums;
}
