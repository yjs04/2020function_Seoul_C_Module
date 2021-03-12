<?php

use App\DB;

function user(){
    if(isset($_SESSION['user'])){
        $user = DB::find("users",$_SESSION['user']->id);

        if(!$user){
            go("/logout","회원 정보를 찾을 수 없어 로그아웃 되었습니다.");
        }

        $_SESSION['user'] = $user;
        return $_SESSION['user'];
    }else return false;
}

function company(){
    return user() && user()->type === "company";
}

function admin(){
    return user() && user()->type === "admin";
}

function go($url,$msg=""){
    echo "<script>";
    echo "alert('$msg');";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($msg=""){
    echo "<script>";
    echo "alert('$msg');";
    echo "history.back();";
    echo "</script>";
    exit;
}

function view($viewName,$data=[]){
    extract($data);
    include_once VIEW."/header.php";
    include_once VIEW."/$viewName.php";
    include_once VIEW."/footer.php";
    exit;
}

function checkEmpty(){
    foreach($_POST as $input){
        if(!is_array($input) && trim($input) === "") back("모든 정보를 입력해 주세요!");
    }
}

function extname($filename){
    return strtolower(substr($filename,strrpos($filename,".")));
}

function isImage($filename){
    return in_array(extname($filename),['.jpg','jpeg','.png','.gif']);
}

function enc($output){
    return nl2br(str_replace(" ","&nbsp;",htmlentities($output)));
}

function json_response($data){
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
}

function pagination($data){
    define("LIST_LENGTH",9);
    define("BLOCK_LENGTH",5);

    $page = isset($_GET['page']) && is_numberic($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;

    $totalPage= ceil(count($data)/LIST_LENGTH);

    $block = ceil($page / BLOCK_LENGTH);
    $end = $block * BLOCK_LENGTH;
    $start = $end - BLOCK_LENGTH + 1;

    $next = true;
    $prev = true;

    if($end >= $totalPage){
        $end = $totalPage;
        $next = false;
    }

    if($start <= 1){
        $start = 1;
        $prev = false;
    }

    $data = array_slice($data,($page - 1) * LIST_LENGTH);
    return (object) compact("start","end","data","next","prev");
}

function init(){
    $sql = "SELECT * FROM users WHERE `type` = ?";
    $result = DB::fetch($sql,["admin"]);
    if(!$result){
        $sql = "INSERT INTO users(`user_email`,`user_name`,`password`,`image`,`type`) VALUES(?,?,?,?,?)";
        DB::query($sql,["admin","관리자",1234,"","admin"]);
    }
}