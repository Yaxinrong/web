<?php if (!defined('THINK_PATH')) exit();?><html><head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>上传菜谱</title>
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta content="webkit" name="renderer">
    <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="/tp/Public/css/css.css">
    <link rel="stylesheet" href="/tp/Public/css/recipe.css">
    <link rel="stylesheet" href="/tp/Public/css/recipeadd.css">
    <link rel="stylesheet" href="/tp/Public/css/uploadify.css">

    <meta content="IE=Edge,chrome=1" http-equiv="X-UA-Compatible">
    <link href="/favicon.ico?v=3" rel="shortcut icon">

    <script type="text/javascript">
        $(function() {
            $('#file_upload').uploadify({
                'swf'      : '/tp/Public/js/uploadify.swf',
                'uploader' : '__INDEX__/uploaddish',
                'buttonText' : '上传成品图',
                'onUploadSuccess' : function(file, data, response) {
                    $('#image').attr('src','/tp/Public/image/logo.png'+data);
                    $('#pic').val(data);
                },
            });
        });
    </script>

<body>


<header>
    <!--==============================
                Stuck menu
    =================================-->
    <section style="position: relative; top: 0px;" id="stuck_container">
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <h1>
                        <a href="index.html">
                            <img src="/tp/Public/image/logo.png" alt="Logo alt">
                        </a>
                    </h1>
                </div>
            </div>
        </div>
    </section><div style="position: relative; display: block; height: 0px;" class="pseudoStickyBlock"></div>
</header>

<!-- logo+nav -->
<div class="w logo_wrap">
    <div class="logo_inner left">

    </div>
    <div class="logo_current left">
        <h1><a title="上传菜谱" >上传菜谱</a></h1>
    </div>

</div>




<!-- 主框架 -->
<div class="wrap">
    <form  action="/tp/index.php/Home/Index/upload" autocomplete="on" method="post" enctype=”multipart/form-data”>
    <div class="w clear mod">



        <!-- 右侧 -->
        <div class="mod_right">



            <div class="ui_title mt20">
                <div class="ui_title_wrap">
                    <a class="on" >编辑菜谱</a>
                </div>
                <div class="ui_title_right">
                </div>
            </div>

            <!-- 内容开始 -->

            <div class="content">



                <input type="hidden" value="269572" id="recipeinfo_id">
                <dl class="cp_name">
                    <dt>
                        <span class="dish_name">*</span>
                        <span class="dish_name">菜谱名称：</span>

                    </dt>
                    <dd><input type="text" value=" " name="dish_name" class="btn37 J_Title color_5b"></dd>
                </dl>

                <dl class="uploadImage2">
                    <dt>
                        <span class="pic">*</span>
                        <span class="pic">成品图片：</span>
                    </dt>


                    <dd>

                     <!--   <div class="J_uploadflash J_swf" style="position: relative; left: 0px;">

                                <input name="photo" type="file" id="imgfile" size="40" />
                                <br />
                            <br />
                            <br />
                        </div>
                        -->
                        <div class="avatar_box"> <img id="image" width="130" height="130" border="0" />
                            <div class="upload_avatar"><input id="file_upload" name="file_upload" type="file" multiple="true" value="" /></div>
                        </div>

                        <span style="font-size: 12px; color:#999; float: left; padding: 8px 0px 0px 10px;" ></span>

                    </dd>

                </dl>

                <dl class="cp_price">
                    <dt>
                        <span class="price">*</span>
                        <span class="price">菜品价格：</span>

                    </dt>
                    <dd><input type="text" value=" " name="price" class="btn37 J_Title color_5b"></dd>
                </dl>


                <p>
                    <label>请选择菜品种类： </label>
                    <select name="type" class="utype">
                        <option value="-1">所有类别</option>
                        <option value="1" >凉菜</option>
                        <option value="2" >热菜</option>
                        <option value="3" >汤羹煲炖类</option>
                        <option value="4" >甜品</option>
                        <option value="5" >饮品果汁类</option>
                    </select>
                </p>

                <br>
                <p><input type="checkbox" name="checked" >招牌菜（是否设置为招牌菜）</p>
                <br>



                <dl class="description">
                    <dt>
                        <span class="lable">菜谱描述：</span>

                    </dt>
                    <dd><textarea id="description" name="description" class="area543 color_5b"></textarea></dd>
                </dl>



                <dl class="selectcheckBox">
                    <dt>&nbsp;
                    </dt>
                    <dd>
                        <div class="submitdiv">

                            <input type="submit" value="发布菜谱" id="postbtn" class="postbtn">


                        </div>

                    </dd>

                </dl>

            </div>

            <!-- 内容结束 -->

        </div>
        <!-- 右侧结束 -->
    </div>
    </form>
</div>


</body>
</html>