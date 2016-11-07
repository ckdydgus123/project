
<-- Modal 충전 환전 팝업 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">충전 & 환전</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="#" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">보유머니</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3"
                                   value="<?php echo $memberinfo->User_money ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">
                            <input type="radio" name="option" onclick="chk(this);" value="1">
                            환전
                        </label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sel1" placeholder="환전머니" min="0" max="보유머니"
                                   disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">
                            <input type="radio" name="option" onclick="chk(this);" value="2">
                            충전</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sel2" placeholder="충전머니" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="money_change">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- dragula-master -->
<script src='/static/lib/dragula-master/dist/dragula.js'></script>
<script src='/static/lib/dragula-master/example/example.min.js'></script>

<!-- start: Javascript -->
<script src="/static/lib/bootstrap/asset/js/jquery.min.js"></script>
<script src="/static/lib/bootstrap/asset/js/jquery.ui.min.js"></script>
<script src="/static/lib/bootstrap/asset/js/bootstrap.min.js"></script>

<!-- plugins -->

<!--데이터베이스 js 자동 페이지네이션-->
<script src="/static/lib/bootstrap/asset/js/plugins/jquery.datatables.min.js"></script>
<script src="/static/lib/bootstrap/asset/js/plugins/datatables.bootstrap.min.js"></script>
<script src="/static/lib/bootstrap/asset/js/plugins/moment.min.js"></script>
<!--드랍다운 도글 스크롤-->
<script src="/static/lib/bootstrap/asset/js/plugins/jquery.nicescroll.js"></script>
<!--차트 js-->
<script src="/static/lib/bootstrap/asset/js/plugins/chart.min.js"></script>

<!--거래 내역 데이터베이스 js-->
<script src="/static/lib/bootstrap/asset/js/plugins/jquery.mask.min.js"></script>
<script src="/static/lib/bootstrap/asset/js/plugins/ion.rangeSlider.min.js"></script>
<script src="/static/lib/bootstrap/asset/js/plugins/bootstrap-material-datetimepicker.js"></script>

<!-- custom -->
<script src="/static/lib/bootstrap/asset/js/main.js"></script>

<!--시간,데이터,폰넘버 등 자동 구분-->
<script type="text/javascript">
    // 스크롤 반응형 메뉴바 jquery
    $(document).ready(function () {
        var currentPosition = parseInt($("#slidemenu").css("top"));
        $(window).scroll(function () {
            var position = $(window).scrollTop(); // 현재 스크롤바의 위치값을 반환합니다.
            $("#slidemenu").stop().animate({"top": position + currentPosition + "px"}, 500);
        });

    });
    // 머니 환전, 충전 구별
    function chk(elem) {
        if (elem.value == '1') {
            if (<?php echo$memberinfo->User_money?> == 0)
            {
                alert("환전할 SNS머니가 부족합니다.");
            }
        else
            {
                $('#sel1').attr('disabled', false);
                $('#sel2').attr('disabled', true);
            }
        } else {
            $('#sel1').attr('disabled', true);
            $('#sel2').attr('disabled', false);
        }
    }

    $(document).ready(function () {
        // 친구추가 버튼 쿼리 친구추가시 체크 버튼으로
        $(".btn-flip").on("click", function () {
            $(this).find(".flip").animate().replaceWith("<span class='fa fa-check' style='font-size:2em;'></span>");
        });
        $('#myCollapsible').on('hidden.bs.collapse', function () {
            // do something…
        });
        $('#money_change').click(function () {
            var target = <?php echo$this->session->userdata('userNum')?>;//현재 유저
            var currentMoney = <?php echo $memberinfo->User_money ?>;//현재 소유 머니
            var exchang = document.getElementById('sel1').value;//환전하고자 하는 액수
            var charge = document.getElementById('sel2').value;//충전하고자 하는 액수
            if(exchang > 0)
            {
                if(exchang > currentMoney){
                    alert('환전 금액이 소유금액을 초과했습니다.');
                    event.preventDefault();
                }else{
                    $.ajax({
                        type: "POST",
                        url: "/member/money_exchang",
                        data: {"idx": target, "money": exchang},
                        success: function (data)
                        {
                            alert("환전 처리 되었습니다. 환전액은 지정된 고객님 계좌로 입금됩니다.");
                        }
                    });
                }
            }
            else if(charge > 0)
            {
                $.ajax({
                    type: "POST",
                    url: "/member/money_charge",
                    data: {"idx": target, "money": charge},
                    success: function (data)
                    {
                       alert("충전완료");
                    }
                });
            }
        })
        // popover demo
        $("a[data-toggle=popover]")
            .popover()
            .click(function (e) {
                e.preventDefault()
            });
        // 돈 바 나타 낼 때 사용
        $("#range1").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: -1000,
            to: 1000
        });
        // input 함수 class 자동 설정
        $('#datatables-example').DataTable();
        $('.mask-money').mask('00,000,000,000,000,000', {reverse: true});
        $('.mask-money2').mask("#.##0,00", {reverse: true});
        $('.mask-phone_us').mask('(000) 000-0000');
        $('.mask-date').mask('00/00/0000');
        $('.mask-time').mask('00:00:00');
        $('.mask-date_time').mask('00/00/0000 00:00:00');
    });
</script>

</body>

</html>
