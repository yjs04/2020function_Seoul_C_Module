<?php

namespace Controller;

use App\DB;

class ViewController{
    function index(){
        view("index");
    }

    function sub1(){
        view("sub1");
    }

    function sub2(){
        view("sub2");
    }

    function store(){
        view("store");
    }

    function entry(){
        view("entry");
    }

    function join(){
        view("join");
    }

    function login(){
        view("login");
    }

    function work(){
        view("work");
    }
}