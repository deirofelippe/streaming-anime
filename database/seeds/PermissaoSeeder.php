<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sudo php artisan migrate:fresh && sudo php artisan db:seed --class=PermissaoSeeder

        DB::table('permissoes')->insert([
            'role' => 'comum'
        ]);

        DB::table('permissoes')->insert([
            'role' => 'admin'
        ]);
        //admin geral, admin anime, admin forum, admin comentario, admin manga, comum

        $adminId = DB::table('permissoes')->where('role','admin')->value('id');

        //incluir usuarios e regras e vincular, incluir usuarios atraves do admin
        $user = User::create([
            'name' => 'feh',
            'email' => 'teste@gmail.com',
            'password' => Hash::make(123)
        ]);

        $user->permissoes()->attach($adminId);
    }
}
