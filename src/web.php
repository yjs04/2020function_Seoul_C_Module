<?php

use App\Router;

Router::get("/","ViewController@index");
Router::get("/overview","ViewController@overview");
Router::get("/roadmap","ViewController@roadmap");
Router::get("/store","ViewController@store","user");
Router::get("/entry","ViewController@entry","user");
Router::get("/artworks","ViewController@artworks");
Router::get("/artwork/{id}","ViewController@artwork");
Router::get("/company","ViewController@company");
Router::get("/notices","ViewController@notices","user");
Router::get("/notice/{id}","ViewController@notice","user");
Router::get("/question","ViewController@question","user");

// guest
Router::get("/join","ViewController@join","guest");
Router::get("/userInfo/{user_email}","AjaxController@userInfo");
Router::post("/joinProcess","ActionController@joinProcess","guest");

Router::get("/login","ViewController@login","guest");
Router::post("/loginProcess","ActionController@loginProcess","guest");

Router::get("/logout","ActionController@logoutProcess","user");

Router::post("/paperAddProcess","ActionController@paperAddProcess","company");
Router::get("/storePapers","AjaxController@storePapers","user");

Router::get("/inventory","AjaxController@inventory","user");
Router::post("/inventoryAddProcess",'ActionController@inventoryAddProcess',"user");

Router::get("/entryPapers","AjaxController@entryPapers","user");
Router::post("/entryUpdatePapers","AjaxController@entryUpdatePapers","user");
Router::post("/worksAddProcess","ActionController@worksAddProcess","user");
Router::get("/entryTag","AjaxController@entryTag");

Router::post("/workMod","ActionController@workMod","user");
Router::post("/workDel","ActionController@workDel","user");
Router::post("/scoreAdd","ActionController@scoreAdd","user");

Router::post("/noticeAdd","ActionController@noticeAdd","admin");
Router::post("/noticeMod/{id}","ActionController@noticeMod","admin");
Router::post("/noticeDel/{id}","ActionController@noticeDel","admin");

Router::post("/questionAdd","ActionController@questionAdd","user");
Router::post("/answerAdd/{id}","ActionController@answerAdd","admin");
Router::get("/loadQuestion/{id}","AjaxController@loadQuestion","user");

Router::start();