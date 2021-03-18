<?php

namespace Controller;

use App\DB;

class ActionController{
    function worksAddProcess(){
        if(admin()) return go("/entry","관리자는 수행할 수 없는 기능입니다.");
        checkEmpty();
        extract($_POST);

        $work_img = base64_upload($image);
        $sql = "INSERT INTO works(`creater_id`,`work_name`,`work_img`,`creater_type`,`create_date`,`work_tags`,`work_content`,`creater_name`) VALUES(?,?,?,?,?,?,?,?)";
        DB::query($sql,[user()->id,$work_name,$work_img,user()->type,date('Y-m-d'),$work_tags,$work_content,user()->user_name]);

        go("/entry","작품이 등록되었습니다.");
    }

    function inventoryAddProcess(){
        checkEmpty();
        extract($_POST);

        $sql = "SELECT * FROM inventory WHERE `user_id` = ? ";
        $result = DB::fetchAll($sql,[user()->id]);

        $list = json_decode($sell_list);

        $sell_basket = json_decode($sell_basket);
        foreach($sell_basket as $basket){
            $company = DB::fetch("SELECT * FROM users WHERE id = ?",[$basket->company_id]);
            $company_point = $company->point + $basket->sum;
            $c_point = $company->company_point + $basket->sum;
            $sql = "UPDATE users SET `point` = ?,`company_point` = ? WHERE id = ?";
            DB::query($sql,[$company_point,$c_point,$basket->company_id]);
        }

        $point = user()->point - $sell_point;

        $sql = "UPDATE users SET `point` = ? WHERE id = ?";
        DB::query($sql,[$point,user()->id]);

        if($result == []){
            $sql = "INSERT INTO inventory(`user_id`,`sell_list`) VALUES(?,?)";
            DB::query($sql,[user()->id,$sell_list]);
        }else{
            $sql = "UPDATE inventory SET sell_list = ? WHERE `user_id` = ?";
            DB::query($sql,[$sell_list,user()->id]);
        }
        
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

    function scoreAdd(){
        extract($_POST);

        $sql = "INSERT INTO scores(`val`,`work_id`,`giver_id`) VALUES(?,?,?)";

        DB::query($sql,[$val,$work_id,user()->id]);

        $sql = "SELECT SUM(val) AS score,COUNT(id) AS cnt FROM scores WHERE work_id = ?";
        $result = DB::fetch($sql,[$work_id]);
        $score = round((float)($result->score / $result->cnt),1);
        
        $sql = "UPDATE works SET `score` = ? WHERE id = ?";
        DB::query($sql,[$score,$work_id]);

        $point = DB::fetch("SELECT `point` FROM users WHERE id = ?",[$worker_id]);
        $point = $point->point + ($val * 100);
        DB::query("UPDATE users SET `point` = ? WHERE id = ?",[$point,$worker_id]); 

        echo json_encode(true);
    }

    function workDel(){
        extract($_POST);
        if(admin()){
            $sql = "UPDATE works SET `status` = ?, `del_content` = ? WHERE id = ?";
            DB::query($sql,["delete",$del_content,$id]);
        }else{
            $sql = "DELETE FROM `works` WHERE id = ?";
            DB::query($sql,[$id]);
        }

        echo json_encode(true);
    }

    function workMod(){
        extract($_POST);

        $sql = "UPDATE works SET `work_name` = ?,`work_content` = ?,`work_tags` = ? WHERE id = ?";
        DB::query($sql,[$work_name,$work_content,$work_tags,$id]);

        go("/artwork/$id","해당 작품이 수정되었습니다.");
    }

    function noticeAdd(){
        checkEmpty();
        extract($_POST);

        $files = $_FILES['files'];
        $fileLength = count($files['name']);

        $ff = $files['name'][0];
        
        $filenames = [];

        if($ff){
            for($i = 0; $i < $fileLength; $i++){
                $fname = $files['name'][$i];
                $tmp_name = $files['tmp_name'][$i];
                $filename = time()."-".$fname;

                $filenames[] = $filename;
                move_uploaded_file($tmp_name,UPLOAD."/$filename");
            }
        }

        $sql = "INSERT INTO notices(`title`,`content`,`files`,`write_date`) VALUES(?,?,?,?)";
        DB::query($sql,[$title,$content,json_encode($filenames),date('Y-m-d H:i:s')]);
        go("/notices","공지사항이 추가되었습니다.");
    }

    function noticeMod($id){
        checkEmpty();
        extract($_POST);

        $flag = DB::fetch("SELECT * FROM notices WHERE id = ?",[$id]);
        if(!$flag) back("대상을 찾을 수 없습니다.");

        $files = $_FILES['files'];
        $fileLength = count($files['name']);

        $ff = $files['name'][0];
        
        $filenames = json_decode($filename);

        if($ff && $fileLength){
            $filenames = [];
            for($i = 0; $i < $fileLength; $i++){
                $fname = $files['name'][$i];
                $tmp_name = $files['tmp_name'][$i];
                $size = $files['size'][$i];
                $filename = time()."-".$fname;

                if($size == 0 || $size > 1024 * 1024 * 10) back("파일은 10MB 이하만 업로드 가능합니다.");
                if($i > 3) back("파일은 4개까지만 업로드 가능합니다.");

                $filenames[] = $filename;
                move_uploaded_file($tmp_name,UPLOAD."/$filename");
            }
        }

        $sql = 'UPDATE notices SET `title` = ?, `content` = ?, `files` = ? WHERE id = ?';
        DB::query($sql,[$title,$content,json_encode($filenames),$id]);

        go("/notice/$id","공지사항이 정상적으로 수정되었습니다.");
    }

    function noticeDel($id){
        $flag = DB::fetch("SELECT * FROM notices WHERE id = ?",[$id]);
        if(!$flag) back("대상을 찾을 수 없습니다.");
 
        $sql = "DELETE FROM notices WHERE id = ?";
        DB::query($sql,[$id]);
        go("/notices","공지사항이 정상적으로 삭제되었습니다.");
    }

    function questionAdd(){
        checkEmpty();
        extract($_POST);

        if(strlen($question_title) > 50) back("제목은 50자 이하여야합니다!");
        $sql = "INSERT INTO question(`writer_id`,`title`,`content`,`write_date`) VALUES(?,?,?,?)";
        DB::query($sql,[user()->id,$question_title,$question_content,date('Y-m-d H:i:s')]);

        go("/question","문의가 등록되었습니다.");
    }

    function answerAdd($id){
        checkEmpty();
        extract($_POST);

        $sql = "UPDATE `question` SET `answer` = ?, `answer_date` = ?,`status` = ? WHERE id = ?";
        DB::query($sql,[$answer_content,date('Y-m-d H:i:s'),"fin",$id]);

        go("/question","답변이 등록되었습니다.");
    }
}