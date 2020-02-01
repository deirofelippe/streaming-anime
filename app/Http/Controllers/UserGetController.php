<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\O;
use App\Services\UserService;

class UserGetController extends Controller{
    private $service;

    function __construct(){
        $this->service = new UserService();
    }

    public function findByName($name){}

    public function list(){
        $users = $this->service->findAll();
        return view('user.user-list')->with('users', $users);
    }
}
