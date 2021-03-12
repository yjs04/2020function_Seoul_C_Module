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
        $result = DB::fetchAll($sql,[user()->id]);
        echo json_encode($result);
    }