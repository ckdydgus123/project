<!DOCTYPE html>
<html lang="en">
<head>
    <title>중고SnS</title>

    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/static/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- daragula -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/static/lib/dragula-master/favicon.ico">
    <link href='/static/lib/dragula-master/dist/dragula.css' rel='stylesheet' type='text/css'/>
    <link href='/static/lib/dragula-master/example/example.css' rel='stylesheet' type='text/css'/>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->

    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/nouislider.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/select2.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/static/lib/bootstrap/asset/css/plugins/ionrangeslider/ion.rangeSlider.css"/>
    <link rel="stylesheet" type="text/css"
          href="/static/lib/bootstrap/asset/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css"/>
    <link rel="stylesheet" type="text/css"
          href="/static/lib/bootstrap/asset/css/plugins/bootstrap-material-datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/datatables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/simple-line-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/icheck/skins/flat/aero.css"/>
    <!-- CSS App -->

    <link href="/static/lib/bootstrap/asset/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="/static/lib/bootstrap/asset/img/logomi.png">
    <script src="/static/lib/bootstrap/asset/js/plugins/html5shiv.js"></script>
    <script src="/static/lib/bootstrap/asset/js/plugins/respond.min.js"></script>

    <!--ckeditor-->
    <script src="/static/lib/ckeditor/ckeditor.js"></script>

    <!--chatsocket-->
    <script src="../../../node_modules/socket.io-client/socket.io.js"></script>
</head>

<body id="mimin" class="dashboard">
<?php

if ($this->session->flashdata('message')) {
    ?>
    <script>
        alert('<?php echo$this->session->flashdata('message')?>');
    </script>
    <?php
}
?>
<!-- start: Header -->
<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-11 nav-wrapper">
        <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>

            <a href="/home/" class="navbar-brand">
                <b>Feather</b>
            </a>
            <ul class="nav navbar-nav search-nav">
                <li>
                    <div class="search">
                        <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                        <div class="form-group form-animate-text">
                            <form action="/boardandcomment/search" method="post">
                                <input type="text" class="form-text" name="keyword"
                                       placeholder="키워드를 입력하세요." required>
                            </form>
                            <span class="bar"></span>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name">
                    <font color="yellow" size="4px">
                        <i class="fa fa-pagelines" style="color:lightgreen;"></i>
                        <a data-toggle="modal" data-target="#myModal"><font color="yellow" size="4px">
                                &nbsp;&nbsp;<b><?php echo $memberinfo->User_money ?> 개</b></font></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </font>
                    <span><a
                            href="/usertimeline/index/<?php echo $this->session->userdata('userNum') ?>/0"><?php echo $this->session->userdata('loginID') . "(" . $this->session->userdata('userName') . ")" ?></a></span>
                </li>
                <li class="dropdown avatar-dropdown">
                    <img src="/static/lib/bootstrap/asset/img/satom2i.jpg" class="img-circle avatar" alt="user name"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                    <ul class="dropdown-menu user-dropdown">
                        <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                        <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="more">
                            <ul>
                                <li><a href=""><span class="fa fa-cogs"></span></a></li>
                                <li><a href=""><span class="fa fa-lock"></span></a></li>
                                <li><a href=""><span class="fa fa-power-off "></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- end: Header -->

<div class="container-fluid mimin-wrapper">
    <!-- start:Left Menu -->
    <div id="left-menu">
        <div class="sub-left-menu scroll">
            <ul class="nav nav-list">
                <li class="time">
                    <h1 class="animated fadeInLeft">21:00</h1>

                    <p class="animated fadeInRight">Sat,October 1st 2029</p>
                </li>
                <li class="active ripple">
                    <a href="/home/"><span class="fa-home fa"></span>
                        <font color="#0B0B3B">Home</font>
                    </a>
                </li>
                <li class="active ripple">
                    <a href="/usertimeline/index/<?php echo $this->session->userdata('userNum') ?>/0"><span
                            class="fa-home fa"></span>
                        <font color="#0B0B3B">내정보</font>
                    </a>
                </li>
                <li class="active ripple">
                    <a class="tree-toggle nav-header"><span class="fa-home fa"></span><font color="#0B0B3B">페이지</font>
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="dashboard-v1.html">└ 페이지추가</a></li>
                        <li><a href="dashboard-v1.html">가입한 페이지1</a></li>
                        <li><a href="dashboard-v2.html">가입한 페이지2</a></li>
                        <li><a href="dashboard-v2.html">가입한 페이지3</a></li>
                    </ul>
                </li>
                <li class="active ripple">
                    <a class="tree-toggle nav-header"><span class="fa-home fa"></span><font color="#0B0B3B">거래</font>
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="/deal/deallog/<?php echo $this->session->userdata('userNum') ?>">거래내역</a></li>
                        <li><a href="/deal/dealing/<?php echo $this->session->userdata('userNum') ?>">거래진행</a></li>
                    </ul>
                </li>
                <li class="active ripple">
                    <a href="/member/logout"><span class="fa-home fa"></span>
                        <font color="#0B0B3B">로그아웃</font>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end: Left Menu -->

    <!-- start: right menu -->
    <div id="right-menu">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#right-menu-user">
                    <span class="fa fa-comment-o fa-2x"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#right-menu-notif">
                    <span class="fa fa-bell-o fa-2x"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#right-menu-config">
                    <span class="fa fa-cog fa-2x"></span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="right-menu-user" class="tab-pane fade in active">
                <div class="search col-md-12">
                    <input type="text" placeholder="search.."/>
                </div>
                <div class="user col-md-12">
                    <ul class="nav nav-list">
                        <?php $cnt = 0 ?>
                        <?php foreach ($friend_list as $row) {
                            $friend_main = $this->session->userdata('userNum');

                            if ($friend_main == $row->Friend_master) {
                                $friend_sub = $row->Friend_follow;
                            } else {
                                $friend_sub = $row->Friend_master;
                            }
                            ?>
                            <script>
                                var friend_sub = <?php echo$friend_sub?>;
                                $.ajax({
                                    type: "POST",
                                    url: "/home/friend_id",
                                    data: {"idx": friend_sub},
                                    success: function (data) {
                                        var obj_data = JSON.parse(data);
                                        var id = obj_data[0].User_id;
                                        $("#friend_id<?php echo$cnt?>").html(id);
                                    }
                                })
                            </script>

                            <li class="online">
                                <img src="asset/img/avatar.jpg" alt="user name">

                                <div class="name">
                                    <a href="/usertimeline/index/<?php echo $friend_sub ?>/0"><h5><b
                                                id="friend_id<?php echo $cnt ?>"></b></h5></a>
                                </div>


                                <div class="gadget">
                                    <span class="fa  fa-mobile-phone fa-2x"></span>
                                </div>
                                <div class="dot"></div>
                            </li>
                            <?php
                            $cnt++;
                        } ?>


                    </ul>
                </div>
                <!-- Chatbox -->
                <div class="col-md-12 chatbox">
                    <div class="col-md-12">
                        <a href="#" class="close-chat">X</a><h4>사용자이름</h4>
                    </div>
                    <div class="chat-area">
                        <div class="chat-area-content">
                            <div class="msg_container_base">
                                <div class="row msg_container send">
                                    <div class="col-md-9 col-xs-9 bubble">
                                        <div class="messages msg_sent">
                                            <p>that mongodb thing looks good, huh?
                                                tiny master db, and huge document store</p>
                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-3 avatar">
                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">
                                    </div>
                                </div>

                                <div class="row msg_container receive">
                                    <div class="col-md-3 col-xs-3 avatar">
                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">
                                    </div>
                                    <div class="col-md-9 col-xs-9 bubble">
                                        <div class="messages msg_receive">
                                            <p>that mongodb thing looks good, huh?
                                                tiny master db, and huge document store</p>
                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                        </div>
                                    </div>
                                </div>

                                <div class="row msg_container send">
                                    <div class="col-md-9 col-xs-9 bubble">
                                        <div class="messages msg_sent">
                                            <p>that mongodb thing looks good, huh?
                                                tiny master db, and huge document store</p>
                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-3 avatar">
                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">
                                    </div>
                                </div>

                                <div class="row msg_container receive">
                                    <div class="col-md-3 col-xs-3 avatar">
                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">
                                    </div>
                                    <div class="col-md-9 col-xs-9 bubble">
                                        <div class="messages msg_receive">
                                            <p>that mongodb thing looks good, huh?
                                                tiny master db, and huge document store</p>
                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                        </div>
                                    </div>
                                </div>

                                <div class="row msg_container send">
                                    <div class="col-md-9 col-xs-9 bubble">
                                        <div class="messages msg_sent">
                                            <p>that mongodb thing looks good, huh?
                                                tiny master db, and huge document store</p>
                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-3 avatar">
                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">
                                    </div>
                                </div>

                                <div class="row msg_container receive">
                                    <div class="col-md-3 col-xs-3 avatar">
                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">
                                    </div>
                                    <div class="col-md-9 col-xs-9 bubble">
                                        <div class="messages msg_receive">
                                            <p>that mongodb thing looks good, huh?
                                                tiny master db, and huge document store</p>
                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-input">
                        <textarea placeholder="type your message here.."></textarea>
                    </div>
                    <div class="user-list">
                        <ul>
                            <li class="online">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <div class="user-avatar"><img src="asset/img/avatar.jpg" alt="user name"></div>
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">

                                    <div class="dot"></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="right-menu-notif" class="tab-pane fade">

                <ul class="mini-timeline">
                    <li class="mini-timeline-highlight">
                        <div class="mini-timeline-panel">
                            <h5 class="time">07:00</h5>

                            <p>Coding!!</p>
                        </div>
                    </li>

                    <li class="mini-timeline-highlight">
                        <div class="mini-timeline-panel">
                            <h5 class="time">09:00</h5>

                            <p>Playing The Games</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight">
                        <div class="mini-timeline-panel">
                            <h5 class="time">12:00</h5>

                            <p>Meeting with <a href="#">Clients</a></p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-warning">
                        <div class="mini-timeline-panel">
                            <h5 class="time">15:00</h5>

                            <p>Breakdown the Personal PC</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-info">
                        <div class="mini-timeline-panel">
                            <h5 class="time">15:00</h5>

                            <p>Checking Server!</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-success">
                        <div class="mini-timeline-panel">
                            <h5 class="time">16:01</h5>

                            <p>Hacking The public wifi</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-danger">
                        <div class="mini-timeline-panel">
                            <h5 class="time">21:00</h5>

                            <p>Sleep!</p>
                        </div>
                    </li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>

            </div>
            <div id="right-menu-config" class="tab-pane fade">
                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Notification</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-info">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch1"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch1"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Custom Designer</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-danger">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch2"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch2"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Autologin</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-success">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch3"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch3"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Auto Hacking</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-warning">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch4"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch4"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Auto locking</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch5"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch5"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>FireWall</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch6"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch6"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>CSRF Max</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-warning">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch7"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch7"></label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Man In The Middle</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-danger">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch8"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch8"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Auto Repair</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-success">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch9"
                                   checked>
                            <label class="onoffswitch-label" for="myonoffswitch9"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="button" value="More.." class="btnmore">
                </div>

            </div>
        </div>
    </div>
    <!-- end: right menu -->

</div>

