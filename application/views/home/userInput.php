<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flat Admin V.2 - Free Bootstrap Admin Templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/dist/lib/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/simple-line-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/asset/css/plugins/icheck/skins/flat/aero.css"/>
    <!-- CSS App -->

    <link href="/static/lib/bootstrap/asset/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/css/style.css">
    <link rel="stylesheet" type="text/css" href="/static/lib/bootstrap/css/themes/flat-blue.css">

    <link rel="shortcut icon" href="/static/lib/bootstrap/asset/img/logomi.png">

</head>
<body id="mimin" class="dashboard form-signin-wrapper">

<div class="container">
    <div class="">
        <div class="col-md-12 ">
            <div class="col-md-12 panel-heading">
                <h4>회원가입</h4>
            </div>
            <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <form class="cmxform" id="signupForm" method="post" action="/auth/register">
                        <div class="col-md-6">
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" class="form-text" id="validate_firstname" name="User_id"
                                       required>
                                <span class="bar"></span>
                                <label>ID</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" class="form-text" id="validate_lastname" name="User_pw"
                                       required>
                                <span class="bar"></span>
                                <label>Password</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" class="form-text" id="validate_username" name="User_pw_ck"
                                       required>
                                <span class="bar"></span>
                                <label>PwCheck</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="password" class="form-text" id="validate_password" name="User_name"
                                       required>
                                <span class="bar"></span>
                                <label>Name</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="password" class="form-text" id="validate_confirm_password" value="birth"
                                       name="User_registration" required>
                                <span class="bar"></span>
                                <label>birth date</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" class="form-text" id="validate_email" name="User_mail" value="email" required>
                                <span class="bar"></span>
                                <label>E-mail</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" class="form-text" id="validate_email" name="User_address" value="address" required>
                                <span class="bar"></span>
                                <label>Address</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                <input type="text" class="form-text" id="validate_email" name="User_account" value="account" required>
                                <span class="bar"></span>
                                <label>Account Number</label>
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <input type="text" class="form-text" id="user_phone" value="phone"
                                           name="User_phone" required>
                                    <span class="bar"></span>
                                    <label>Phone Number</label>
                                </div>
                            </div>
                            <div style="text-align: center">
                                <input class="submit btn btn-danger" type="submit" value="In">
                            </div>
                        <input type="hidden" name="User_kind" value="normal">
                        <input type="hidden" name="User_BN" value="normal">
                        <input type="hidden" name="User_sex" value="man">
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        $(document).ready(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-aero',
                radioClass: 'iradio_flat-aero'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $("#signupForm").validate({
                errorElement: "em",
                errorPlacement: function (error, element) {
                    $(element.parent("div").addClass("form-animate-error"));
                    error.appendTo(element.parent("div"));
                },
                success: function (label) {
                    $(label.parent("div").removeClass("form-animate-error"));
                },
                rules: {
                    validate_firstname: "required",
                    validate_lastname: "required",
                    validate_username: {
                        required: true,
                        minlength: 2
                    },
                    validate_password: {
                        required: true,
                        minlength: 5
                    },
                    validate_confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#validate_password"
                    },
                    validate_email: {
                        required: true,
                        email: true
                    },
                    validate_agree: "required"
                },
                messages: {
                    validate_firstname: "Please enter your firstname",
                    validate_lastname: "Please enter your lastname",
                    validate_username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 2 characters"
                    },
                    validate_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    validate_confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    validate_email: "Please enter a valid email address",
                    validate_agree: "Please accept our policy"
                }
            });
            )
            ;
        });
    </script>
</div>
</body>

</html>