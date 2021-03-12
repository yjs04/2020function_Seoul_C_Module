class Join{
    constructor(){
        this.form = $("#join-form");
        this.submit = false;

        this.setEvent();
    }

    get join_email(){
        return $("#user_email").val();
    }

    get join_name(){
        return $("#user_name").val();
    }

    get join_password(){
        return $("#password").val();
    }

    get join_password_ck(){
        return $("#password-ck").val();
    }

    get join_photo(){
        let files = $("#image")[0].files;
        return files.length > 0 ? files[0] : null;
    }

    setEvent(){
        $("#join-form").on("submit",async e=>{
            e.preventDefault();
            
            let exist = await fetch("/userInfo/"+this.join_email).then(res=>res.json());
            exist = exist !== false ? true : false;
            this.submit = true;

            this.check(
                (this.join_email.match(/^[a-zA-Z0-9]+@[a-zA-Z]+(\.[a-zA-Z]+||\.[a-zA-Z]+\.[a-zA-Z]+)$/g) === null),
                "#user_email",
                "올바른 이메일을 입력하세요."
            );

            this.check(
                exist,
                "#user_email",
                "이미 사용중인 이메일입니다."
            );

            this.check(
                ((this.join_password.match(/[a-z]+/g) === null || this.join_password.match(/[A-Z]+/g) === null || this.join_password.match(/[0-9]+/g) === null || this.join_password.match(/[\!\@\#\$\%\^\&\*\(\)]+/g) === null) || this.join_password.length < 8),
                "#password",
                "올바른 비밀번호를 입력하세요."
            );

            this.check(
                (this.join_password !== this.join_password_ck),
                "#password-ck",
                "비밀번호와 비밀번호 확인이 불일치합니다."
            )

            this.check(
                (this.join_name.match(/^[ㄱ-ㅎㅏ-ㅣ가-힣]{2,4}$/g) === null),
                "#user_name",
                "올바른 이름을 입력해주세요."
            );
            
            this.check(
                !(this.join_photo.name.split(".")[1] === "jpg" || this.join_photo.name.split(".")[1] === "png" || this.join_photo.name.split(".")[1] === "gif"),
                "#image",
                "이미지 파일만 업로드 할 수 있습니다."
            );

            this.check(
                (this.join_photo.size >= 1024 * 1024 * 5),
                "#image",
                "이미지 파일은 5MB 이상 업로드 할 수 없습니다."
            )

            if(this.submit) this.form[0].submit();
        });
    }

    check(flag,id,error_msg){
        let error = $(id+" ~ .form-text");
        
        if(flag){
            this.submit = false;
            error.text("* "+error_msg);
            $(id).addClass("is-invalid");
        }else{
            error.text("");
            $(id).removeClass("is-invalid");
        }
    }

}

window.onload = () =>{
    let join = new Join();
}