<!DOCTYPE html>
<html lang="en">
<head>
    <title>로그인</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/simple-line-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/icheck/skins/flat/aero.css"/>
    <!-- CSS App -->

    <link href="/static/lib/bootstrap/asset/css/style.css" rel="stylesheet">

    <link rel="shortcut icon" href="/static/lib/bootstrap/asset/img/logomi.png">

</head>
<body id="mimin" class="dashboard form-signin-wrapper">
<?php
if($this->session->flashdata('message')){
    ?>
    <script>
        alert('<?php echo$this->session->flashdata('message')?>');
    </script>
    <?php
}
?>
<div class="container" style="margin-top: 30px;">
    <form class="form-signin" action="/member/member_check" method="post">
        <div class="panel periodic-login">
            <div class="panel-body text-center">
                <h1 class="atomic-symbol">★</h1>
                <!--<p class="element-name">Miminium</p>-->
<br><br>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="id" required>
                    <span class="bar"></span>
                    <label>ID</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="pw" required>
                    <span class="bar"></span>
                    <label>Password</label>
                </div>
                <label class="pull-left">
                    <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Remember me
                </label>
                <br><br><br>
                <div style="text-align: center">
                <input type="submit" class="btn-outline" value="로그인"/><br><br>
                </div>
                <div class="text-center" style="padding:5px;">
                    <a href="/auth/register" type="button" class="btn-outline">회원가입 </a>
                </div>
            </div>
        </div>
    </form>
</div>
<footer class="app-footer">
    <div class="wrapper">
        <span class="pull-right">© 2015 Copyright.</span>
    </div>
</footer>
<div>
    <!-- Javascript Libs -->
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/Chart.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/ace/ace.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/ace/mode-html.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/lib/js/ace/theme-github.js"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="/static/lib/bootstrap/dist/js/app.js"></script>
    <script type="text/javascript" src="/static/lib/bootstrap/dist/js/index.js"></script>

    <script src="/static/lib/bootstrap/asset/js/jquery.min.js"></script>
    <script src="/static/lib/bootstrap/asset/js/jquery.ui.min.js"></script>
    <script src="/static/lib/bootstrap/asset/js/bootstrap.min.js"></script>

    <script src="/static/lib/bootstrap/asset/js/plugins/moment.min.js"></script>
    <script src="/static/lib/bootstrap/asset/js/plugins/icheck.min.js"></script>

    <!-- custom -->
    <script src="/static/lib/bootstrap/asset/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-aero',
                radioClass: 'iradio_flat-aero'
            });
        });
    </script>
</div>
</body>

</html>