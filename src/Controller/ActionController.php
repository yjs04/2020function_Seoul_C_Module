<?php

namespace Controller;

use App\DB;

class ActionController{
    function inventoryAddProcess(){
        checkEmpty();
        extract($_POST);

        $sql = "INSERT INTO inventory(`user_id`,`sell_list`,`sum`) VALUES(?,?,?)";

        $sum = 0;
        $list = json_decode($sell_list);
        foreach($list as $item){$sum += $item->sum;}
        DB::query($sql,[user()->id,$sell_list,$sum]);
        echo json_encode(true);
    }

    function joinProcess(){
        checkEmpty();
        extract($_POST);

        $sql = "INSERT INTO users(`user_email`,`user_name`,`password`,`image`,`type`) VALUES(?,?,?,?,?)";

        $file = $_FILES['image'];
        $filename = time().extname($file['name']);
        move_uploaded_file($file['tmp_name'],UPLOAD."/$filename");

        DB::query($sql,[$user_email,$user_name,$password,$filename,$type]);
        go("/login","회원 가입되었습니다.");
    }

    function loginProcess(){
        checkEmpty();
        extract($_POST);
        $user = DB::who($user_email);
        if(!$user) back("아이디와 일치하는 회원이 존재하지 않습니다.");
        if($user->password !== $password)back("비밀번호가 일치하지 않습니다.");

        $_SESSION['user'] = $user;
        go("/","로그인에 성공했습니다.");
    }

    function logoutProcess(){
        if(user()){
            session_destroy();
            go("/","로그아웃에 성공했습니다.");
        }
    }

    function paperAddProcess(){
        checkEmpty();
        extract($_POST);

        $sql = "INSERT INTO papers(`image`,`paper_name`,`company_name`,`company_id`,`width_size`,`height_size`,`point`,`hash_tags`) VALUES(?,?,?,?,?,?,?,?)";

        $file = $_FILES['image'];
        $filename = time().extname($file['name']);
        move_uploaded_file($file['tmp_name'],UPLOAD."/$filename");

        DB::query($sql,[$filename,$paper_name,user()->user_name,user()->id,$width_size."px",$height_size."px",$point."p",$hash_tags]);
        go("/store","한지가 추가되었습니다.");
    }

}