<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sliding Side Bar</title>
    <script type="text/javascript" src="/data/201107/IJ13105365167052/mootools.js"></script>
    <script type="text/javascript" src="/data/201107/IJ13105365167052/side-bar.js"></script>

    <style media="all" type="text/css">

        body{
            position:relative;
            paddign:0px;
            font-size:100%;
        }

        h2{
            color:#FFFFFF;
            font-size:90%;
            font-family:arial;
            margin:10px 10px 10px 10px;
            font-weight:bold;
        }

        h2 span{
            font-size:105%;
            font-weight:normal;
        }

        ul{
            margin:0px 0px 0px 0px;
            padding:0px 0px 0px 0px;
        }

        li{
            margin:0px 10px 3px 10px;
            padding:2px;
            list-style-type:none;
            display:block;
            background-color:#DA1074;
            width:177px;
        }

        li a{
            width:100%;
        }

        li a:link,
        li a:visited{
            color:#FFFFFF;
            font-family:verdana;
            font-size:70%;
            text-decoration:none;
            display:block;
            margin:0px 0px 0px 0px;
            padding:0px;
            width:100%;
        }

        li a:hover{
            color:#FFFFFF;
            text-decoration:underline;
        }

        #sideBar{
            position: absolute;
            width: auto;
            height: auto;
            top: 200px;
            right:-7px;
            background-image:url(/data/201107/IJ13105365167052/background.gif);
            background-position:top left;
            background-repeat:repeat-y;
        }

        #sideBarTab{
            float:left;
            height:137px;
            width:28px;
        }

        #sideBarTab img{
            border:0px solid #FFFFFF;
        }

        #sideBarContents{
            overflow:hidden !important;
        }

        #sideBarContentsInner{
            width:200px;
        }

    </style>

    <script type="text/javascript" src="js/mootools.js"></script>
    <script type="text/javascript" src="js/side-bar.js"></script>

</head>

<body>

<div id="sideBar">

    <a href="#" id="sideBarTab"><img src="" alt="sideBar" title="sideBar" /></a>

    <div id="sideBarContents" style="width:0px;">
        <div id="sideBarContentsInner">
            <h2>side<span>bar</span></h2>

            <ul>
                <li><a href="#">Link One</a></li>
                <li><a href="#">Link Two</a></li>
                <li><a href="#">Link Three</a></li>
                <li><a href="#">Link Four</a></li>
                <li><a href="#">Link Five</a></li>
            </ul>

        </div>
    </div>

</div>

</body>
</html>