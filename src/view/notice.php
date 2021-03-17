<!-- visual -->
<div id="visual" class="subpage">
    <img src="/resource/image/sub1.gif" alt="subpage_visual">
</div>
<!-- /visual -->

<!-- content -->
<div id="content">
    <div class="sub_title_wrap container">
        <h5><a href="#">축제공지사항</a> <i class="fas fa-angle-right"></i> <a href="/notices">알려드립니다</a> <i class="fas fa-angle-right"></i> <a href="/notice/<?=$data['notice']->id?>">공지사항 상세보기</a></h5>
        <h2>공지사항 상세보기</h2>
    </div>
    <div class="content_wrap container" id="notice_page">
        <div class="content_box">
            <div id="notice_header">
                <h5>#<?=$data["notice"]->id?></h5>
                <h2><?=$data["notice"]->title?></h2>
                <div id="notice_header_info">
                    <p class="m-0"><?=$data["notice"]->write_date?></p>
                    <?php if(admin()):?>
                    <div id="notice_buttons">
                        <button class="notice_btn mr-1" id="notice_mod_btn" data-toggle="modal" data-target="#mod_popup">수정하기</button>
                        <button class="notice_btn" id="notice_del_btn" data-id="<?=$data["notice"]->id?>">삭제하기</button>
                    </div>
                    <?php endif;?>
                </div>
            </div>
            <div id="notice_content">
                <p class="m-0"><?=enc($data["notice"]->content)?></p>
                <div id="notice_files">
                    <p>첨부파일</p>
                    <div class="notice_file">
                        <p>파일 이름 <span>[3MB]</span></p>
                        <button class="notice_file_dl">다운로드</button>
                    </div>
                    <div class="notice_file">
                        <p>파일 이름 <span>[3MB]</span></p>
                        <button class="notice_file_dl">다운로드</button>
                    </div>
                    <div class="notice_file">
                        <p>파일 이름 <span>[3MB]</span></p>
                        <button class="notice_file_dl">다운로드</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->