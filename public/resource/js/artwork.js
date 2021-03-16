import tag from './tag.js';
class App{
    constructor(){
        this.tag = null;
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
            console.log(work_id,worker_id);
        });
    }
}

let app = new App();