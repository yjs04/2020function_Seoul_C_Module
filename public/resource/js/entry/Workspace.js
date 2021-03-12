class Workspace{
    constructor(entry){
        this.entry = entry;
        this.canvas = $("#entry_wrap canvas")[0];
        this.ctx = this.canvas.getContext("2d");
        this.ctx.fillStyle = "#fff";

        this.sliced = createCanvas(this.width, this.height);

        this.parts = [];
        
        this.selected = null;
        this.tools = {
            select: new Select(this),
            spin : new Spin(this),
            cut : new Cut(this),
            glue : new Glue(this),
        };

        this.render();
        this.setEvents();
    }

    get width(){return this.canvas.width;}
    get height(){return this.canvas.height;}
    get tool(){return this.tools[this.selected];}

    pushPart({image, width_size, height_size}){
        let imageObj = new Image();
        width_size = width_size.replace(/px/g,"");
        height_size = height_size.replace(/px/g,"");
        imageObj.src = "resource/image/"+image;
        imageObj.onload = () =>{
            let canvas = document.createElement("canvas");
            canvas.width = width_size;
            canvas.height = height_size;
            let ctx = canvas.getContext("2d");
            ctx.drawImage(imageObj, 0, 0, width_size,height_size);
            let src = new Source(ctx.getImageData(0,0,width_size,height_size));
            this.parts.push(new Part(src));
        }
    }

    render(){
        this.ctx.fillRect(0,0,this.width,this.height);

        this.parts.forEach(part=>{
            part.update();
            this.ctx.drawImage(part.canvas, part.x, part.y);
        });

        this.ctx.drawImage(this.sliced,0,0);
        requestAnimationFrame(()=> this.render());
    }

    setEvents(){
        $(window).on("mousedown",e=>{if(e.which === 1 && this.tool && this.tool.onmousedown) this.tool.onmousedown(e);});
        $(window).on("mousemove",e=>{if(e.which === 1 && this.tool && this.tool.onmousemove) this.tool.onmousemove(e);});
        $(window).on("mouseup",e=>{if(e.which === 1 && this.tool && this.tool.onmouseup) this.tool.onmouseup(e);});
        $(window).on("dblclick",e=>{if(e.which === 1 && this.tool && this.tool.ondblclick) this.tool.ondblclick(e);});
        $(window).on("contextmenu",e=>{
            if(this.tool && this.tool.oncontextmenu){
                e.preventDefault();
                this.tool.oncontextmenu(list => this.entry.makeContextMenu(list,e.pageX,e.pageY));
            }
        })
    }
}

function createCanvas(w,h){
    let canvas = document.createElement("canvas");
    canvas.width = w;
    canvas.height = h;
    return canvas;
}