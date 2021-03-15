<?php

namespace Controller;

use App\DB;

class ViewController{
    function index(){
        $sql = "SELECT * FROM works WHERE `status` = ? ORDER BY `id` DESC LIMIT 3";
        $works = DB::fetchAll($sql,["normal"]);
        view("index",compact("works"));
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

    function artworks(){
        $sql = "SELECT * FROM works WHERE `create_date` >= ? AND `status` = ? ORDER BY `score` DESC LIMIT 4";
        $best_works = DB::fetchAll($sql,[date('Y-m-d',strtotime("-7 days")),"normal"]);

        $sql = "SELECT * FROM works WHERE `status` = ? ORDER BY `id` DESC";
        $work = DB::fetchAll($sql,["normal"]);
        $works = pagination($work);

        $work_user = [];

        if(user()){
            $sql = "SELECT * FROM works WHERE creater_id = ? ORDER BY `id` DESC";
            $work_user = DB::fetchAll($sql,[user()->id]);
        }

        view("artworks",compact("best_works","works","work_user"));
    }

    function artwork($id){
        $sql = "SELECT U.user_email, U.image, W.* FROM works AS W, users AS U WHERE W.id = ? AND W.creater_id = U.id";
        $work = DB::fetch($sql,[$id]);
        $work = (array) $work;
        view("artwork",$work);
    }
}