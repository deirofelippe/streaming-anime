<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        DB::table('permissoes')->insert([
            'permissao' => 'comum'
        ]);

        DB::table('permissoes')->insert([
            'permissao' => 'admin'
        ]);
        //admin geral, admin anime, admin forum, admin comentario, admin manga, comum
    }
}



