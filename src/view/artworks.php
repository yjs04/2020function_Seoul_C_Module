<!-- visual -->
<div id="visual" class="subpage">
    <img src="resource/image/sub2.gif" alt="sub2_visual">
</div>
<!-- /visual -->

<!-- content -->
<div id="content" class="work_page">
    <div class="sub_title_wrap container">
        <h5><a href="#">한지공예대전</a> <i class="fas fa-angle-right"></i> <a href="/artworks">참가작품</a></h5>
        <h2>참가작품</h2>
    </div>
    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">우수 작품</h2>
        </div>

        <div class="content_box" id="great_work_area">
            <?php if($data["best_works"] !== []):?>
            <?php foreach($data["best_works"] as $item):?>
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
        </div>
    </div>

    <div class="content_wrap container">
        <div class="content_title"  id="all_work_area">
            <h2 class="border-blue text-blue">모든 작품</h2>
            <div id="search" class="hash">
                <div id="search_input" class="hash_input">
                    <input type="text" id="search_word" class="hash_word" placeholder="자유롭게 입력해주세요.">
                    <span>#</span>
                </div>
                <div id="search_value" class="hash_value"></div>
                <div id="search_errorMsg" class="hash_errorMsg"></div>
                <div id="search_hash_box" class="auto_hash_box"></div>
            </div>
        </div>
        <div class="content_box" id="all_work_area">
        
        <?php if($data["works"] !== []): ?>
        <?php foreach($data['works']->data as $item):?>
        <div class="gallery_img_wrap" data-id="<?=$item->id?>">
            <div class="gallery_img_box">
                <img src="uploads/<?=$item->work_img?>" alt="gallery_img">
                <p class="text-white"><?=$item->create_date?></p>
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
        <?php else: ?>
            <div class="bc-gray p-3 w-100 text-center">작품이 없습니다!</div>
        <?php endif;?>
        <nav aria-label="Page navigation" class="m-3">
            <ul class="pagination m-0">
                <?php if($data["works"]->prev):?>
                <li class="page-item"><a class="page-link" href="/artworks?page<?=$data["works"]->start - 1?>" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-angle-left"></i></span></a></li>
                <?php endif;?>
                <?php for($i = $data["works"]->start; $i <= $data["works"]->end; $i++):?>
                <li class="page-item <?= $i == $data["works"]->page ? "active" : "" ?>"><a class="page-link" href="/artworks?page=<?=$i?>"><?=$i?></a></li>
                <?php endfor;?>
                <?php if($data["works"]->next):?>
                <li class="page-item"><a class="page-link" href="/artworks?page<?=$data["works"]->end + 1?>" aria-label="Next"><span aria-hidden="true"><i class="fas fa-angle-right"></i></span></a></li>
                <?php endif;?>
            </ul>
        </nav>
        </div>
    </div>

    <?php if(user()):?>
    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">등록한 작품</h2>
        </div>
        <div class="content_box" id="entry_work_area">
        <?php if($data["work_user"] !== []):?>
        <?php foreach($data["work_user"] as $item):?>
        <div class="gallery_img_wrap" data-id="<?=$item->status !== "normal" ? "" : $item->id?>">
            <div class="gallery_img_box">
                <img src="uploads/<?=$item->work_img?>" alt="gallery_img">
                <p class="text-white"><?=$item->create_date?></p>
                <?php if($item->status !== "normal"):?>
                <div class="work_delete">
                    <h5>* 삭제됨</h5>
                    <p>사유 : <?=$item->del_content?></p>
                </div>
                <?php endif;?>
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
        <?php endif;?>
        </div>
    </div>
    <?php endif;?>
</div>
<!-- /content -->

<script type="module" src="resource/js/tag.js"></script>
<script type="module" src="resource/js/artwork.js"></script>