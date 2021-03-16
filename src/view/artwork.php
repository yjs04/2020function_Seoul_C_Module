<!-- visual -->
<div id="visual" class="subpage">
    <img src="/resource/image/sub2.gif" alt="sub2_visual">
</div>
<!-- /visual -->

<div id="content">
    <div class="sub_title_wrap container">
        <h5><a href="#">한지공예대전</a> <i class="fas fa-angle-right"></i> <a href="/artworks">참가작품</a> <i class="fas fa-angle-right"></i> <a href="/artwork/<?=$data["id"]?>">작품 상세보기</a></h5>
        <h2>작품 상세보기</h2>
    </div>

    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">작품 상세보기</h2>
        </div>
        <div class="content_box" id="artwork_page">
            <div id="artwork_img_box">
                <img src="/uploads/<?=$data["work_img"]?>" alt="artwork_img">
            </div>
            <div id="artwork_info">
                <div id="artwork_header">
                    <h5><?=$data["work_name"]?></h5>
                    <div id="artwork_header_box">
                        <div id="artwork_buttons">
                            <?php if(user() && $data['creater_id'] == user()->id):?>
                            <button class="artwork_btn">수정하기</button>
                            <?php endif;?>
                            <?php if((user() && $data['creater_id'] == user()->id) || admin()):?>
                            <button class="artwork_btn">삭제하기</button>
                            <?php endif;?>
                        </div>
                        <span id="artwork_date"><?=$data["create_date"]?></span>
                    </div>
                </div>
                <?php #var_dump($data);?>
                <div id="artwork_content">
                    <p><?=enc($data["work_content"])?></p>
                    <div id="artwork_content_footer">
                        <div id="artwork_hash_tags">
                            <?php foreach(json_decode($data['work_tags']) as $tag):?>
                            <span><?='#'.$tag?></span>
                            <?php endforeach;?>
                        </div>
                        <div id="artwork_stars">
                            <span id="artwork_star"><i class="fas fa-star mr-1"></i><?=$data['score']?></span>
                            <?php if(user() && !($data['creater_id'] == user()->id)):?>
                            <div id="artwork_score_add">
                                <input type="number" hidden name="score" id="score" value="5">
                                <p id="artwork_score_selected">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <button id="artwork_score_open"><i class="fas fa-angle-down"></i></button>
                                </p>
                                <div id="artwork_score_list">
                                    <p class="artwork_score_item" data-val="5">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="4.5">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="4">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="3.5">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="2.5">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="1.5">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="1">
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                    <p class="artwork_score_item" data-val="0.5">
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </p>
                                </div>
                                <button id="artwork_score_add_btn" data-work_id="<?=$data["id"]?>" data-worker_id="<?=$data['creater_id']?>">확인</button>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>

                <div id="artwork_creater">
                    <div id="artwork_creater_img">
                        <img src="/uploads/<?=$data['image']?>" alt="creater_img">
                    </div>
                    <div id="artwork_creater_info">
                        <p class="m-0"><?=$data['creater_name']?>(<?=$data['user_email']?>)</p>
                        <p class="m-0"><?=$data['creater_type'] == "company" ? "기업" : "일반"?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="module" src="/resource/js/tag.js"></script>
<script type="module" src="/resource/js/artwork.js"></script>