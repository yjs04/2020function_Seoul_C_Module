        <!-- visual -->
        <div id="visual" class="subpage">
            <img src="resource/image/sub1.gif" alt="sub1_visual">
        </div>
        <!-- content -->
        <div id="content">
            <div class="sub_title_wrap container">
                <h5><a href="/">전주한지문화축제</a> <i class="fas fa-angle-right"></i> <a href="/login">로그인</a></h5>
                <h2>로그인</h2>
            </div>
            
            <div id="login" class="content_wrap container mt-0">
                <div class="content_box">
                    <form id="login-form" method="post" action="/loginProcess">
                        <div class="form-group">
                            <label for="user_email" class="form-label">이메일</label>
                            <input type="text" id="user_email" name="user_email" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">비밀번호</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>

                        <div class="form-btn-box">
                            <button id="user_btn" class="btn bc-pink text-white rounded-0">회원가입</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>