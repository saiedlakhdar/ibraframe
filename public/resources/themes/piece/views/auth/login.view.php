<?php
$rend = rand(1,3) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $header_page_title ; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/resources/auththmplate/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/css/util.css">
    <link rel="stylesheet" type="text/css" href="/resources/auththmplate/css/main.css">
    <!--===============================================================================================-->
</head>
<body style="background-color: #999999;">

<div class="limiter">
    <div class="container-login100">
        <div class="login100-more" style="background-image: url('/resources/auththmplate/images/bg-0<?= $rend ;?>.jpg');"></div>

        <div class="wrap-login100 p-l-50 p-r-50 p-t-40 ">
            <form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-59">
						Login
					</span>
                <!--Alert Messanger -->
                <?php $messages = $this->Messanger->getmessages() ; if (!empty($messages)) : foreach ($messages as $message) :   ?>
                    <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                        <?= $message[0] ;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endforeach; endif; ?>


                <div class="wrap-input100 validate-input" data-validate = "Username is required">
                    <span class="label-input100">Username Or Email</span>
                    <input class="input100" type="text" name="username" placeholder="Username Or Email">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="*************">
                    <span class="focus-input100"></span>
                </div>




                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" name="login">
                            Sign In
                        </button>
                    </div>

                    <a href="/auth/register" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                        Sign Up
                        <i class="fa fa-long-arrow-right m-l-5"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="/resources/auththmplate/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/resources/auththmplate/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/resources/auththmplate/vendor/bootstrap/js/popper.js"></script>
<script src="/resources/auththmplate/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/resources/auththmplate/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="/resources/auththmplate/vendor/daterangepicker/moment.min.js"></script>
<script src="/resources/auththmplate/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/resources/auththmplate/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="/resources/auththmplate/js/main.js"></script>

</body>
</html>