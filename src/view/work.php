<!-- visual -->
<div id="visual" class="subpage">
    <img src="resource/image/sub2.gif" alt="sub2_visual">
</div>
<!-- /visual -->

<!-- content -->
<div id="content" class="work_page">
    <div class="sub_title_wrap container">
        <h5><a href="#">한지공예대전</a> <i class="fas fa-angle-right"></i> <a href="/work">참가작품</a></h5>
        <h2>참가작품</h2>
    </div>
    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">우수 작품</h2>
        </div>

        <div class="content_box" id="great_work_area">
            <?php if($data["works"] !== []):?>
            <?php foreach($data["works"] as $item):?>
            <div class="gallery_img_wrap">
                <div class="gallery_img_box">
                    <img src="uploads/<?=$item->work_img?>" alt="gallery_img">
                    <span class="text-white">우수작품</span>
                </div>
                <div class="gallery_title">
                    <h3><?=$item->work_name?></h3>
                    <p class='m-0'>제작자 : <?=$item->creater_name?></p>
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
        </div>
    </div>

    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">모든 작품</h2>
        </div>
        <div class="content_box" id="all_work_area">

        </div>
    </div>

    <?php if(user()):?>
    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">등록한 작품</h2>
        </div>
        <div class="content_box" id="entry_work_area">
            
        </div>
    </div>
    <?php endif;?>
</div>
<!-- /content -->