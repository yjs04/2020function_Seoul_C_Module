<?php

use App\Router;

Router::get("/","ViewController@index");
Router::get("/overview","ViewController@overview");
Router::get("/roadmap","ViewController@roadmap");
Router::get("/store","ViewController@store","user");
Router::get("/entry","ViewController@entry","user");
Router::get("/work","ViewController@work");

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
Router::get("/entryTag","AjaxController@entryTag","user");

Router::start();