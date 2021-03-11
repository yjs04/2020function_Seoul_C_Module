class Join{
    constructor(){
        this.form = $("#join-form");
        this.submit = false;

        this.setEvent();
    }

    get join_email(){
        return $("#join-email").val();
    }

    get join_name(){
        return $("#join-name").val();
    }

    get join_password(){
        return $("#join-password").val();
    }

    get join_password_ck(){
        return $("#join-password-ck").val();
    }

    get join_photo(){
        let files = $("#join-photo")[0].files;
        return files.length > 0 ? files[0] : null;
    }

    setEvent(){
        $("#join-form").on("submit",async e=>{
            e.preventDefault();
            
            this.submit = true;

            this.check(
                (this.join_email.match(/^[a-zA-Z0-9]+@[a-zA-Z]+(\.[a-zA-Z]+||\.[a-zA-Z]+\.[a-zA-Z]+)$/g) === null),
                "#join-email",
                "올바른 이메일을 입력하세요."
            );

            this.check(
                ((this.join_password.match(/[a-z]+/g) === null || this.join_password.match(/[A-Z]+/g) === null || this.join_password.match(/[0-9]+/g) === null || this.join_password.match(/[\!\@\#\$\%\^\&\*\(\)]+/g) === null) || this.join_password.length < 8),
                "#join-password",
                "올바른 비밀번호를 입력하세요."
            );

            this.check(
                (this.join_password !== this.join_password_ck),
                "#join-password-ck",
                "비밀번호와 비밀번호 확인이 불일치합니다."
            )

            this.check(
                (this.join_name.match(/^[ㄱ-ㅎㅏ-ㅣ가-힣]{2,4}$/g) === null),
                "#join-name",
                "올바른 이름을 입력해주세요."
            );
            
            this.check(
                !(this.join_photo.name.split(".")[1] === "jpg" || this.join_photo.name.split(".")[1] === "png" || this.join_photo.name.split(".")[1] === "gif"),
                "#join-photo",
                "이미지 파일만 업로드 할 수 있습니다."
            );

            this.check(
                (this.join_photo.size >= 1024 * 1024 * 5),
                "#join-photo",
                "이미지 파일은 5MB 이상 업로드 할 수 없습니다."
            )

            if(this.submit){
                return alert("정상적으로 회원가입 되었습니다.");
                this.form.submit();
            }
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