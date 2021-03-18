<?php

namespace Controller;

use App\DB;

class ViewController{
    function index(){
        $sql = "SELECT * FROM works WHERE `status` = ? ORDER BY `id` DESC LIMIT 3";
        $works = DB::fetchAll($sql,["normal"]);

        $sql = "SELECT * FROM notices ORDER BY `id` DESC LIMIT 5";
        $notices = DB::fetchAll($sql);

        view("index",compact("works","notices"));
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

        $flag = false;
        if(user() && user()->id !== $work['creater_id']){
            $sql = "SELECT * FROM scores WHERE giver_id = ? AND work_id = ?";
            $result = DB::fetch($sql,[user()->id,$id]);
            if(!$result) $flag = true;
        }
        $work['star_flag'] = $flag;
        view("artwork",$work);
    }

    function company(){
        $sql = 'SELECT * FROM users WHERE `type` = ? ORDER BY `company_point` DESC LIMIT 4';
        $great_list = DB::fetchAll($sql,["company"]);

        $sql = "SELECT * FROM users WHERE `type` = ?";
        $result = DB::fetchAll($sql,["company"]);

        $list = [];
        foreach($result as $data){
            $flag = true;
            foreach($great_list as $great){if($data->id == $great->id) $flag = false;}
            if($flag) $list[] = $data;
        }
        $list = pagination($list);

        view("company",compact("great_list","list"));
    }

    function notices(){
        $sql = "SELECT * FROM notices ORDER BY `id` DESC";
        $notice = DB::fetchAll($sql);
        $notices = pagination($notice);
        view("notices",compact("notices"));
    }

    function notice($id){
        $sql = "SELECT * FROM notices WHERE id = ?";
        $notice = DB::fetch($sql,[$id]);
        $files = json_decode($notice->files);

        view("notice",compact("notice"));
    }

    function question(){
        view("question");
    }
}