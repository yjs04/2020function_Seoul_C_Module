import tag from './tag.js';
class App{
    constructor(){
        this.tag = null;
        this.taging_list = [];
        this.setEvent();
    }

    setEvent(){
        if(document.querySelector(".artwork_score_item")){
            document.querySelectorAll(".artwork_score_item").forEach(x=>{x.addEventListener("click",(e)=>{
                let val = e.target.dataset.val;
                let html = $(e.target).html();
                document.querySelector("#artwork_score_selected").innerHTML = html;
                document.querySelector("#artwork_score_selected").innerHTML += `<button id="artwork_score_open"><i class="fas fa-angle-down"></i></button>`;
                document.querySelector("#score").value = val;
                document.querySelector("#artwork_score_selected").classList.remove("open");
            })});
        }

        if(document.querySelector("#artwork_score_selected")) document.querySelector("#artwork_score_selected").addEventListener("click",e=>{e.target.classList.toggle("open")});
        if(document.querySelector("#artwork_score_add_btn")) document.querySelector("#artwork_score_add_btn").addEventListener("click",e=>{
            let work_id = e.target.dataset.work_id;
            let worker_id = e.target.dataset.worker_id;
            let val = document.querySelector("#score").value;
            $.ajax({
                url:"/scoreAdd",
                method:"post",
                data:{
                    val:val,
                    work_id:work_id,
                    worker_id:worker_id
                },
                success(data){
                    alert("평점이 등록 되었습니다.");
                    location.reload();
                }
            })
        });

        if(document.querySelector("#mod_popup")){
            document.querySelector("#artwork_modOpen_btn").addEventListener("click",async ()=>{
                let list = await fetch("/entryTag").then(res=>res.json());
                let mod_input = $("#mod_word");
                let result_box = document.querySelector("#mod_value");
                let error_box = document.querySelector("#mod_errorMsg");
                let auto_box = document.querySelector("#mod_hash_box");
                this.tag = new tag(mod_input,result_box,error_box,auto_box,list,[],this);
                mod_input.on("propertychange change input keyup keydown",this.tag.hash_searching);
            });

            document.querySelector("#artwork_mod_btn").addEventListener("click",e=>{
                document.querySelector("#work_tags").value = JSON.stringify(this.taging_list);
                if(!this.taging_list.length) return alert("내용을 입력해주세요!");
                document.querySelector("#mod_form").submit();
            });
        }

        if(document.querySelector("#artwork_del")){
            document.querySelector("#artwork_del").addEventListener("click",e=>{
                let type = e.target.dataset.type;
                let id = e.target.dataset.id;

                if(type !== "admin"){
                    if(confirm("정말로 해당 작품을 삭제하시겠습니까?")){
                        $.ajax({
                            url:"/workDel",
                            method:"post",
                            data:{id:id},
                            success(){
                                alert("해당 작품이 삭제되었습니다.");
                                return location.href="/artworks";
                            }
                        });
                    }
                }else{
                    let del_content = prompt("삭제 사유를 입력해주세요.");
                    if(!(del_content === null || del_content === "")){
                        $.ajax({
                            url:"/workDel",
                            method:"post",
                            data:{
                                id:id,
                                del_content:del_content,
                                success(){
                                    alert("해당 작품이 삭제되었습니다.");
                                    return location.href = "/artworks";
                                }
                            }
                        })
                    }
                }
            });
        }
    }
}

let app = new App();