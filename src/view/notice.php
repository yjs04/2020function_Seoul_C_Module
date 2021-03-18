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
                    <?php foreach(json_decode($data["notice"]->files) as $item):?>
                    <div class="notice_file">
                        <p><?=$item?><span class="ml-1">[<?= filesize(UPLOAD."/$item") / 1024 < 1 ? filesize(UPLOAD."/$item")."byte" : filesize(UPLOAD."/$item") / 1024 / 1024 < 1 ? round((filesize(UPLOAD."/$item") / 1024),1)."KB" : round((filesize(UPLOAD."/$item") / 1024 / 1024),1)."MB" ?>]</span></p>
                        <a href="/uploads/<?=$item?>" class="notice_file_dl" download>다운로드</a>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

    <div id="mod_popup" class="modal fade" tabindex="1">
        <div class="modal-dialog popup overflow-hidden">
            <div class="modal-content rounded-0 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title">공지사항 수정</h5>
                    <button class="close" id="mod_close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="mod_form" method="post" action="/noticeMod/<?=$data['notice']->id?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="form-label">제목</label>
                            <input type="text" id="title" name="title" class="form-control" required value="<?=$data["notice"]->title?>">
                            <p class="form-text pl-2 text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="content" class="form-label">내용</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10" required><?=$data["notice"]->content?></textarea>
                            <p class="form-text pl-2 text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="filename" id="filename" hidden value='<?=($data["notice"]->files)?>'>
                            <label for="files" class="form-label">파일</label>
                            <input type="file" name="files[]" class="form-control" multiple id="files">
                            <p class="form-text pl-2 text-danger"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 rounded-0 p-0">
                    <button class="btn rounded-0 text-white w-100 p-2 bc-pink" id="notice_add">수정 완료</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /content -->

<script>
    if(document.querySelector("#notice_del_btn")){
        document.querySelector("#notice_del_btn").addEventListener("click",e=>{
            if(confirm("해당 공지사항을 삭제하시겠습니까?")){
                let id = e.target.dataset.id;
                $.ajax({
                    url:"/noticeDel"+id,
                    method:"post",
                    data:{},
                    success(){
                        location.href = "/notices";
                    }
                });
            }
        });
    }

    if(document.querySelector("#notice_add")){
        document.querySelector("#notice_add").addEventListener("click",e=>{
            document.querySelector("#mod_form").submit();
        });
    }
</script>