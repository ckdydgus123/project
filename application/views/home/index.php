<!-- start: Content -->
<style type="text/css">
    .deal_select_button {
        background-color: rgba(11, 35, 46, 0.38);
        color: #CC0000;
    }
</style>


<script>
    var socket = io.connect('http://localhost:8000');

    console.log(socket);
    socket.on('connect', function(){
// 서버에 있는 adduser 함수를 호출하며, 하나의 파라미터(prompt의 반환 값)를 전달한다
        socket.emit('adduser', '<?php echo $this->session->userdata('loginID')?>');
        console.log('<?php echo $this->session->userdata('loginID')?>');
    });
</script>

<div id="content" class="profile-v1">
    <div class="col-md-12 col-sm-12 profile-v1-body">

        <div class="col-md-7">
            <!--게시물 작성 공간-->
            <div class="box-v5 panel">
                <div class="panel-heading padding-0 bg-white border-none">
                    <ul id="tabs-demo4" class="nav nav-tabs nav-tabs-v3" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tabs-demo4-area1" id="tabs-demo4-1" role="tab" data-toggle="tab"
                               aria-expanded="true">게시글</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tabs-demo4-area2" role="tab" id="tabs-demo4-2" data-toggle="tab"
                               aria-expanded="false">판매글</a>
                        </li>
                    </ul>
                    <div class="panel-body">
                        <div id="tabsDemo4Content" class="tab-content tab-content-v3">
                            <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo4-area1"
                                 aria-labelledby="tabs-demo4-area1">
                                <form action="/boardandcomment/timeline_board_add" method="POST">
                                    <input type="hidden" name="Board_target" value="0">
                                    <input type="hidden" name="target_user_no" value=0">
                                    <input type="hidden" name="Board_state" value="0">
                                    <textarea placeholder="게시글 작성해주세요" name="Board_note" id="editor1" class="ckeditor"
                                              required></textarea>

                                    <div class="col-md-4 col-sm-6 col-xs-6 padding-0"
                                         style="float: right; margin-top: 4px;">
                                        <input type="submit" class="btn btn-round pull-right" value="SEND">
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabs-demo4-area2"
                                 aria-labelledby="tabs-demo4-area2">
                                <form action="/boardandcomment/timeline_board_add" method="POST">
                                    <input type="hidden" name="Board_target"
                                           value="<?php /*echo $memberinfo->User_num; */ ?> ">
                                    <input type="hidden" name="target_user_no"
                                           value="<?php /*echo $memberinfo->User_num; */ ?> ">
                                    <input type="hidden" name="Board_state" value="1">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <input type="text" name="Board_min_price"
                                                       placeholder="최저가" required>
                                            </td>
                                            <td>
                                                <input type="text" name="Board_max_price"
                                                       placeholder="최고가" required>
                                            </td>
                                        </tr>
                                    </table>
                                <textarea placeholder="판매글 작성해주세요" name="Board_note" id="editor1" class="ckeditor"
                                          required></textarea>

                                    <div class="col-md-4 col-sm-6 col-xs-6 padding-0"
                                         style="float: right; margin-top: 4px;">

                                        <input type="submit" class="btn btn-round pull-right" value="SEND">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--게시물 출력 공간-->
            <div id='left-copy-1tomany'>
                <?php foreach ($boardlist as $row) { ?>
                    <?php if ($row->Board_target == 0) { ?> <!--개인적인 타임라인글이 아닌 게시물만-->
                        <script>
                            $(document).ready(function () {
                                $('#share<?php echo $row->Board_num ?>').click(function () {
                                    $.ajax({ // 게시글 공유하기 버튼
                                        type: "POST",
                                        url: "/boardandcomment/share",
                                        data: {"share_num": <?php echo$row->Board_num?>},
                                        success: function (data) {
                                            window.location.reload();
                                        }
                                    });
                                });
                            });
                             $.ajax({
                                type: "POST",
                                url: "/boardandcomment/cmd_cnt",
                                data: {"Cmd_num": <?php echo $row->Board_num ?>},
                                success: function (data) {
                                    $("#cmd_cnt<?php echo $row->Board_num?>").html(data);
                                }
                            });
                        </script>
                        <div class="panel box-v7">
                            <div class="panel-body">
                                <!--start borad-->
                                <div class="col-md-7 padding-0 box-v7-header">
                                    <div class="col-md-7 padding-0">
                                        <div class="col-md-9 padding-0">
                                            <img src="<?php echo $row->User_img; ?>" id="test"
                                                 class="box-v7-avatar pull-left" style="width:10%; height: 10%;"/>
                                            <?php if ($row->Board_state == 2) { ?>
                                                <?php echo $row->Board_share_user; ?>님이 게시글을 공유 했습니다.
                                                <hr>
                                                <h4><a href="/usertimeline/index/<?php echo $row->User_num ?>/0"><?php echo $row->User_id; ?></a></h4>
                                            <?php } else { ?>
                                                <h4><a href="/usertimeline/index/<?php echo $row->User_num ?>/0"><?php echo $row->User_id ?></a></h4>
                                            <?php } ?>

                                            <p><?php echo $row->Board_date; ?></p>
                                        </div>
                                        <div class="col-md-2 padding-0">
                                            <div class="btn-group right-option-v1">
                                                <i class="icon-options-vertical icons box-v7-menu"
                                                   data-toggle="dropdown"></i>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Action</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                    <li><a href="#">Something else here</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11 padding-0 box-v7-body">
                                    <p><?php echo $row->Board_note; ?></p>
                                    <!--판매가격-->
                                    <?php if ($row->Board_min_price != null && $row->Board_max_price != null) { ?><!--최저 가격과 최대 가격이 있는 글일 경우-->
                                    <script>
                                        var deal_check_log = <?php echo$row->Board_num?>;
                                        var soldout = "sold out";
                                        $.ajax({
                                            type: "POST",
                                            url: "/deal/deal_check",
                                            data: {"idx": deal_check_log},
                                            success: function (data) {
                                                if (data == 1) {
                                                    $("#deal_View<?php echo$row->Board_num?>").html("sold out");
                                                }
                                            }
                                        });
                                    </script>

                                    <div class="col-md-11 padding-0"
                                         style="background-color: #FFFCAE; text-align: center; margin-top: 20px; padding: 5px;">
                                        <h4 class="media-heading"><span
                                                id="deal_View<?php echo $row->Board_num ?>"><?php echo $row->Board_min_price ?>
                                                ~ <?php echo $row->Board_max_price ?></span>
                                        </h4>
                                    </div>
                                    <?php } ?>

                                    <div class="col-md-11 top-20" style="padding-top: 10px; padding-left: -5px;">
                                        <button class="btn">
                                            <i class="icon-like icons"></i>
                                        </button>
                                        <button class="btn">
                                            <i class="icon-bubble icons" id="cmd_cnt<?php echo $row->Board_num?>"></i>                                          </button>
                                        <?php if ($row->User_num != $this->session->userdata('userNum')) { ?>
                                            <?php if ($row->Board_share_user != $this->session->userdata('loginID')) { ?>
                                                <button class="btn" id="share<?php echo $row->Board_num ?>">
                                                    <i class="icon-loop icons"></i>
                                                </button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>

                                <!--댓글-->
                                <div class="col-md-11 padding-0 box-v7-comment">
                                    <?php foreach ($commentlist as $cmdrow) { ?>
                                        <!--게시물 댓글-->
                                        <?php if ($cmdrow->Board_num == $row->Board_num) { ?><!--게시글과 댓글의 그룹번호가 일치하는 경우-->
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img src="<?php echo $row->User_img; ?>"
                                                             class="media-object box-v7-avatar"/>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <h4 class="media-heading"><a href="/usertimeline/index/<?php echo $cmdrow->Cmd_user ?>/0"><?php echo $cmdrow->User_id ?></a></h4>                                                    </div>

                                                    <p> <?php echo $cmdrow->Cmd_note ?> </p>
                                                    <a href="">
                                                        <i class="icon-like icons"></i>
                                                    </a>
                                                    <?php echo $cmdrow->Cmd_date ?>
                                                </div>
                                                <div class="media-right">

                                                    <!--구매자 돈 -->
                                                    <!--게시글 작성시, 내가 올린 판매글은 일반댓글만 올리게 되어 있으므로, 내가 나를 선택하는 경우는 없음-->
                                                    <?php if ($cmdrow->Cmd_price != null) { ?>
                                                        <!--댓글에 가격이 있을 경우(즉 판매 댓글일 경우), -->
                                                        <i class="fa fa-won"><font
                                                                color="red"><b><?php echo $cmdrow->Cmd_price ?></b></font></i>
                                                        <br>

                                                    <?php if ($row->User_num == $this->session->userdata('userNum')) { ?> <!--이때 선택은 게시글을 올린 본인만 가능-->
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <script>
                                                            $(document).ready(function () {
                                                                $('#select_state<?php echo $cmdrow->Cmd_num ?>').click(function () {
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "/deal/add_dealing",
                                                                        data: {
                                                                            "Board_num": <?php echo $row->Board_num ?>,
                                                                            "seller": <?php echo $this->session->userdata('userNum') ?>,
                                                                            "buyer": <?php echo $cmdrow->Cmd_user ?>,
                                                                            "price": <?php echo $cmdrow->Cmd_price ?>,
                                                                            "buyer_state": 0,
                                                                            "seller_state": 0
                                                                        },
                                                                        success: function (data) {
                                                                            alert("거래진행으로 전환됩니다.");
                                                                            window.location.reload();
                                                                        }
                                                                    });
                                                                });
                                                                if(document.getElementById("deal_View<?php echo$row->Board_num?>").innerHTML == "sold out") {
                                                                    var target_comment = document.getElementById("select_state<?php echo$cmdrow->Cmd_num?>");
                                                                    target_comment.setAttribute("value", "sold out");
                                                                    $("#select_state<?php echo$cmdrow->Cmd_num?>").prop("disabled", true);
                                                                }
                                                            });
                                                        </script>
                                                    <input type="submit" name="add_deal" value="select" id="select_state<?php echo $cmdrow->Cmd_num ?>" class="deal_select_button">
                                                    <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?> <!--end of comment foreach-->
                                    <!--댓글 출력 끝-->

                                    <!--댓글 쓰기-->
                                    <?php if ($row->Board_state == 0 || $row->User_num == $this->session->userdata('userNum')) { ?> <!--게시물의 성격이 일반 게시물일 경우-->
                                        <!--내가 내 글에 답글을 입력하는 경우는 무조건 일반 댓글-->
                                        <!--일반 댓글쓰기-->
                                        <form action="/boardandcomment/addcomment" method="POST">
                                            <!--공통 매개값-->
                                            <input type="hidden" name="group_num" value="<?php echo $row->Board_num ?>">
                                            <input type="hidden" name="Board_target"
                                                   value="<?php /*echo $memberinfo->User_num; */ ?> ">

                                            <!---->
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img src="<?php echo $row->User_img; ?>"
                                                             class="media-object box-v7-avatar"/>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                        <textarea class="box-v7-commenttextbox" name="Cmd_note"
                                                  placeholder="write comments..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-6 padding-0"
                                                 style="float: right; margin-top: 4px;">
                                                <input type="submit" class="btn btn-round pull-right" value="SEND">
                                            </div>
                                        </form>
                                        <!--일반 댓글 끝-->

                                        <!--구매 댓글 달기-->
                                    <?php } else if ($row->Board_state == 1 || $row->User_num != $this->session->userdata('userNum')) { ?>
                                        <!--돈 올릴 수 잇는 댓글쓰기, 내 게시글이 아닌 글이라는 가정 하에에-->
                                        <form action="/boardandcomment/addcomment" method="POST">
                                            <!--공통 매개값-->
                                            <input type="hidden" name="group_num" value="<?php echo $row->Board_num ?>">
                                            <input type="hidden" name="Board_target"
                                                   value="<?php /*echo $memberinfo->User_num; */ ?> ">
                                            <!---->
                                            <div class="media">
                                                <div class="media-left" style="padding-top: 30px;">
                                                    <img src="<?php echo $row->User_img; ?>"
                                                         class="media-object box-v7-avatar"/>
                                                </div>
                                                <div class="media-body">
                                                    <input type="number" id="write_price" name="Cmd_price" placeholder="입찰가"
                                                           style="background-color: #F5ECCE;">
                                        <textarea class="box-v7-commenttextbox" name="Cmd_note"
                                                  placeholder="write comments..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-6 padding-0"
                                                 style="float: right; margin-top: 4px;">
                                                <input type="submit" class="btn btn-round pull-right" value="SEND">
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } /*end of board foreach*/ ?>
            </div>
        </div>
        <div id="slidemenu" class="col-md-5" style="width: 330px; ">
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none">
                    <h4>물물비교</h4>
                </div>
                <div id='right-copy-1tomany' style="background-color:#F6D8CE;">
                    <div class="panel-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
