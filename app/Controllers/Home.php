<?php

namespace App\Controllers;

use \App\Models\MenuModel;
use \App\Models\UserModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->menu = new MenuModel();
        $this->user = new UserModel();
    }
    public function index()
    {
        // $this->menu->user();
        $data['menu'] = $this->menu->user();
        $data['title'] = 'Home';
        // $data['menu'] = $this->menu->paginate(8);
        // $data['pager'] = $this->menu->pager;
        return view('menu/index', $data);
    }
}