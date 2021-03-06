<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nourriture 御膳房 我的菜单</title>
  <meta name="description" content="这是一个 user 页面">
  <meta name="keywords" content="user">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/hhw/Public/images/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/hhw/Public/images/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" type="text/css" href="/hhw/Public/css/amazeui.min.css"/>
  <link rel="stylesheet" type="text/css" href="/hhw/Public/css/admin.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>Nourriture</strong> <small>御膳房</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 欢迎，<?php echo ($_SESSION['username']); ?>  <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
          <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
          <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar">
    <ul class="am-list admin-sidebar-list">
      <li><a href="admin-index.html"><span class="am-icon-home"></span> 首页</a></li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 页面模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
          <li><a href="admin_user.html" class="am-cf"><span class="am-icon-check"></span> 商家资料<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
          <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 帮助页</a></li>
          <li><a href="admin-gallery.html"><span class="am-icon-th"></span> 相册页面<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
          <li><a href="admin-log.html"><span class="am-icon-calendar"></span> 系统日志</a></li>
          <li><a href="admin_dish.html"><span class="am-icon-bug"></span> 上传新菜</a></li>
        </ul>
      </li>
      <li><a href="admin_table.html"><span class="am-icon-table"></span> 我的菜单</a></li>
      <li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 表单</a></li>
      <li><a href="#"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-bookmark"></span> 公告</p>
        <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
      </div>
    </div>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-tag"></span> wiki</p>
        <p>Welcome to the Amaze UI wiki!</p>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">上传新菜</strong> / <small>Upload Dish</small></div>
    </div>

    <hr/>

    <div class="am-g">

      <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
        <div class="am-panel am-panel-default">
          <div class="am-panel-bd">
            <div class="am-g">
              <div class="am-u-md-4">
                <img class="am-img-circle am-img-thumbnail" src="http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80" alt=""/>
              </div>
              <div class="am-u-md-8">
                <p>你可以使用<a href="#">gravatar.com</a>提供的头像或者使用本地上传头像。 </p>
                <form class="am-form">
                  <div class="am-form-group">
                    <input type="file" id="user-pic">
                    <p class="am-form-help">请选择要上传的文件...</p>
                    <button type="button" class="am-btn am-btn-primary am-btn-xs">保存</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="am-panel am-panel-default">
          <div class="am-panel-bd">
            <div class="user-info">
              <p>等级信息</p>
              <div class="am-progress am-progress-sm">
                <div class="am-progress-bar" style="width: 60%"></div>
              </div>
              <p class="user-info-order">当前等级：<strong>LV8</strong> 活跃天数：<strong>587</strong> 距离下一级别：<strong>160</strong></p>
            </div>
            <div class="user-info">
              <p>信用信息</p>
              <div class="am-progress am-progress-sm">
                <div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>
              </div>
              <p class="user-info-order">信用等级：正常当前 信用积分：<strong>80</strong></p>
            </div>
          </div>
        </div>

      </div>

      <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
        <form action="/hhw/index.php/Home/Index/upload" autocomplete="on" method="post" enctype=”multipart/form-data class="am-form am-form-horizontal">
          <div class="am-form-group">
            <label  class="am-u-sm-3 am-form-label">菜品名称 / Dish Name</label>
            <div class="am-u-sm-9">
              <input  type="text" value="" name="dish_name">
              <small>给菜取个好听的名字</small>
            </div>

            <div class="am-form-group">
              <label  class="am-u-sm-3 am-form-label">成品图片 / Picture</label>
              <div class="am-u-sm-9">
                <dl class="uploadImage2">
                  <dt>
                    <span class="pic">*</span>
                  </dt>
                  <dd>
                    <div class="upload_avatar"><input id="file_upload" name="file" type="file" multiple="true" ></div>
                    <span style="font-size: 12px; color:#999; float: left; padding: 8px 0px 0px 10px;" ></span>
                  </dd>
                </dl>
              </div>
            </div>
          </div>


          <div class="am-form-group">
            <label  class="am-u-sm-3 am-form-label">菜品价格 / Price</label>
            <div class="am-u-sm-9">
               <input type="text" value="" name="price">
              <small>价格你懂得...</small>
            </div>


          <div class="am-form-group">
            <label  class="am-u-sm-3 am-form-label">种类 / Type</label>
            <div class="am-u-sm-9">
              <p>
              <select name="type" class="utype">
                <option value="-1">所有类别</option>
                <option value="凉菜" >凉菜</option>
                <option value="热菜" >热菜</option>
                <option value="汤羹煲炖类" >汤羹煲炖类</option>
                <option value="甜品" >甜品</option>
                <option value="饮品果汁类" >饮品果汁类</option>
              </select>
              </p>
            </div>
          </div>

          <div class="am-form-group">
            <label  class="am-u-sm-3 am-form-label">招牌菜</label>
            <div class="am-u-sm-9">

              <p><input type="checkbox" name="checked" >是否设置为招牌菜？</p>

            </div>
          </div>


          <div class="am-form-group">
            <label class="am-u-sm-3 am-form-label">菜品简介 / Intro</label>
            <div class="am-u-sm-9">
              <textarea id="description" name="description" ></textarea>
              <small>250字以内...</small>
            </div>
          </div>

          <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" class="am-btn am-btn-primary">添加新菜</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- content end -->

</div>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license. <a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
</footer>

<!--[if lt IE 9]>
<script src="/hhw/Public/js/jquery1.11.1.min.js"></script>
<script src="/hhw/Public/js/modernizr.js"></script>
<script src="/hhw/Public/js/polyfill/rem.min.js"></script>
<script src="/hhw/Public/js/polyfill/respond.min.js"></script>
<script src="/hhw/Public/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/hhw/Public/js/jquery.min.js"></script>
<script src="/hhw/Public/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="/hhw/Public/js/app.js"></script>
</body>
</html>