<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>修改资料</title>
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta content="webkit" name="renderer">
    <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
    <link href="/favicon.ico?v=3" rel="shortcut icon">
    <link rel="shortcut icon" href="../favicon.ico">

    <link href="/tp/Public/css/style2.css" type="text/css" rel="stylesheet">
</head>






<body>

<header>
    <!--==============================
                Stuck menu
    =================================-->
    <section style="position: absolute; top: 0px;" id="stuck_container">
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <h1>
                        <a href="主页.html">

                        </a>
                    </h1>
                </div>
            </div>
        </div>
    </section><div style="position:relative; display: block; height: 0px;" class="pseudoStickyBlock"></div>
</header>

<br>
<br>
<br>
<br>

<div class="bdw" id="bdw">
    <div class="cf" id="bd">
        <div class="pg-account" id="content">
            <div class="box">
                <div class="head"><h2>修改信息</h2></div>
                <div class="sect cf">
                    <div class="modify-content-left">
                        <form action="/tp/index.php/Home/Index/modify" method="post" id="account-modify-form">
                            <div class="field-group">
                                <label for="account-modify-phone">电  话</label>
                                <input type="text" class="f-text" id="account-modify-phone" name="phoneNum" size="15" tabindex="2" value="<?php echo ($phoneNum); ?>">

                            </div>

                          <!--  <div class="field-group field-group--password">
                                <label for="account-modify-password">密  码</label>
                                <input type="password" class="f-text" id="account-modify-password" name="password" size="15" tabindex="3",value="<?php echo ($password); ?>">

                            </div>
                            -->
                            <div class="field-group">
                                <label for="storename">店铺名称</label>
                                <input type="text" class="f-text" id="storename" maxlength="100" name="rest_name" size="15" tabindex="4" value="<?php echo ($rest_name); ?>">

                            </div>
                            <div class="field-group field-group-description">
                                <label for="description">店铺描述</label>
                                <input type="text"  class="f-text" id="description" maxlength="100" name="description" size="15" tabindex="5" value="<?php echo ($description); ?>">

                            </div>

                            <div class="field-group">
                                <label for="province"> 省 </label>
                                <input id="province" name="province"  class="f-text" type="text"  maxlength="100" size="15" tabindex="6" value="<?php echo ($province); ?>">
                            </div>

                            <div class="field-group">
                                <label for="city"> 市 </label>
                                <input id="city" name="city" class="f-text" type="text" maxlength="100" size="15" tabindex="7" value="<?php echo ($city); ?>"/>
                            </div>

                            <div class="field-group">
                                <label for="zone"> 区 </label>
                                <input id="zone" name="zone" class="f-text" type="text" maxlength="100" size="15" tabindex="8" value="<?php echo ($zone); ?>"/>
                            </div>

                            <div class="field-group field-group--add">
                                <label for="account-modify-address">详细地址</label>
                                <input type="text" class="f-text" id="account-modify-address" name="addr" size="15" tabindex="9" value="<?php echo ($addr); ?>">

                            </div>

                            <br>

                            <div class="field-group">
                                <input type="submit" class="form-button" value="提 交" tabindex="10">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- bd end -->
</div>



</body>
</html>