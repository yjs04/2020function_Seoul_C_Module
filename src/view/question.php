<!-- visual -->
<div id="visual" class="subpage">
    <img src="resource/image/sub2.gif" alt="subpage_img">
</div>
<!-- /visual -->

<!-- content -->
<div id="content">
    <div class="sub_title_wrap container">
        <h5><a href="#">축제공지사항</a> <i class="fas fa-angle-right"></i> <a href="/question">1:1문의</a></h5>
        <h2>1:1문의</h2>
    </div>
    <div class="content_wrap container">
        <div class="content_title">
            <h2 class="border-blue text-blue">1:1문의</h2>
        </div>
        <div class="content_box">
        <?php if(!admin()):?>
        <div id="question_buttons_box">
            <button id="question_btn" data-toggle="modal" data-target="#question_popup">문의하기</button>
        </div>
        <?php endif;?>
        <?php if($data !== []):?>
        <table id="question_list">
            <thead></thead>
            <tbody>
            <?php foreach($data as $item):?>
                <tr>
                    <td data-toggle="modal" data-target="#question_list_popup" data-id="<?=$item->id?>" ><?=$item->status !== "fin" ? "진행 중" : "완료"?></td>
                    <td data-toggle="modal" data-target="#question_list_popup" data-id="<?=$item->id?>" ><?=$item->title?></td>
                    <td data-toggle="modal" data-target="#question_list_popup" data-id="<?=$item->id?>"  class="text-right"><?=$item->write_date?></td>
                    <?php if(admin() && $item->status !== "fin"):?>
                    <td class="question_answer_td"><button class="question_answer_btn" data-target="#answer_popup" data-toggle="modal" data-id="<?=$item->id?>">답변하기</button></td>
                    <?php endif;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php else:?>
        <div class="w-100 bc-gray p-4 text-center">문의 내역이 없습니다.</div>
        <?php endif;?>
        </div>
    </div>

    <div id="question_list_popup" class="modal fade" tabindex="1">
        <div class="modal-dialog popup overflow-hidden">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">상세내용</h5>
                    <button class="close" data-dismiss='modal'>&times;</button>
                </div>
                <div class="modal-body" id="question_list_content">
                    <div id="question_list_header">
                        <h5></h5>
                        <p></p>
                    </div>
                    <div id="question_list_content">
                        <p></p>
                    </div>
                    <div id="question_list_footer">
                        <p></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="question_popup" class="modal fade" tabindex="1">
        <div class="modal-dialog popup overflow-hidden">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">문의하기</h5>
                    <button class="close" data-dismiss='modal'>&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/questionAdd" id="question_form" method="post">
                        <div class="form-group">
                            <label for="question_title" method="post" class="form-label">제목</label>
                            <input type="text" class="form-control" id="question_title" name="question_title" required>
                        </div>
                        <div class="form-group">
                            <label for="question_content" class="form-label">내용</label>
                            <textarea name="question_content" class="form-control" id="question_content" cols="30" rows="10" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 rounded-0 p-0">
                    <button class="btn rounded-0 text-white w-100 p-2 bc-blue" id="question_add_btn">작성 완료</button>
                </div>
            </div>
        </div>
    </div>

    <div id="answer_popup" class="modal fade" tabindex="1">
        <div class="modal-dialog popup overflow-hidden">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">답변하기</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/answerAdd" method="post" id="answer_form">
                        <div class="form-group">
                            <label for="answer_content" class="form-label">내용</label>
                            <textarea name="answer_content" id="answer_content" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 rounded-0 p-0">
                    <button class="btn rounded-0 text-white w-100 p-2 bc-blue" id="answer_add_btn">작성 완료</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /content -->

<script>
    document.querySelector("#question_add_btn").addEventListener("click",()=>{document.querySelector("#question_form").submit()});
    document.querySelectorAll(".question_answer_btn").forEach(x=>{
        x.addEventListener("click",e=>{
            let id = e.target.dataset.id;
            document.querySelector("#answer_form").setAttribute("action","/answerAdd/"+id);
            document.querySelector("#answer_content").innerHTML = "";
        });
    });
    document.querySelector("#answer_add_btn").addEventListener("click",()=>{document.querySelector("#answer_form").submit();});
    document.querySelectorAll("#question_list tbody tr td").forEach(x=>{
        if(x.classList.contains("question_answer_td")) return false;
        x.addEventListener("click",async e=>{
            let id = e.currentTarget.dataset.id;
            let data = await fetch("/loadQuestion/"+id).then(res=>res.json());

            let list = document.querySelector("#question_list_content");
            list.innerHTML = `<div id="question_list_header">
                                    <h5>${data.title} <span>${data.write_date}</span></h5>
                                    <p>${data.user_name}(${data.user_email})</p>
                                </div>
                                <div id="question_list_content">
                                    <p>${data.content}</p>
                                </div>
                                <div id="question_list_footer" class="p-2">`;
            if(data.status == "watting") list.querySelector("#question_list_footer").innerHTML += `<div class="w-100 p-2 text-center">문의에 대한 답변이 오지 않았습니다.</div>`;
            else {
            list.querySelector("#question_list_footer").innerHTML+=`<p>${data.answer}</p>
                                                                    <p class="m-0">${data.answer_date}</p>`;
            }
            list.innerHTML +=`</div>`;
        });
    });
</script>