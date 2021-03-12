        <!-- visual -->
        <div id="visual" class="subpage">
            <img src="resource/image/sub2.gif" alt="sub1_visual">
        </div>
        <!-- content -->
        <div id="content">
            <div class="sub_title_wrap container">
                <h5><a href="/">전주한지문화축제</a> <i class="fas fa-angle-right"></i> <a href="/join">회원가입</a></h5>
                <h2>회원가입</h2>
            </div>
            
            <div id="join" class="content_wrap container mt-0">
                <div class="content_box">
                    <form id="join-form" method="post" action="/joinProcess" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_email" class="form-label">이메일</label>
                            <input type="email" id="user_email" name="user_email" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">비밀번호</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="password-ck" class="form-label">비밀번호 확인</label>
                            <input type="password" id="password-ck" name="password-ck" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="user_name" class="form-label">이름</label>
                            <input type="text" id="user_name" name="user_name" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">프로필 사진</label>
                            <input type="file" id="image" name="image" class="form-control" required>
                            <p class="form-text text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="type" class="form-label">회원 유형</label>
                            <div class="form-radio-box">
                                <div class="form-check">
                                    <input type="radio" id="type-normal" name="type" value="user" class="form-check-input" required>
                                    <label for="type-normal">일반</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="type-company" name="type" value="company" class="form-check-input" required>
                                    <label for="type-company">기업</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-btn-box">
                            <button id="join-btn" class="btn bc-blue text-white rounded-0">회원가입</button>
                        </div>
                    </form>
                </div>
            </div>

            <script src="resource/js/join.js"></script>
        </div>