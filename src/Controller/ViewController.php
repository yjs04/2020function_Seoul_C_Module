<?php

namespace Controller;

use App\DB;

class ViewController{
    function index(){
        $sql = "SELECT * FROM works ORDER BY `id` DESC LIMIT 3";
        $works = DB::fetchAll($sql);
        view("index",$works);
    }

    function overview(){
        view("overview");
    }

    function roadmap(){
        view("roadmap");
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
        $sql = "SELECT * FROM works WHERE `create_date` >= ? ORDER BY `score` DESC LIMIT 4";
        $works = DB::fetchAll($sql,[date('Y-m-d',strtotime("-7 days"))]);
        view("work",compact("works"));
    }
}