export default class Tag{
    constructor(hash_search,hash_result_box,hash_error_box,hash_auto_box,hash_list,item_list,module){
        this.hash_search = hash_search;
        this.hash_result_box = hash_result_box;
        this.hash_error_box = hash_error_box;
        this.hash_auto_box = hash_auto_box;
        this.hash_list = hash_list;
        this.item_list = item_list;
        this.module = module;

        this.tag_select_num = 0;
        this.tag_select=false;
        this.auto_tag_list = [];
        this.taging_list = [];
    }

    hash_searching=e=>{
        if(e.type === "keydown" && (e.keyCode === 38 || e.keyCode === 40 || e.keyCode === 13)) return false;
        if((e.keyCode === 38 || e.keyCode === 40) && this.auto_tag_list.length){
            e.preventDefault();
            this.tag_select = true;
            
            this.tag_select_num = e.keyCode === 38 ? this.tag_select_num-1 : this.tag_select_num+1;
            this.tag_select_num = this.tag_select_num > this.auto_tag_list.length ? 1 : this.tag_select_num;
            this.tag_select_num = this.tag_select_num < 1 ? this.auto_tag_list.length : this.tag_select_num;

            if(this.hash_auto_box.querySelector(`.auto_hash_tag.select`))this.hash_auto_box.querySelector(`.auto_hash_tag.select`).classList.remove("select");
            this.hash_auto_box.querySelector(`.auto_hash_tag:nth-child(${this.tag_select_num})`).classList.add("select");
        }else{
            if((e.keyCode === 9 || e.keyCode === 13 || e.keyCode === 32)){e.preventDefault();}
            if(e.keyCode === 13 && this.tag_select){
                let val = this.hash_auto_box.querySelector(`.auto_hash_tag:nth-child(${this.tag_select_num})`).dataset.value;
                e.target.value = val;
                this.tag_select = false;
                this.tag_select_num = 0;
                this.auto_tag_list = [];
                this.auto_hash_make(this.auto_tag_list);
            }else{
                this.tag_select = false;
                this.tag_select_num = 0;

                let val = e.target.value;
                let flag = false;

                val = val.substr(0,30);
                val = val.replace(/[^A-Za-z가-힣ㄱ-ㅎㅏ-ㅣ0-9_]/gi,"");
                val = val.replace(/ /gi,"");
                e.target.value = val;
                
                if(val.length > 0 && this.taging_list.length > 9) return this.hash_error_box.innerHTML = "태그는 10개까지만 추가할 수 있습니다.";
                else this.hash_error_box.innerHTML = "";

                if(this.taging_list.find(x=>x==val)) return this.hash_error_box.innerHTML = "이미 추가한 태그입니다.";
                else this.hash_error_box.innerHTML = "";

                flag = !(val.length > 0 && this.taging_list.length > 9) && !(this.taging_list.find(x=>x==val)) && !(val.length < 2);

                if((e.keyCode === 9 || e.keyCode === 13 || e.keyCode === 32) && flag){
                    this.hash_make(val);
                    e.target.value = "";
                }else{
                    this.auto_tag_list = [];
                    this.hash_list.forEach(x=>{if(x.indexOf(val) === 0 && this.auto_tag_list.findIndex(item => item === x) === -1 && val.length > 0) this.auto_tag_list.push(x);});
                    this.auto_hash_make(this.auto_tag_list);
                    console.log(this.hash_list);
                }
            }
            
        }

        return this.taging_list;
    }

    item_set(){
        if(this.item_list.length){
            let list = [];
            let flag = true;
            if(this.taging_list.length){
                this.item_list.forEach(x=>{
                    flag = true;
                    this.taging_list.forEach(tag=>{
                        flag = x.hash_tags.find(hash=>tag === hash.replace(/#/g,"")) === undefined ? false : flag;
                    });
        
                    if(flag) list.push(x);
                });
            }else list = this.item_list;
    
            this.module.setItemList(list);
        }else this.module.taging_list = this.taging_list;
    }

    auto_hash_make(list){
        this.hash_auto_box.innerHTML = "";
        if(list.length){
            list.forEach(x=>{
                let dom = document.createElement("div");
                dom.innerHTML = `<p class="auto_hash_tag" data-value="${x}">${x}</p>`;
                this.hash_auto_box.appendChild(dom.firstChild);
            });
        }
    }

    hash_make(val){
        let dom = document.createElement("div");
        dom.innerHTML = `<span class="hash_result"># ${val}<button class="hash_result_del" data-id="${this.taging_list.length}"><i class="fas fa-times"></i></button></span>`;
        dom.querySelector(".hash_result_del").addEventListener("click",this.hash_del);
        this.hash_result_box.appendChild(dom.firstChild);
        this.taging_list.push(val);
        this.item_set();
    }

    hash_del=e=>{
        let target = e.target.parentNode;
        let idx = e.target.dataset.id;
        this.hash_result_box.removeChild(target);
        this.taging_list.splice(idx,1);
        this.item_set();
    }
}