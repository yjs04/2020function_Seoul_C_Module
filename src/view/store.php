        <!-- visual -->
        <div id="visual" class="subpage">
            <img src="resource/image/sub2.gif" alt="sub1_visual">
        </div>
        <!-- content -->
        <div id="content">
            <div class="sub_title_wrap container">
                <h5><a href="#">한지상품판매관</a> <i class="fas fa-angle-right"></i> <a href="/store">온라인스토어</a></h5>
                <h2>온라인스토어</h2>
            </div>
            <div class="content_wrap container">
                <div class="content_title">
                    <h2 class="border-blue text-blue">구매 리스트</h2>
                </div>
                <div class="content_box">
                    <div id="basket_area">
                        <table id="basket_table">
                            <thead>
                                <tr>
                                    <th class="text-center">상품 정보</th>
                                    <th>수량</th>
                                    <th>합계 포인트</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="basket_list">
                            </tbody>
                        </table>
                        <div id="basket_footer" class="bc-blue">
                            <span class="text-white pr-2">(보유 포인트 : <?=user()->point?>p)</span>
                            <p id="basket_sum" class="text-white">총 합계 <span id="basket_sum_num" class="text-white">0</span>p</p>
                            <button id="basket_btn" class="btn bc-blue text-white py-2 px-3 rounded-0 border-white">구매 완료</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content_wrap container" id="store_item">
                <div class="content_title" id="item_list_header">
                    <h2 class="border-blue text-blue">상품 리스트</h2>
                    <div id="search" class="hash">
                        <div id="search_input" class="hash_input">
                            <input type="text" id="search_word" class="hash_word" placeholder="자유롭게 입력해주세요.">
                            <span>#</span>
                        </div>
                        <div id="search_value" class="hash_value"></div>
                        <div id="search_errorMsg" class="hash_errorMsg"></div>
                        <div id="search_hash_box" class="auto_hash_box"></div>
                    </div>
                </div>
                <div class="content_box" id="item_area">
                </div>
                <?php if(company()):?>
                    <button id="goods_btn" class="btn rounded-0" data-toggle="modal" data-target="#goods_popup">상품등록</button>
                <?php endif;?>
            </div>

            <div id="goods_popup" class="modal fade" tabindex="1">
                <div class="modal-dialog popup overflow-hidden">
                    <div class="modal-content rounded-0 border-0">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">상품등록</h5>
                            <button class="close" id="goods_close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="goods_form" method="post" action="/paperAddProcess" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="image" class="form-label">이미지</label>
                                    <input type="file" id="image" name="image" class="form-control" required accept="image/*">
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="paper_name" class="form-label">이름</label>
                                    <input type="text" id="paper_name" name="paper_name" class="form-control" required>
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="company_name" class="form-label">업체명</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" required readonly value="<?=user()->user_name?>">
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="width_size" class="form-label">가로 사이즈</label>
                                    <input type="number" id="width_size" name="width_size" min="100" max="1000" class="form-control" required>
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="height_size" class="form-label">세로 사이즈</label>
                                    <input type="number" id="height_size" name="height_size" min="100" max="1000" class="form-control" required>
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="point" class="form-label">포인트</label>
                                    <input type="number" id="point" step="10" min="10" max="1000" name="point" class="form-control" required>
                                    <p class="form-text pl-2 text-danger"></p>
                                </div>
                                <input type="text" hidden id="hash_tags" name="hash_tags">
                                <div class="form-group">
                                    <label for="goods_word" class="form-label">해시태그</label>
                                    <div id="goods-tags" class="hash m-0">
                                        <div id="goods_input" class="hash_input">
                                            <input type="text" id="goods_word" class="hash_word" placeholder="자유롭게 입력해주세요.">
                                            <span>#</span>
                                        </div>
                                        <div id="goods_value" class="hash_value"></div>
                                        <div id="goods_errorMsg" class="hash_errorMsg"></div>
                                        <div id="goods_hash_box" class="auto_hash_box"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-0 rounded-0 p-0">
                            <button class="btn rounded-0 text-white w-100 p-2 bc-blue" id="goods_add_btn">추가완료</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="module" src="resource/js/tag.js"></script>
            <script type="module" src="resource/js/store.js"></script>
        </div>