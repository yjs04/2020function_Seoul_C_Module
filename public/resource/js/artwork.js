import tag from './tag.js';
class Artwork{
    constructor(){
        this.list = [];
        this.tag = null;
        this.taging_list = [];
        fetch("/entryTag")
        .then(res=>res.json())
        .then(data=>this.setting(data))
    }

    setting(data){
        let hash_input = $("#search_word")
        let result_box = document.querySelector("#search_value");
        let error_box = document.querySelector("#search_errorMsg");
        let auto_box = document.querySelector("#search_hash_box");

        this.tag = new tag(hash_input,result_box,error_box,auto_box,data,[],this);
        hash_input.on("propertychange change input keyup keydown",this.tag.hash_searching);

        document.querySelector("#artwork_search_btn").addEventListener("click",()=>{
            if(this.taging_list.length) location.href = "/artworks?search="+JSON.stringify(this.taging_list);
            else return alert("검색할 해시태그를 입력해주세요.");
        });
        
        let wrap = document.querySelectorAll(".gallery_img_wrap");
        wrap.forEach(x=>{
            x.addEventListener("click",e=>{
                let idx = e.target.dataset.id;
                if(idx !== "") location.href = `/artwork/${idx}`;
            });
        });
    }
}

let app = new Artwork();