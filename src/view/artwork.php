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
                <div id="artwork_creater">
                    <div id="artwork_creater_img">
                    </div>
                </div>
                <p><?=enc($data["work_content"])?></p>
            </div>
        </div>
    </div>
</div>