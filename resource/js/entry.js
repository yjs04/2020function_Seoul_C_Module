import Tag from './tag.js';
class Entry{
    constructor(){
        this.tag = null;
        this.taging_list = [];
        this.helper = [
            `선택 도구는 가장 기본적인 도구로써, 작업 영역 내의 한지를 선택할 수 있게 합니다. 마우스 클릭으로 한지를 활성화하여 이동시킬 수 있으며, 선택된 한지는 삭제 버튼으로 삭제시킬 수 있습니다.`,
            `회전 도구는 작업 영역 내의 한지를 회전할 수 있는 도구입니다. 마우스 더블 클릭으로 회전하고자 하는 한지를 선택하면, 좌우로 마우스를 끌어당겨 회전시킬 수 있습니다. 회전한 뒤에는 우 클릭의 콘텍스트 메뉴로 '확인'을 눌러 한지의 회전 상태를 작업 영역에 반영할 수 있습니다.`,
            `자르기 도구는 작업 영역 내의 한지를 자를 수 있는 도구입니다. 마우스 더블 클릭으로 자르고자 하는 한지를 선택하면 마우스를 움직임으로써 자르고자 하는 궤적을 그릴 수 있습니다. 궤적을 그린 뒤에는 우 클릭의 콘텍스트 메뉴로 '자르기'를 눌러 그려진 궤적에 따라 한지를 자를 수 있습니다.`,
            `붙이기 도구는 작업 영역 내의 한지들을 붙일 수 있는 도구입니다. 마우스 더블 클릭으로 붙이고자 하는 한지를 선택하면 처음 선택한 한지와 근접한 한지들을 선택할 수 있습니다. 붙일 한지를 모두 선택한 뒤에는 우 클릭의 콘텍스트 메뉴로 '붙이기'를 눌러 선택한 한지를 붙일 수 있습니다.`
        ];

        this.findList = [];
        this.index = 0;
        this.ws = new Workspace(this);

        fetch('resource/js/craftworks.json')
        .then(res=>res.json())
        .then(data=>this.setting(data))
    }

    makeContextMenu(menus,x,y){
        $(".context-menu").remove();
        let $menus = $(`<div class='context-menu' style='left:${x}px; top:${y}px;'></div>'`);
        menus.forEach(({name,onclick})=>{
            let $menu = $(`<div class='context-menu-item'>${name}</div>`);
            $menu.on("mousedown",onclick);
            $menus.append($menu);
        });

        $(document.body).append($menus);
    }

    setting(data){
        // taging
        let list = [];
        data.forEach(x=>{x.hash_tags.forEach(item=>{if(list.find(tag=>"#"+tag === item)===undefined)list.push(item.replace(/#/g,""))})});
        let hash_entry = $("#entry_word");
        let hash_result_box = document.querySelector("#entry_value");
        let hash_error_box = document.querySelector("#entry_errorMsg");
        let hash_auto_box = document.querySelector("#entry_hash_box");

        this.tag = new Tag(hash_entry,hash_result_box,hash_error_box,hash_auto_box,list,[],this);

        hash_entry.on("propertychange change input keydown keyup",this.tag.hash_searching);

        // helper
        document.querySelector("#helper_search").addEventListener("keydown",(e)=>{if(e.keyCode === 13){e.preventDefault(); this.helperSearch();}});
        document.querySelector("#helper_search_btn").addEventListener("click",()=>{this.helperSearch();});
        document.querySelector("#helper_prev").addEventListener("click",()=>{this.helperPage("prev");});
        document.querySelector("#helper_next").addEventListener("click",()=>{this.helperPage("next");});

        // canvas!!!
        $(".tool_item").on("click",e=>{
            let role = e.currentTarget.dataset.role;
            $(".tool_item").removeClass("active");

            if(this.ws.tool){
                this.ws.tool.cancel && this.ws.tool.cancel();
                this.ws.tool.unselectAll();
            }

            if(this.ws.selected == role){
                this.ws.selected = null;
            }else{
                this.ws.selected = role;
                $(e.currentTarget).addClass("active");
            }
        });

        $(".btn-delete").on("mousedown",e=>{
            if(this.ws.selected == "select" && this.ws.tool.selected){
                this.ws.parts = this.ws.parts.filter(part => part != this.ws.tool.selected);
            }else{
                alert("한지를 선택해주세요.");
            }
        });

        $(window).on("click",e=>{
            $(".context-menu").remove();
        });

        $("[data-target='#entry_modal']").on("click",async e=>{
            let list = JSON.parse(localStorage.getItem("inventory")) === null ? [] : JSON.parse(localStorage.getItem("inventory"));
            $("#entry_modal .modal-body").html('');
            if(list.length){
                list.forEach(item =>{
                    $("#entry_modal .modal-body").append(`<div class="entry_img_item" data-id="${item.idx}">
                                                                <div class="entry_img_box">
                                                                    <img class="entry_img" src='resource/image/${item.image}'>
                                                                </div>
                                                                <div class="entry_img_info p-2 border border-top-0">
                                                                    <h5>${item.paper_name}</h5>
                                                                    <div class="mt-2">
                                                                        <span class="pr-1">사이즈</span>
                                                                        <span>${item.width_size} X ${item.height_size}</span>
                                                                    </div>
                                                                    <div class="mt-1">
                                                                        <span class="pr-1">소지 수량</span>
                                                                        <span>${item.num}개</span>
                                                                    </div>
                                                                </div>
                                                            </div>`);
                });
            }else $("#entry_modal .modal-body").append(`<div id="entry_none">추가할 한지가 없습니다.</div>`);
        });

        $("#entry_modal").on("click",".entry_img_item",async e =>{
            let idx = e.currentTarget.dataset.id;
            let list = await JSON.parse(localStorage.getItem("inventory"));
            let item = list[idx];
            list[idx].num--;
            if(list[idx].num == 0){
                list.splice(idx,1);
                list.forEach((x,idx)=>{x.idx = idx})
            }
            localStorage.setItem("inventory",JSON.stringify(list));

            this.ws.pushPart(item);

            $("#entry_modal").modal("hide");
        });
    }

    get focusItem(){return this.findList[this.index];}

    helperPage(btn){
        if(!this.findList.length) return false;
        let msg = document.querySelector("#helper_msg");
        if(btn === "prev")this.index = (this.index - 1) > -1 ? this.index - 1 : this.findList.length - 1;
        else this.index = (this.index + 1) < this.findList.length ? this.index + 1 : 0;
 
        document.querySelector("#helper_body span.active").classList.remove("active");
        this.focusItem.classList.add("active");
        
        let target = this.focusItem.parentElement.dataset.target;
        $(target)[0].checked = true;
    
        msg.innerHTML = `${this.findList.length}개 중 ${this.index + 1}번째`;
    }

    helperSearch(){
        let input = document.querySelector("#helper_search");
        let msg = document.querySelector("#helper_msg");
        let val = input.value;

        let regex = new RegExp(val.replace(/([.+*?^$\(\)\[\]\\\\\\/])/g,"\\$1"),"g");
        this.helper.forEach((x,idx)=>{
            let replaced = x.replace(regex,m1=>`<span>${m1}</span>`);
            $("#helper_body .tab").eq(idx).html(replaced);
        });

        this.findList = Array.from($("#helper_body span"));
        
        if(this.findList.length){
            this.index = 0;
            this.focusItem.classList.add("active");

            let target = this.focusItem.parentElement.dataset.target;
            $(target)[0].checked = true;

            msg.innerHTML = `${this.findList.length}개 중 ${this.index + 1}번째`;
        }else{
            this.index = null
            msg.innerHTML = "일치하는 내용이 없습니다.";
        }
    }
}

window.onload = () =>{
    let entry = new Entry();
}