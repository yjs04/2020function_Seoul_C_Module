<!-- visual -->
<div id="visual" class="subpage">
    <img src="resource/image/sub1.gif" alt="subpage_visual">
</div>
<!-- /visual -->

<!-- content -->
<div id="content">
    <div class="sub_title_wrap container">
        <h5><a href="#">축제공지사항</a> <i class="fas fa-angle-right"></i> <a href="/notices">알려드립니다</a></h5>
        <h2>알려드립니다</h2>
    </div>
    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-pink text-pink">공지사항</h2>
        </div>
        <div class="content_box" id="notice_area">
            <?php if(admin()):?>
            <div id="notice_button_box"><button class="notice_btn" id="notice_add_btn" data-toggle="modal" data-target="#notice_popup">공지 작성</button></div>
            <?php endif;?>

            <?php if($data['notices'] !== []):?>
            <table id="notice_table">
                <thead>
                </thead>
                <tbody>
                <?php foreach($data['notices']->data as $item):?>
                <tr data-id="<?=$item->id?>">
                    <td><?=$item->id?></td>
                    <td><?=$item->title?></td>
                    <td class="text-right"><?=$item->write_date?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>

            <nav aria-label="Page navigation" class="m-3">
                <ul class="pagination m-0">
                    <?php if($data['notices']->prev):?>
                    <li class="page-item"><a class="page-link" href="/notices?page<?=$data['notices']->start - 1?>" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-angle-left"></i></span></a></li>
                    <?php endif;?>
                    <?php for($i = $data['notices']->start; $i <= $data['notices']->end; $i++):?>
                    <li class="page-item <?= $i == $data['notices']->page ? "active" : "" ?>"><a class="page-link" href='/notices?page=<?=$i?>'><?=$i?></a></li>
                    <?php endfor;?>
                    <?php if($data['notices']->next):?>
                    <li class="page-item"><a class="page-link" href="/notices?page<?=$data['notices']->end + 1?>" aria-label="Next"><span aria-hidden="true"><i class="fas fa-angle-right"></i></span></a></li>
                    <?php endif;?>
                </ul>
            </nav>

            <?php else:?>
            <div class="w-100 text-center bc-gray p-4 ">등록된 공지사항이 없습니다!</div>
            <?php endif;?>

            <?php if(admin()):?>
            <div id="notice_popup" class="modal fade" tabindex="1">
                <div class="modal-dialog popup overflow-hidden">
                    <div class="modal-content rounded-0 border-0">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">공지사항 등록</h5>
                            <button class="close" id="mod_close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="notice_form" method="post" action="/noticeAdd" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title" class="form-label">제목</label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="form-label">내용</label>
                                    <textarea class="form-control" name="content" id="content" cols="30" rows="10" required></textarea>
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="mod_word" class="form-label">파일</label>
                                    <input type="file" name="files[]" multiple id="files">
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-0 rounded-0 p-0">
                            <button class="btn rounded-0 text-white w-100 p-2 bc-pink" id="notice_add">작성완료</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>

        </div>
    </div>
</div>
<!-- /content -->

<script>
    document.querySelector("#notice_add").addEventListener("click",()=>{
        let title = document.querySelector("#title").value;
        let content = document.querySelector("#notice_popup #content").value;
        let files = $("#files")[0].files;
        
        if(title === "") $("#title ~ p").html("제목을 입력해주세요.");
        else if(title.length >= 50) $("#title ~ p").html("제목은 50자 이하여야합니다.");
        else $("#title ~ p").html("");

        if(content === "") $("#notice_popup #content ~ p").html("내용을 입력해주세요.");
        else $("#notice_popup #content ~ p").html("");

        if(files.length === 0) $("#notice_popup #files ~ p").html("파일을 입력해주세요.");
        else if(files.length > 4) $("#notice_popup #files ~ p").html("파일은 최대 4개까지 업로드 가능합니다.");
        else {
            let flag = true;
            for(let i = 0; i < files.length; i++){
                let item = files[i];
                if(item.size >= 1024 * 1024 * 10) flag = false;
            }

            if(flag) $("#files ~ p").html("");
            else $("#files ~ p").html("파일은 최대 10MB 이하까지 업로드 할 수 있습니다.");
        }

        if($("#title ~ p").html() === "" && $("#notice_popup #content ~ p").html() === "" && $("#files ~ p").html() === "") document.querySelector("#notice_form").submit();
    });

    document.querySelectorAll("#notice_table tbody tr").forEach(x=>{
        x.addEventListener("click",e=>{
            let id = x.dataset.id;
            location.href = `/notice/${id}`;
        });
    });
</script>