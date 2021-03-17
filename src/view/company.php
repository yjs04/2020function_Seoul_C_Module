<!-- visual -->
<div id="visual" class="subpage">
    <img src="resource/image/sub1.gif" alt="sub_visual">
</div>
<!-- /visual -->

<!-- content -->
<div id="content">
    <div class="sub_title_wrap container">
        <h5><a href="#">한지상품판매관</a> <i class="fas fa-angle-right"></i> <a href="/overview">한지업체</a></h5>
        <h2>한지업체</h2>
    </div>

    <div class="content_wrap container" id="great_company_list">
        <div class="content_title">
            <h2 class="border-pink text-pink">우수 업체</h2>
        </div>
        <div class="content_box">
        <?php if($data['great_list'] !== []):?>
        <?php foreach($data['great_list'] as $item):?>
        <div class="company-item p-4 m-4">
            <div class="company-item-img">
                <img src="uploads/<?=$item->image?>" alt="company-img">
            </div>
            <div class="company-item-info">
                <h5><?=$item->user_name?></h5>
                <p><?=$item->user_email?></p>
                <span>누적포인트 : <?=$item->company_point?>p</span>
                <div class="best_company p-2 bc-pink text-white">우수업체</div>
            </div>
        </div>
        <?php endforeach;?>
        <?php else:?>
            <div class="w-100 p-2 text-center bc-gray">우수 업체가 없습니다!</div>
        <?php endif;?>
        </div>
    </div>

    <div class="content_wrap container" id="company_list">
        <div class="content_title">
            <h2 class="border-pink text-pink">모든 업체</h2>
        </div>
        <div class="content_box">
        <?php if($data['list'] !== []):?>
        <?php foreach($data['list']->data as $item):?>
        <div class="company-item p-4 m-4">
            <div class="company-item-img">
                <img src="uploads/<?=$item->image?>" alt="company-img">
            </div>
            <div class="company-item-info">
                <h5><?=$item->user_name?></h5>
                <p><?=$item->user_email?></p>
                <span>누적포인트 : <?=$item->company_point?>p</span>
            </div>
        </div>
        <?php endforeach;?>
        <?php else:?>
            <div class="w-100 p-2 text-center bc-gray">업체가 없습니다.</div>
        <?php endif;?>
        <nav aria-label="Page navigation" class="m-3">
            <ul class="pagination m-0">
                <?php if($data["list"]->prev):?>
                <li class="page-item"><a class="page-link" href="/company?page<?=$data["list"]->start - 1?>" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-angle-left"></i></span></a></li>
                <?php endif;?>
                <?php for($i = $data["list"]->start; $i <= $data["list"]->end; $i++):?>
                <li class="page-item <?= $i == $data["list"]->page ? "active" : "" ?>"><a class="page-link" href='/company?page=<?=$i?>'><?=$i?></a></li>
                <?php endfor;?>
                <?php if($data["list"]->next):?>
                <li class="page-item"><a class="page-link" href="/company?page<?=$data["list"]->end + 1?>" aria-label="Next"><span aria-hidden="true"><i class="fas fa-angle-right"></i></span></a></li>
                <?php endif;?>
            </ul>
        </nav>
        </div>
    </div>
</div>
<!-- /content -->