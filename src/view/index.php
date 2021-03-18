        <!-- visual -->
        <div id="visual">
            <input type="radio" name="slide_status" id="slide_stop" class="slide_btn" hidden >
            <input type="radio" name="slide_status" id="slide_play" class="slide_btn" hidden checked>

            <input type="radio" name="slide_btn" id="slide_btn1" class="slide_btn" hidden>
            <input type="radio" name="slide_btn" id="slide_btn2" class="slide_btn" hidden>
            <input type="radio" name="slide_btn" id="slide_btn3" class="slide_btn" hidden>

            <input type="radio" name="slide_btn" id="slide_btn1-copy" class="slide_btn" hidden>
            <input type="radio" name="slide_btn" id="slide_btn2-copy" class="slide_btn" hidden>
            <input type="radio" name="slide_btn" id="slide_btn3-copy" class="slide_btn" hidden>

            <div id="slide">
                <img src="resource/image/slide1.jpg" alt="slide_img" class="slide_img">
                <img src="resource/image/slide2.jpg" alt="slide_img" class="slide_img">
                <img src="resource/image/slide3.jpg" alt="slide_img" class="slide_img">
                <img src="resource/image/slide1.jpg" alt="slide_img" class="slide_img">
            </div>

            <div id="slide_word">

                <div class="slide_word_box" id="slide1_word_box">
                    <div id="slide1_word_wrap">
                        <h5>24회 전주한지문화축제</h5>
                        <h2><span>전주,</span> 한지로 꽃피다</h2>
                        <p> 온라인으로 사랑하는 친구, 연인, 가족과 함께<br>
                            꿈 같은 축제를 경험해보세요.
                        </p>
                        <button>더보기</button>
                    </div>
                </div>

                <div class="slide_word_box" id="slide2_word_box">
                    <div id="slide2_word_wrap">
                        <h2>천 년 한지 이야기로 여러분을 초대합니다.</h2>
                        <p>개최기간 : 2020년 9월 18일(금) ~ 9월 20일(일)</p>
                        <button><span><i class="fas fa-plus"></i></span></button>
                    </div>
                </div>

                <div class="slide_word_box" id="slide3_word_box">
                    <div id="slide3_word_wrap">
                        <p>전라죽도 전주에서 열리는</p>
                        <h2>전주한지문화축제</h2>
                        <h5>Jeonju Hanji Culture Festival 2020</h5>
                    </div>
                </div>

            </div>

            <div id="slide_btn_box">
                <div class="slide_btn_wrap">
                    <label for="slide_btn1" id="slide1_btn_label" class="slide_btn_label"></label>
                    <label for="slide_btn1-copy" id="slide1_btn_label-copy" class="slide_btn_label-copy"></label>
                </div>
                <div class="slide_btn_wrap">
                    <label for="slide_btn2" id="slide2_btn_label" class="slide_btn_label"></label>
                    <label for="slide_btn2-copy" id="slide2_btn_label-copy" class="slide_btn_label-copy"></label>
                </div>
                <div class="slide_btn_wrap">
                    <label for="slide_btn3" id="slide3_btn_label" class="slide_btn_label"></label>
                    <label for="slide_btn3-copy" id="slide3_btn_label-copy" class="slide_btn_label-copy"></label>
                </div>
            </div>

            <div id="slide_control">
                <label for="slide_stop" id="slide_stop_btn" class="slide_control_btn"><i class="fas fa-stop"></i></label>
                <label for="slide_play" id="slide_play_btn" class="slide_control_btn"><i class="fas fa-play"></i></label>
            </div>
        </div>
        <!-- content -->
        <div id="content">
            <div class="content_wrap container" id="intro">
                <div class="content_title">
                    <h2>축제소개</h2>
                </div>
                <div class="content_box">
                    <div id="intro_content">
                        <div id="intro_img">
                            <img src="resource/image/intro.jpg" alt="introduce-festival">
                        </div>
                        <div id="intro_word">
                            <h4>전주한지문화축제</h4>
                            <h6>
                                전주, 한지로 꽃피다<br>
                                천 년 한지 이야기로 여러분을 초대합니다.
                            </h6>
                            <p>
                                1997년부터 시작되어
                                우리 한지를 널리 알리는 전주한지문화축제
                                온라인으로 사랑하는 친구, 연인, 가족과 함께
                                꿈 같은 축제를 경험해보세요.
                            </p>
                            <div class="border-design border-white end"></div>
                        </div>
                    </div>
                    <div id="intro_link">
                        <a href="/overview"><div class="intro_link_hover"></div><span>축제개요</span><div class="border-design left border-pink"></div><div class="border-design right border-pink"></div></a>
                        <a href="/roadmap"><div class="intro_link_hover"></div><span>오시는 길</span><div class="border-design left border-pink"></div><div class="border-design right border-pink"></div></a>
                        <a href="/store"><div class="intro_link_hover"></div><span>한지 스토어</span><div class="border-design left border-pink"></div><div class="border-design right border-pink"></div></a>
                        <a href="/entry"><div class="intro_link_hover"></div><span>출품 신청</span><div class="border-design left border-pink"></div><div class="border-design right border-pink"></div></a>
                        <a href="/work"><div class="intro_link_hover"></div><span>참가 작품</span><div class="border-design left border-pink"></div><div class="border-design right border-pink"></div></a>
                    </div>
                </div>
            </div>
            <div class="content_wrap container" id="notice">
                <div class="content_title">
                    <h2>알려드립니다</h2>
                </div>
                <div class="content_box">
                    <?php if($data["notices"] !== []):?>
                    <div id="notice_box">
                        <div id="notice_title">
                            <h5><?=$data["notices"][0]->title?></h5>
                            <p><?=$data["notices"][0]->write_date?></p>
                        </div>
                        <p><?=enc($data["notices"][0]->content)?></p>
                        <a href="notice/<?=$data["notices"][0]->id?>"><i class="fas fa-plus"></i></a>
                        <div class="border-design bottom border-orange"></div>
                        <div class="border-design bottom border-orange notice-border"></div>
                    </div>
                    <?php if(count($data["notices"])> 1):?>
                    <ul id="notice_list">
                        <?php for($i = 1; $i < count($data["notices"]); $i++):?>
                        <li>
                            <a href="/notice/<?=$data["notices"][$i]->id?>" class="notice_readmore"><i class="fas fa-angle-right"></i></a>
                            <div></div>
                            <a href="/notice/<?=$data["notices"][$i]->id?>">
                                <span class="notice_title"><?=$data["notices"][$i]->title?></span>
                                <span class="notice_day"><?=$data["notices"][$i]->write_date?></span>
                            </a>
                        </li>
                        <?php endfor;?>
                    </ul>
                    <?php endif;?>
                    <?php else:?>
                    <div class="w-100 p-4 text-center bc-gray">공지사항이 없습니다.</div>
                    <?php endif;?>
                    <a href="/notices" id="notice_button">알려드립니다<i class="fas fa-angle-right"></i></a>
                </div>
            </div>

            <div class="content_wrap container" id="gallery">
                <div class="content_title">
                    <h2>공예대전 갤러리</h2>
                </div>
                <div class="content_box">
                    <div id="gallery_box">
                    <?php if($data["works"] !== []):?>
                    <?php foreach($data["works"] as $item):?>
                    <div class="gallery_img_wrap" data-id="<?=$item->id?>">
                        <div class="gallery_img_box">
                            <img src="uploads/<?=$item->work_img?>" alt="gallery_img">
                            <span class="text-white">우수작품</span>
                            <p class="text-white"><?=$item->create_date?></p>
                        </div>
                        <div class="gallery_title">
                            <h3><?=$item->work_name?></h3>
                            <p class='m-0'>제작자 : <?=$item->creater_name?> (<?=$item->creater_type == "user" ? "일반" : "기업"?>)</p>
                            <div class="gallery_info">
                                <p class="gallery_hash m-0"><?php foreach(json_decode($item->work_tags) as $tags):?><span>#<?=$tags?></span><?php endforeach;?></p>
                                <span class="gallery_star "><i class="fas fa-star text-yellow"></i> <?=$item->score?></span>
                            </div>
                        </div>
                        <div class="gallery_border_box"><div class="gallery_border"></div></div>
                        <div class="gallery_border_left"></div>                            
                        <div class="gallery_border_bottom"></div>
                    </div>
                    <?php endforeach;?>
                    <?php else:?>
                    <div class="bc-gray p-3 w-100 text-center">우수작품이 없습니다!</div>
                    <?php endif;?>
                        <button id="gallery_button">갤러리<i class="fas fa-angle-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="content_wrap container" id="support">
                <div class="content_title">
                    <h2>후원사</h2>
                </div>
                <div class="content_box">
                    <input type="radio" name="support_slide" id="support_stop" hidden>
                    <input type="radio" name="support_slide" id="support_play" hidden checked>
                    <div id="support_slide_btn" class="not_pc">
                        <label for="support_stop" id="support_stop_btn" class="support_slide_btn not_pc"><i class="fas fa-play"></i></label>
                        <label for="support_play" id="support_play_btn" class="support_slide_btn not_pc"><i class="fas fa-stop"></i></label>
                    </div>
                    <div id="support_slide">

                        <div class="support_img">
                            <img src="resource/image/support1.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support2.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support3.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support4.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support5.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support6.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support7.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support8.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support9.jpg" alt="support_img">
                        </div>

                        <div class="support_img">
                            <img src="resource/image/support10.jpg" alt="support_img">
                        </div>

                        <div class="support_img not_pc">
                            <img src="resource/image/support1.jpg" alt="support_img">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            window.onload = ()=>{
                function work(){
                    let img = document.querySelectorAll(".gallery_img_wrap");
                    img.forEach(x=>{
                        x.addEventListener("click",e=>{
                            let idx = e.target.dataset.id;
                            if(idx !== "") location.href = `/artwork/${idx}`;
                        });
                    })
                }

                work();
            }
        </script>