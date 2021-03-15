<?php

namespace Controller;

use App\DB;

class AjaxController{
    function userInfo($user_email){
        if($user_email === "admin") echo json_encode(user());
        else echo json_response(DB::who($user_email));
    }

    function storePapers(){
        $sql = "SELECT * FROM papers";
        $result = DB::fetchAll($sql);
        echo json_encode($result);
    }

    function inventory(){
        $sql = "SELECT * FROM inventory WHERE `user_id` = ?";
        $result = DB::fetch($sql,[user()->id]);
        if($result == []) $result = [];
        else $result = $result->sell_list;
        echo json_encode($result);
    }

    function entryPapers(){
        $sql = "SELECT * FROM inventory WHERE `user_id` = ?";
        $result = DB::fetch($sql,[user()->id]);
        
        if($result) $result = json_decode($result->sell_list);
        else $result = [];

        if(company()){
            $sql = "SELECT * FROM papers WHERE company_id = ?";
            $list = DB::fetchAll($sql,[user()->id]);
            foreach($list as $item){
                $item->num = '∞';
                $item->sum = '∞';
                $result[] = $item;
            }
        }

        echo json_encode($result);
    }

    function entryUpdatePapers(){
        extract($_POST);
        $list = json_decode($sell_list);
        $result = [];
        foreach($list as $item){if($item->num !== "∞") $result[] = $item;}
        $sql = "UPDATE inventory SET `sell_list` = ? WHERE `user_id` = ?";
        DB::query($sql,[json_encode($result),user()->id]);
        echo json_encode(true);
    }

    function entryTag(){
        $list = [];
        $sql = "SELECT work_tags FROM works";
        $tags = DB::fetchAll($sql);

        foreach($tags as $tag){
            $work_tag = json_decode($tag->work_tags);
            foreach($work_tag as $work){
                $flag = array_search($work,$list);
                if(!$flag) $list[] = $work;
            }
        }

        echo json_encode($list);
    }
}