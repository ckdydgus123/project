<div id="content" class="profile-v1">
    <div class="col-md-12 col-sm-12 profile-v1-body" style="width: 1200px">
        <div class="panel-heading" style="text-align: center"><h3><b>거래 진행</b></h3></div>
        <h4></h4>
        <?php foreach ($deallog as $row) { ?>
            <script>
                var seller = <?php echo $row->DI_seller ?>;
                var buyer = <?php echo $row->DI_buyer ?>;

                $.ajax({ //판매자 id 출력
                    type: "POST",
                    url: "/deal/deal_find_id",
                    data: {"idx": seller},
                    success: function (data) {
                        var parse = JSON.parse(data);
                        var seller_id = parse.User_id;
                        $("#seller<?php echo $row->DI_num?>").html(seller_id);
                    }
                });

                $.ajax({ //구매자 id 출력
                    type: "POST",
                    url: "/deal/deal_find_id",
                    data: {"idx": buyer},
                    success: function (data) {
                        var parse = JSON.parse(data);
                        var buyer_id = parse.User_id;
                        $("#buyer<?php echo$row->DI_num?>").html(buyer_id);
                    }
                });

                $(document).ready(function () { //거래 취소 버튼
                    $('#deal_cancel<?php echo $row->DI_num ?>').click(function () {
                        var deal_num = <?php echo $row->DI_num ?>;
                        $.ajax({
                            type: "POST",
                            url: "/deal/cancel_deal",
                            data: {"DI_num": deal_num},
                            success: function (data) {
                                alert("취소되었습니다.");
                                window.location.reload();
                            }
                        })
                    });

                    $('#deal_seller_confirm<?php echo $row->DI_num ?>').click(function () { //판매자 거래 확인 버튼
                        if (<?php echo $row->DI_other_state?> == 1 )
                        {
                            var deal_num = <?php echo $row->DI_num ?>;
                            var seller = <?php echo $this->session->userdata('userNum')?>;
                            var price = <?php echo $row->DI_price?>;
                            $.ajax({
                                type: "POST",
                                url: "/deal/deal_confirm",
                                data: {
                                    "DI_num": deal_num,
                                    "DI_target": seller,
                                    "DI_price": price,
                                    "DI_state": 1
                                },
                                success: function (data) {
                                    alert("처리되었습니다");
                                    window.location.reload();
                                }
                            });
                        }
                        else
                        {
                            alert("구매자 확인 요청 대기중입니다.");
                            event.preventDefault();
                        }
                    });



                    $('#deal_buyer_confirm<?php echo $row->DI_num ?>').click(function () { //구매자 거래 확인 버튼
                        var deal_num = <?php echo $row->DI_num ?>;
                        var buyer = <?php echo $row->DI_buyer?>;
                        var price = <?php echo $row->DI_price?>;
                        var haveMoney = <?php echo $memberinfo->User_money?>;

                        if (price <= haveMoney) {
                            $.ajax({
                                type: "POST",
                                url: "/deal/deal_confirm",
                                data: {
                                    "DI_num": deal_num,
                                    "DI_target": buyer,
                                    "DI_price": price,
                                    "DI_state": 2
                                },
                                success: function (data) {
                                    alert("처리되었습니다.");
                                    window.location.reload();
                                }
                            });
                        } else {
                            alert('소유 금액이 부족합니다.');
                            event.preventDefault();
                        }
                    });

                    $('#deal_sell_notify<?php echo $row->DI_num ?>').click(function () {
                        var deal_num = <?php echo $row->DI_num ?>;
                        $.ajax({
                            type: "POST",
                            url: "/deal/deal_notify",
                            data: {"DI_num": deal_num,
                                "User":1},
                            success: function (data) {
                                console.log(data);
                                alert("신고처리 접수 되었습니다.");
                                window.location.reload();
                            }
                        })
                    });

                    $('#deal_buy_notify<?php echo $row->DI_num ?>').click(function () {
                        var deal_num = <?php echo $row->DI_num ?>;
                        $.ajax({
                            type: "POST",
                            url: "/deal/deal_notify",
                            data: {"DI_num": deal_num,
                                "User":2},
                            success: function (data) {
                                alert("신고처리 접수 되었습니다.");
                                console.log(data);
                                window.location.reload();
                            }
                        })
                    });


                    if (<?php echo$row->DI_other_state?> == 1)
                    {
                        var buyButton = document.getElementById("buy_button<?php echo $row->DI_num ?>");
                        buyButton.setAttribute("value", "완료 대기중...");
                        $("#buy_button<?php echo $row->DI_num ?>").prop("disabled", true);
                    }
                });
            </script>
        <?php if ($row->DI_state + $row->DI_other_state < 2){ ?>
        <?php if ($row->DI_seller == $this->session->userdata('userNum')) {
            if ($row->DI_other_state == 0) {
                $deal_state = '상대방 확인 대기중';
            } else if ($row->DI_other_state == 1) {
                $deal_state = '상대방 확인 완료';
            }
        } else if ($row->DI_buyer == $this->session->userdata('userNum')) {
            if ($row->DI_state == 0) {
                $deal_state = '상대방 확인 대기중';
            } else if ($row->DI_state == 1) {
                $deal_state = '상대방 확인 완료';
            }
        } ?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne" style="text-align: center">
                        <h4 class="panel-title">

                            <table class="table" width="100%" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>판매자</th>
                                    <th>상품명</th>
                                    <th>구매자</th>
                                    <th>구매 가격</th>
                                    <th>거래 시작 일시</th>
                                    <th>진행 상태</th>
                                </tr>
                                <tr>
                                    <th id="seller<?php echo $row->DI_num ?>"></th>
                                    <th>subject</th>
                                    <th id="buyer<?php echo $row->DI_num ?>"></th>
                                    <th><?php echo $row->DI_price ?></th>
                                    <th><?php echo $row->DI_date ?></th>
                                    <th><?php echo $deal_state ?></th>
                                </tr>
                                </thead>
                            </table>
                            <?php if ($row->DI_seller == $this->session->userdata('userNum')) { ?>
                                <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true"
                                   aria-controls="collapseOne" id="deal_sell_notify<?php echo $row->DI_num ?>">
                                    <input type="button" value="거래 신고">
                                </a>
                                <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true"
                                   aria-controls="collapseOne" id="deal_seller_confirm<?php echo $row->DI_num ?>">
                                    <input type="button" value="인수/인계 확인">
                                </a>


                            <?php } else if ($row->DI_buyer == $this->session->userdata('userNum')) { ?>
                                <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true"
                                   aria-controls="collapseOne" id="deal_buy_notify<?php echo $row->DI_num ?>">
                                    <input type="button" value="거래 신고">
                                </a>
                                <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true"
                                   aria-controls="collapseOne" id="deal_buyer_confirm<?php echo $row->DI_num ?>">
                                    <input type="button" value="인수/인계 확인">
                                </a>
                            <?php } ?>



                            <a data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true"
                               aria-controls="collapseOne" id="deal_cancel<?php echo $row->DI_num ?>">
                                <input type="button" value="취소">
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">
                            판매내용 들어가든 멀 들어가든 먼가 드가겟지 ?
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
</div>