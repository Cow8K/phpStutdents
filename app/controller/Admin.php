<?php

namespace app\controller;

use app\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        return "Admin index";
    }

    public function login()
    {
        return view();
    }
}