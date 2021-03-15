import tag from './tag.js';
class Artwork{
    constructor(){
        this.list = [];
        this.tag = null;
        this.mod_tag = null;
        fetch("/entryTag")
        .then(res=>res.json())
        .then(data=>this.setting(data))
    }

    setting(data){
        console.log(data);
        this.tag = new tag();
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