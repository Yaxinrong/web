<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Login Nourriture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login in Nourriture" />
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <meta name="author" content="Codrops" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="/hhw/Public/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/hhw/Public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/hhw/Public/css/animate-custom.css" />
</head>
<body>
<div class="container">
    <!-- Codrops top bar -->
    <div class="codrops-top">
        <a href="">
            <strong>&laquo; Previous Demo: </strong>Responsive Content Navigator
        </a>
                <span class="right">
                    <a href=" http://tympanus.net/codrops/2012/03/27/login-and-registration-form-with-html5-and-css3/">
                        <strong>Back to the Codrops Article</strong>
                    </a>
                </span>
        <div class="clr"></div>
    </div><!--/ Codrops top bar -->
    <header>
        <h1>Login  in Nourriture</h1>
        <nav class="codrops-demos">

            <a href="index.html" class="current-demo">Demo 1</a>

        </nav>
    </header>
    <section>
        <div id="container_demo" >
            <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form  action="/hhw/index.php/Home/Index/check" autocomplete="on" method="post">
                        <h1>Log in</h1>
                        <p>
                            <label for="username" class="uname" data-icon="u" > Your email or username </label>
                            <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                        </p>
                        <p>
                            <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                            <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />
                        </p>
                        <p class="keeplogin">
                            <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
                            <label for="loginkeeping">Keep me logged in</label>
                        </p>
                        <p class="login button">
                            <input type="submit" value="Login" />
                        </p>
                        <p class="change_link">
                            Not a member yet ?
                            <a href="#toregister" class="to_register">Join us</a>
                        </p>
                    </form>
                </div>

                <div id="register" class="animate form">
                    <form  action="/hhw/index.php/Home/Index/register" autocomplete="on" method="post">
                        <h1> Sign up </h1>
                        <p>
                            <label for="account_register" class="uname" data-icon="u">Your username</label>
                            <input id="account_register" name="account_register" required="required" type="text" placeholder="mysuperusername690" />
                        </p>
                        <p>
                            <label for="phone_num" class="youtel" > Your tel </label>
                            <input id="phone_num" name="phone_num" required="required" type="text" placeholder="10123456789"/>
                        </p>
                        <p>
                            <label for="password_register" class="youpasswd" >Your password </label>
                            <input id="password_register" name="password_register" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        </p>
                        <p>
                            <label for="pwd_again_register" class="youpasswd" >Please confirm your password </label>
                            <input id="pwd_again_register" name="pwd_again_register" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        </p>

                        <p>
                            <label for="rest_name" class="ushop" >Shop name </label>
                            <input id="rest_name" name="rest_name" required="required" type="text" placeholder="shopname" />
                        </p>

                        <p>
                            <label for="description" class="ushopdexcription" >Shop description </label>
                            <input id="description" name="description" required="required" type="text" placeholder="shopdescription" />
                        </p>


                        <p>
                            <label for="province" class="province" >Province </label>
                            <input id="province" name="province" required="required" type="text"placeholder="Your province..."   />
                        </p>

                        <p>
                            <label for="city" class="ucity" >City </label>
                            <input id="city" name="city" required="required" type="text" placeholder="Your city..."  />
                        </p>

                        <p>
                            <label for="zone" class="uzone" >Zone </label>
                            <input id="zone" name="zone" required="required" type="text"placeholder="Your zone..."   />
                        </p>

                        <p>
                            <label for="addr" class="uaddr" >Your address </label>
                            <input id="addr" name="addr" required="required" type="text" placeholder="Your address..." />
                        </p>
                        <p class="signin button">
                            <input type="submit" value="Sign up"/>
                        </p>
                        <p class="change_link">
                            Already a member ?
                            <a href="#tologin" class="to_register"> Go and log in </a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
</body>
</html>