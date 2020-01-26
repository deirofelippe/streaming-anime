<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anime\Permissao;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $mensagens = [
            'required'=>'O campo não pode ficar vazio',
            'string'=>'O campo não pode ter apenas números',
            'email'=>'O campo não esta no formato de e-mail',
            'max'=>'O campo deve ter no máximo :max dígitos',
            'min'=>'O campo deve ter no mínimo :min dígitos',
            'confirmed'=>'As senhas devem ser as mesmas',
            'unique'=>'O campo já existe'
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $mensagens);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        if(Gate::allows('isAdmin')){
            return $this->createComoAdmin($data);
        }

        return $this->createSemAdmin($data);
    }

    private function createSemAdmin($data){
        $user = User::create([
            'avatar' => $data['avatar'],
            'username' => $data['username'],
            'descricao' => $data['descricao'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return $user;
    }

    private function createComoAdmin($data){
        print_r($data['permissao']);
        $data->o;

        $user = User::create([
            'avatar' => $data['avatar'],
            'username' => $data['username'],
            'descricao' => $data['descricao'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $permissao = Permissao::where('permissao', $data['permissao'])->first();

        $user->permissoes()->attach($permissao->id);
        return $user;
    }
}
