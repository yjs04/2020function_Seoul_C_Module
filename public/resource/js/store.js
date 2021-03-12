import tag from './tag.js';
class Store{
    constructor(){
        this.itemList = [];
        this.itemArea = document.querySelector("#item_area");
        this.tag_list = [];
        this.tag = null;
        this.taging_list = [];
        this.goods_tag = null;
        this.goods_add = false;
        this.basketList = [];
        this.basketArea = document.querySelector("#basket_list");
        this.user = null;

        fetch("/storePapers")
        .then(res => res.json())
        .then(data => this.setting(data))
    }

    setList(){
        this.itemList = JSON.parse(localStorage.getItem('itemList'));
        this.tag_list = [];
        this.itemList.forEach(x=>{x.hash_tags.forEach(item=>{if(this.tag_list.find(tag => tag === item) === undefined) this.tag_list.push(item.replace(/#/g,""));})});
        this.setItemList(this.itemList);

        // BasketList
        this.setBasket();

        // hash
        let hash_search = $("#search_word");
        let hash_result_box = document.querySelector("#search_value");
        let hash_error_box = document.querySelector("#search_errorMsg");
        let hash_auto_box = document.querySelector("#search_hash_box");

        this.tag = new tag(hash_search,hash_result_box,hash_error_box,hash_auto_box,this.tag_list,this.itemList,this);

        document.querySelector("#basket_btn").addEventListener("click",()=>{this.basketSell()});
        hash_search.on("propertychange change input keydown keyup",this.tag.hash_searching);
        
        // goods
        let hash_goods = $("#goods_word");
        hash_result_box = document.querySelector("#goods_value");
        hash_error_box = document.querySelector("#goods_errorMsg");
        hash_auto_box = document.querySelector("#goods_hash_box");

        this.goods_tag = new tag(hash_goods,hash_result_box,hash_error_box,hash_auto_box,this.tag_list,[],this);

        hash_goods.on("propertychange change input keydown keyup",this.goods_tag.hash_searching);
        document.querySelector("#goods_add_btn").addEventListener("click",()=>{this.goodsAdd()});
        document.querySelectorAll("#goods_form > .form-group > input").forEach(x=>{$(x).on("propertychange change keyup input",e=>{this.goodsInput(e.target)})});
    }

    async setting(data){
        this.user = await fetch('/userInfo/admin').then(res=>res.json());
        // itemList
        data.forEach(x=>{
            x.point_num = parseInt(x.point.replace(/p/g,""));
            x.point_num = parseInt(x.point.replace(/,/g,""));
            x.hash_tags = JSON.parse(x.hash_tags);
            x.hash_tags.forEach(item=>{if(this.tag_list.find(tag => tag === item) === undefined) this.tag_list.push(item.replace(/#/g,""));})
            x.height_num = parseInt(x.height_size.replace(/px/g,""));
            x.width_num = parseInt(x.width_size.replace(/px/g,""));
            x.num = 0;
            this.itemList.push(x);
        });

        localStorage.setItem('itemList',JSON.stringify(this.itemList));

        this.setList();
    }

    get goodsImg(){
        let img = $("#image")[0].files;
        img = img.length > 0 ? img[0] : "";
        return img;
    }

    get goodsName(){return $("#paper_name").val();}
    get goodsCompany(){return $("#company_name").val();}
    get goodsWidth(){
        let width = $("#width_size").val();
        width = width === "" ? width : parseInt(width);
        width = width === "" ? width : isNaN(width) ? 10 : width < 100 ? 100 : width > 1000 ? 1000 : width;
        $("#width_size").val(width);
        return width;
    }
    
    get goodsHeight(){
        let height = $("#height_size").val();
        height = height === "" ? height : parseInt(height);
        height = height === "" ? height : isNaN(height) ? 10 : height < 100 ? 100 : height > 1000 ? 1000 : height;
        $("#height_size").val(height);
        return height;
    }

    get goodsPoint(){
        let point = $("#point").val();
        point = point === "" ? point : parseInt(point);
        point = point === "" ? point : isNaN(point) ? 10 : point < 10 ? 10 : point > 1000 ? 1000 : (Math.round(point/10) * 10);
        $("#point").val(point);
        return point;
    }

    goodsInput(target){
        let id = "#"+target.id;
        let val = null;

        if(id === "#image"){
            val = this.goodsImg;
            let exp = val.name.split(".")[1].toLowerCase();
            if(val === "") this.goodsCheck(true,id,"이미지를 선택해주세요.");
            else if(!(exp === "jpg" || exp === "png" || exp === "gif")) this.goodsCheck(true,id,"jpg, png, gif 이미지 파일만 입력할 수 있습니다.");
            else if(val.size >= 1024 * 1024 * 5) this.goodsCheck(true,id,"이미지는 5MB를 넘을 수 없습니다.");
            else this.goodsCheck(false,id);
        }

        if(id === "#paper_name") this.goodsCheck(this.goodsName === "",id,"이름을 입력해주세요.");
        if(id === "#company_name") this.goodsCheck(this.goodsCompany === "",id,"업체명을 입력해주세요.");
        if(id === "#width_size") this.goodsCheck(this.goodsWidth === "",id,"가로 사이즈를 입력해주세요.");
        if(id === "#height_size") this.goodsCheck(this.goodsHeight === "",id,"세로 사이즈를 입력해주세요.");
        if(id === "#point") this.goodsCheck(this.goodsPoint === "",id,"포인트를 입력해주세요.");
    }

     goodsAdd(){
        this.goods_add = true;
        document.querySelectorAll("#goods_form > .form-group > input").forEach(item =>{this.goodsInput(item)});
        if(!this.taging_list.length){
            document.querySelector("#goods_errorMsg").innerHTML = "* 해시태그를 입력해주세요.";
            this.goods_add = false;
        }
        
        if(this.goods_add){
            let tag = [];
            this.taging_list.forEach(x=>{tag.push("#"+x);});
            tag = JSON.stringify(tag);
            document.querySelector("#hash_tags").value = tag;

            document.querySelector("#goods_form").submit();
            
        }
    }

    goodsCheck(flag,id,error_msg=""){
        let error = $(id + " ~ .form-text");
        if(flag){
            this.goods_add = false;
            error.text("* "+error_msg);
        }else{
            error.text("");
        }
    }

    setItemList(list){
        this.itemArea.innerHTML = "";
        if(list.length){
            list.forEach(x=>{
                let item = this.makeItem(x);
                this.itemArea.appendChild(item);
            });
        }else{
            let dom = document.createElement("div");
            dom.innerHTML = "<div id='item_not_found'>해당하는 상품이 없습니다.</div>";
            this.itemArea.appendChild(dom.firstChild);
        }
    }

    basketSell(){
        if(!this.basketList.length) return alert("구매할 상품이 없습니다.");
        let list = JSON.parse(localStorage.getItem("inventory")) === null ? [] : JSON.parse(localStorage.getItem("inventory"));
        let newList = JSON.parse(JSON.stringify(this.basketList));
        if(list.length){
            list.forEach(x=>{
                this.basketList.forEach((item,idx) =>{
                    if(item.id === x.id){
                        x.num += item.num;
                        newList[idx] = "";
                    }
                });
            });

            newList.forEach(x=>{if(x !== "") return list.push(x);});
        }else list = this.basketList;

        localStorage.setItem("inventory",JSON.stringify(list));

        let num = 0;
        this.basketList.forEach(x=>{num += x.num});
        alert(`총 ${num}개의 한지가 구매되었습니다.`);
        this.itemList.forEach(x=>{x.num = 0;});
        this.basketList = [];
        this.setBasket();
        this.setItemList(this.itemList);
    }

    basketAdd=e=>{
        let id = e.target.dataset.id;
        let item = this.itemList[id];
        let flag = this.basketList.findIndex(x=>x.id-1 == parseInt(id));

        item.num++;
        item.sum = item.num * item.point_num;

        if(flag !== -1){
            this.basketList[flag].num++;
            this.basketList[flag].sum = item.sum;
        } else{
            item = JSON.parse(JSON.stringify(item));
            item.idx = this.basketList.length;
            this.basketList.push(item);
        }
        
        e.target.innerHTML = `추가하기(${item.num}개)`;
        this.setBasket();
    }

    basketDel=e=>{
        let idx = e.target.dataset.idx;
        let id = this.basketList[idx].id;
        this.basketList.splice(idx,1);
        this.itemList[id-1].num = 0;
        document.querySelector("#item-"+id+" .basketAddBtn").innerHTML="구매하기";
        this.setBasket();
    }

    setBasket(){
        let sum = 0;
        this.basketArea.innerHTML = "";

        if(this.basketList.length){
            this.basketList.forEach((x,idx)=>{
                x.idx = idx;
                sum += x.sum;
                let item = this.makeBasket(x);
                this.basketArea.appendChild(item);
            });
        }else this.basketArea.innerHTML = `<tr><td colspan="4" class="text-center">구매리스트가 비어있습니다.</td></tr>`;
        document.querySelector("#basket_sum_num").innerHTML = sum.toLocaleString();
    }

    makeBasket({image,paper_name,company_name,point,num,sum,idx}){
        let dom = document.createElement("tr");
        dom.innerHTML = `<tr>
                            <td class="basket_info_area">
                                <img src="uploads/${image}" alt="basket_img" class="basket_img">
                                <div class="basket_info">
                                    <h5>${paper_name}</h5>
                                    <p>${company_name}</p>
                                </div>
                                <p>${point}</p>
                            </td>
                            <td><input type="number" class="basket_info_number" min="1" max="1000" value="${num}" data-idx="${idx}">개</td>
                            <td>${sum.toLocaleString()}p</td>
                            <td class="basket_btn_area"><button class="basket_del_btn btn" data-idx="${idx}"><i class="fas fa-times"></i></button></td>
                        </tr>`;
        dom.querySelector(".basket_info_number").addEventListener("change",this.basketUpdate);
        dom.querySelector(".basket_del_btn").addEventListener("click",this.basketDel);
        return dom;
    }

    basketUpdate=e=>{
        let idx = e.target.dataset.idx;
        let id = this.basketList[idx].id;
        let val = parseInt(e.target.value);
        val = val === undefined ? 1 :val > 1000 ? 1000 : val < 1 ? 1 : val;
        this.basketList[idx].num = val;
        this.basketList[idx].sum = this.basketList[idx].point_num * val;
        this.itemList[id].num = val;
        this.itemList[id].sum = this.itemList[id].point_num * val;
        let btn = val > 0 ? `추가하기(${val}개)` : "구매하기";
        document.querySelector("#item-"+id+" .basketAddBtn").innerHTML = btn;
        this.setBasket();
    }

    makeItem({id,image,paper_name,company_name,point,width_num,height_num,hash_tags,num,company_id}){
        let btn = num > 0 ? `추가하기(${num}개)` : "구매하기";
        let dom = document.createElement("div");
        dom.classList.add("item");
        dom.setAttribute("id",`item-${id}`);
        dom.innerHTML = `<div class="item-photo">
                            <img src="uploads/${image}" alt="item-photo">
                            <p class="item-size">${width_num} X ${height_num}</p>
                        </div>
                        <div class="item-info pt-3">
                            <h5 class="d-flex justify-content-between">${paper_name}<span>${point}</span></h5>
                            <p class="text-muted mb-0">${company_name}</p>
                            <div class="item-hash-tag mt-3">`;
        hash_tags.forEach(x=>{dom.querySelector(".item-hash-tag").innerHTML += `<p class="text-muted">${x}</p>`;});
        dom.innerHTML +=`</div>`;
        if(this.user.id !== company_id) dom.innerHTML += `<button class="basketAddBtn btn bc-blue text-white rounded-0 mt-2 float-right w-100" data-id="${id-1}">${btn}</button>`;
        dom.innerHTML +=`</div>`;
        
        if(this.user.id !== company_id) dom.querySelector(".basketAddBtn").addEventListener("click",this.basketAdd);
        return dom;
    }
}

window.onload = () =>{
    let store = new Store();
}