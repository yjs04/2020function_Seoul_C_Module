        <!-- visual -->
        <div id="visual" class="subpage">
            <img src="resource/image/sub1.gif" alt="sub1Visual">
        </div>
        <!-- /visual -->

        <!-- content -->
        <div id="content">
            <div class="sub_title_wrap container">
                <h5><a href="#">한지공예대전</a> <i class="fas fa-angle-right"></i> <a href="/entry">출품신청</a></h5>
                <h2>출품신청</h2>  
            </div>
            <div class="content_wrap container mt-0 p-0" id="entry_wrap">
                <div class="content_box">
                    <canvas width="1080" height="800"></canvas>
                    <div id="tool_box">
                        <div title="선택" data-role="select" class="tool_item"><i class="fa fa-mouse-pointer"></i></div>
                        <div title="회전" data-role="spin" class="tool_item"><i class="fa fa-redo"></i></div>
                        <div title="자르기" data-role="cut" class="tool_item"><i class="fa fa-cut"></i></div>
                        <div title="붙이기" data-role="glue" class="tool_item"><i class="fa fa-object-group"></i></div>
                        <div title="추가" class="tool_item" data-target="#entry_modal" data-toggle="modal"><i class="fa fa-folder"></i></div>
                        <div title="삭제" class="tool_item btn-delete"><i class="fa fa-trash"></i></div>
                    </div>
                </div>
            </div>

            <div class="content_wrap container p-0" id="entry_footer">
                <div class="content_wrap" id="entry_info">
                    <div class="content_title">
                        <h2 class="text-pink border-pink">출품 정보</h2>
                    </div>
                    <div class="content_box">
                        <form id="entry_info_form" method="post" action="/worksAddProcess">
                            <div class="form-group">
                                <label for="work_name" class="form-label">제목</label>
                                <input type="text" id="work_name" name="work_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="work_content" class="form-label">설명</label>
                                <textarea name="work_content" id="work_content" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="entry_word" class="form-label">해시태그</label>
                                <input type="text" id="work_tags" name="work_tags" hidden>
                                <input type="hidden" name="image" id="image">
                                <div id="entry_tags" class="hash pink m-0">
                                    <div id="entry_input" class="hash_input">
                                        <input type="text" id="entry_word" class="hash_word" placeholder="자유롭게 입력해주세요.">
                                        <span>#</span>
                                    </div>
                                    <div id="entry_value" class="hash_value"></div>
                                    <div id="entry_errorMsg" class="hash_errorMsg"></div>
                                    <div id="entry_hash_box" class="auto_hash_box"></div>
                                </div>
                            </div>
                        </form>
                        <div class="entry_button_box">
                            <button id="entry_button" class="border-0">출품하기</button>
                        </div>
                    </div>
                </div>
    
                <div class="content_wrap" id="entry_help">
                    <div class="content_title">
                        <h2 class="text-pink border-pink">도움말</h2>
                    </div>
                    <input type="radio" name="focus" id="focus-select" hidden checked>
                    <input type="radio" name="focus" id="focus-spin" hidden>
                    <input type="radio" name="focus" id="focus-cut" hidden>
                    <input type="radio" name="focus" id="focus-glue" hidden>
                    <div class="content_box">
                        <div id="helper_search_wrap">
                            <input type="text" id="helper_search" class="form-control">
                            <button class="helper_btn" id="helper_search_btn"><i class="fa fa-search"></i></button>
                            <button class="helper_btn" id="helper_prev"><i class="fa fa-angle-left"></i></button>
                            <button class="helper_btn" id="helper_next"><i class="fa fa-angle-right"></i></button>
                            <p id="helper_msg"></p>
                        </div>
                        <div id="helper_header">
                            <label for="focus-select" class="tab">선택</label>
                            <label for="focus-spin" class="tab">회전</label>
                            <label for="focus-cut" class="tab">자르기</label>
                            <label for="focus-glue" class="tab">붙이기</label>
                        </div>
                        <div id="helper_body">
                            <div class="tab" data-target="#focus-select">
                                선택 도구는 가장 기본적인 도구로써, 작업 영역 내의 한지를 선택할 수 있게 합니다. 마우스 클릭으로 한지를 활성화하여 이동시킬 수 있으며, 선택된 한지는 삭제 버튼으로 삭제시킬 수 있습니다.
                            </div>
                            <div class="tab" data-target="#focus-spin">
                                회전 도구는 작업 영역 내의 한지를 회전할 수 있는 도구입니다. 마우스 더블 클릭으로 회전하고자 하는 한지를 선택하면, 좌우로 마우스를 끌어당겨 회전시킬 수 있습니다. 회전한 뒤에는 우 클릭의 콘텍스트 메뉴로 '확인'을 눌러 한지의 회전 상태를 작업 영역에 반영할 수 있습니다.
                            </div>
                            <div class="tab" data-target="#focus-cut">
                                자르기 도구는 작업 영역 내의 한지를 자를 수 있는 도구입니다. 마우스 더블 클릭으로 자르고자 하는 한지를 선택하면 마우스를 움직임으로써 자르고자 하는 궤적을 그릴 수 있습니다. 궤적을 그린 뒤에는 우 클릭의 콘텍스트 메뉴로 '자르기'를 눌러 그려진 궤적에 따라 한지를 자를 수 있습니다.
                            </div>
                            <div class="tab" data-target="#focus-glue">
                                붙이기 도구는 작업 영역 내의 한지들을 붙일 수 있는 도구입니다. 마우스 더블 클릭으로 붙이고자 하는 한지를 선택하면 처음 선택한 한지와 근접한 한지들을 선택할 수 있습니다. 붙일 한지를 모두 선택한 뒤에는 우 클릭의 콘텍스트 메뉴로 '붙이기'를 눌러 선택한 한지를 붙일 수 있습니다.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="entry_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">추가하기</h5>
                            <button class="close" id="entry_close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="entry_img_list">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="resource/js/entry/Tool.js"></script>
            <script src="resource/js/entry/Select.js"></script>
            <script src="resource/js/entry/Spin.js"></script>
            <script src="resource/js/entry/Cut.js"></script>
            <script src="resource/js/entry/Glue.js"></script>
            <script src="resource/js/entry/Part.js"></script>
            <script src="resource/js/entry/Source.js"></script>
            <script src="resource/js/entry/Workspace.js"></script>
            <script type="module" src="resource/js/tag.js"></script>
            <script type="module" src="resource/js/entry.js"></script>
        </div>