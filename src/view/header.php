<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전주한지문화축제</title>
    <link rel="stylesheet" href="/resource/bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="/resource/fontawesome-free-5.1.0-web/css/all.css">
    <link rel="stylesheet" href="/resource/css/common.css">
    <link rel="stylesheet" href="/resource/css/style.css">

    <script src="/resource/js/jquery-3.4.1.min.js"></script>
    <script src="/resource/bootstrap-4.3.1-dist/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div id="wrap">
        <!-- header -->
        <header>
            <!-- logo -->
            <div id="logo">
                <a href="/"><img src="/resource/image/logo.png" alt="logo"></a>
            </div>
            <!-- nav -->
            <input type="radio" class="not_pc" hidden name="nav_open" id="nav_close" checked>
            <input type="radio" class="not_pc" hidden name="nav_open" id="nav_open">
            <label for="nav_open" class="not_pc" id="nav_open_label"><i class="fas fa-bars"></i></label>
            <label for="nav_close" class="not_pc" id="nav_close_label"></label>
            <nav>
                <ul>
                    <li>
                        <a href="/">전주한지문화축제</a>
                        <ul class="sub_menu">
                            <li><a href="/overview">개요/연혁</a></li>
                            <li><a href="/roadmap">찾아오시는길</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">한지상품판매관</a>
                        <ul class="sub_menu">
                            <li><a href="/company">한지업체</a></li>
                            <li><a href="/store">온라인스토어</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">한지공예대전</a>
                        <ul class="sub_menu">
                            <li><a href="/entry">출품신청</a></li>
                            <li><a href="/artworks">참가작품</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">축제공지사항</a>
                        <ul class="sub_menu">
                            <li><a href="/notices">알려드립니다</a></li>
                            <li><a href="/question">1:1문의</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="sub_menu_bc"></div>
            <!-- user -->
            <div id="user">
                <?php if(user()): ?>
                    <span><?=user()->user_name?>(<?=user()->point?>p)</span>
                    <a href="/logout" class="user_btn">로그아웃</a>
                <?php else:?>
                    <a href="/login" class="user_btn">로그인</a>
                    <a href="/join" class="user_btn">회원가입</a>
                <?php endif;?>
            </div>
        </header>