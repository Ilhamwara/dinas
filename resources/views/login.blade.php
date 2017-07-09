<!DOCTYPE html>
<html class=" ">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>E Perjadin | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" href="../assets/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->


    <!-- CORE CSS FRAMEWORK - START -->
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START --> 


    <link href="../assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" media="screen"/>

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END --> 


    <!-- CORE CSS TEMPLATE - START -->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS TEMPLATE - END -->

    <style type="text/css">
        body{


background: #a73737; /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #a73737 , #7a2828); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #a73737 , #7a2828); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        
        }
        h1 {
            color: #fff;
        }

        .loginpage input[type=text] {
            color : #777;
        }
        .loginpage input[type=text] focus {
            border : 1px solid #fc0;
        }

        #wp-submit{
            background: #fff;
            color: #333;
        }
    </style>

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="">

    <div class="container-fluid">
        <div class="login-wrapper row">
            <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">
                <h1>E Perjadin</h1>

                <form name="loginform" id="loginform" action="" method="post">
                    <p>
                        <label for="user_login">Username<br />
                            <input type="text" name="username" id="user_login" class="input" /></label>
                        </p>
                        <p>
                            <label for="user_pass">Password<br />
                                <input type="password" name="password" id="user_pass" class="input" /></label>
                            </p>
                            <!-- <p class="forgetmenot">
                                <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" class="icheck-minimal-aero" checked> Remember me</label>
                            </p> -->



                            <p class="submit">
                                <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-accent btn-block" value="Sign In" />
                            </p>
                        </form>

<!--                         <p id="nav">
                            <a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a>
                            <a class="pull-right" href="ui-register.html" title="Sign Up">Sign Up</a>
                        </p> -->


                    </div>
                </div>
            </div>




            <!-- MAIN CONTENT AREA ENDS -->
            <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


            <!-- CORE JS FRAMEWORK - START --> 
            <script src="../assets/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
            <script src="../assets/js/jquery.easing.min.js" type="text/javascript"></script> 
            <script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
            <script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
            <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
            <script src="../assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
            <script>window.jQuery||document.write('<script src="../assets/js/jquery-1.11.2.min.js"><\/script>');</script>
            <!-- CORE JS FRAMEWORK - END --> 


            <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 

            <script src="../assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
            <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


            <!-- CORE TEMPLATE JS - START --> 
            <script src="../assets/js/scripts.js" type="text/javascript"></script> 
            <!-- END CORE TEMPLATE JS - END --> 


            <!-- General section box modal start -->
            <div class="modal" id="section-settings" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog animated bounceInDown">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Section Settings</h4>
                        </div>
                        <div class="modal-body">

                            Body goes here...

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                            <button class="btn btn-success" type="button">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal end -->
        </body>
        </html>