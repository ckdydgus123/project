<!-- start: Content -->
<?php
?>
<div id="content" class="profile-v1">
    <div class="col-md-12 col-sm-12 profile-v1-body">
        <div class="col-md-5">
            <div class="panel box-v3">

                <div class="panel-body">
                    <img src="/static/lib/bootstrap/asset/img/satom2i.jpg" class="box-v7-avatar"
                         style="width: 220px; height: 230px;">
                </div>

                <div class="panel-heading bg-white border-none" style="text-align: center;">
                    <h4><font color="#00008b" size="5px"><b><?php echo $memberinfo->User_id ?></b></font></h4>
                </div>

                <div class="panel-heading bg-white border-none" style="font-size: 18px; padding-top: 3px;">
                    <span class="icons icon-briefcase"></span> 직업 : <?php echo $memberinfo->User_sex ?><br>
                    <span class="icons icon-home"></span> 거주지 : <?php echo $memberinfo->User_address ?><br>
                    <span class="icons icon-calendar"></span> 생년월일 : <?php echo $memberinfo->User_registration ?><br>
                </div>
                <div class="panel-heading bg-white border-none" style="font-size: 20px;">
                    <b><span class="icons icon-people" style="color: #0404B4;"></span> 7777 명 </b>
                    <b><span class="icons icon-docs" style="color: #0404B4;"></span> 200 권</b>

                    <?php if ($friend_check == 0) { ?>
                        <?php if ($memberinfo->User_id != $this->session->userdata('userNum')) { ?>
                            <form action="/member/addfriend" method="post">
                                <input type="hidden" name="friend_master" value="<?= $memberinfo->User_num; ?>">
                                <input type="hidden" name="friend_follow" value="<?= $this->session->userdata('userNum'); ?>"
                                <input type="hidden" name="target_user_no" value="<?php echo $memberinfo->User_num; ?>">
                                <button style="margin-top:0px !important;" class="btn-flip btn btn-outline btn-primary">
                                    <div class="flip">
                                        <div class="side">
                                            친구추가</span>
                                        </div>
                                        <div class="side back">
                                            are you sure?
                                        </div>
                                    </div>
                                    <span class="icon"></span>
                                </button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none" style="font-size: 18px; padding-top: 3px;">
                    <a href="/usertimeline/index/<?= $memberinfo->User_num; ?>/2" style="color: black;">
                        <li>&nbsp;&nbsp;&nbsp;개인일상</li>
                    </a>
                    <a href="/usertimeline/index/<?= $memberinfo->User_num; ?>/1" style="color: black;">
                        <li>&nbsp;&nbsp;&nbsp;판매글</li>
                    </a>
                    <a href="/deal/deallog/<?= $memberinfo->User_num; ?>" style="color: black;">
                        <li>&nbsp;&nbsp;&nbsp;거래내역</li>
                    </a>
                    <a href="#" style="color: black;">
                        <li>&nbsp;&nbsp;&nbsp;페이지구독</li>
                    </a>
                </div>
            </div>

        </div>
        <div class="col-md-7">
            <div class="col-md-12 top-20 padding-0">
                <div class="col-md-10">
                    <div class="panel">
                        <div class="panel-heading"><h3><b><?php echo $memberinfo->User_id ?>님의 거래내역</b></h3></div>
                        <div class="panel-body">
                            <div class="responsive-table">
                                <table id="datatables-example" class="table table-striped table-bordered" width="100%"
                                       cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>seller</th>
                                        <th>buyer</th>
                                        <th>subject</th>
                                        <th>price</th>
                                        <th>state</th>
                                        <th>date</th>
                                    </tr>
                                    </thead>
                                    <?php foreach ($deallog as $row) { ?>
                                        <?php if ($row->DI_other_state == 1) {
                                            $deal_state = '완료된 거래';
                                        } else if($row->DI_state == 0 && $row->DI_other_state == 2) {
                                            $deal_state = '판매자 요청에 의한 신고처리';
                                        } else if($row->DI_state == 2 && $row->DI_other_state == 0) {
                                            $deal_state = '구매자 요청에 의한 신고처리';
                                        }
                                        ?>
                                        <script>
                                            var seller = <?php echo $row->DI_seller ?>;
                                            var buyer = <?php echo $row->DI_buyer ?>;
                                            $.ajax({
                                                type: "POST",
                                                url: "/deal/deal_find_id",
                                                data: {"idx": seller},
                                                success: function (data) {
                                                    var parse = JSON.parse(data);
                                                    var seller_id = parse.User_id;
                                                    $("#seller<?php echo $row->DI_num?>").html(seller_id);
                                                }
                                            });

                                            $.ajax({
                                                type: "POST",
                                                url: "/deal/deal_find_id",
                                                data: {"idx": buyer},
                                                success: function (data) {
                                                    var parse = JSON.parse(data);
                                                    var buyer_id = parse.User_id;
                                                    $("#buyer<?php echo$row->DI_num?>").html(buyer_id);
                                                }
                                            });
                                        </script>

                                        <tbody>
                                        <tr>
                                            <td id="seller<?php echo $row->DI_num?>"></td>
                                            <td id="buyer<?php echo$row->DI_num?>"></td>
                                            <td>Edinburgh</td>
                                            <td><?php echo $row->DI_price ?></td>
                                            <td id="deal_state<?php echo $row->DI_num?>"><?php echo $deal_state ?></td>
                                            <td><?php echo $row->DI_date ?></td>
                                        </tr>
                                        </tbody>
                                        <script>
                                            var state = document.getElementById("deal_state<?php echo $row->DI_num?>").innerHTML;

                                            if(state == "구매자 요청에 의한 신고처리")
                                            {
                                                $("#deal_state<?php echo $row->DI_num?>").css("color","red");
                                            }else if(state == "판매자 요청에 의한 신고처리")
                                            {
                                                $("#deal_state<?php echo $row->DI_num?>").css("color","blue");
                                            }
                                        </script>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
