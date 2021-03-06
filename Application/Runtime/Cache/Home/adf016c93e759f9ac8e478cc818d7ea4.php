<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nourriture 御膳房 我的菜单</title>
  <meta name="description" content="这是一个 table 页面">
  <meta name="keywords" content="table">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/hhw/Public/images/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/hhw/Public/images/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="/hhw/Public/css/amazeui.min.css"/>
  <link rel="stylesheet" href="/hhw/Public/css/admin.css">
  <!--[if lt IE 9]>
  <script src="/hhw/Public/js/jquery1.11.1.min.js"></script>
  <script src="/hhw/Public/js/modernizr.js"></script>
  <script src="/hhw/Public/js/polyfill/rem.min.js"></script>
  <script src="/hhw/Public/js/polyfill/respond.min.js"></script>
  <script src="/hhw/Public/js/amazeui.legacy.js"></script>
  <script type="text/javascript">
  <![endif]-->

  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="/hhw/Public/js/jquery.min.js"></script>
  <script src="/hhw/Public/js/amazeui.min.js"></script>
  <!--<![endif]-->
  <script src="/hhw/Public/js/app.js"></script>
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
          <span class="am-icon-users"></span> 欢迎，<?php echo ($_SESSION['username']); ?> <span class="am-icon-caret-down"></span>
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
          <li><a href="admin_user.html" class="am-cf"><span class="am-icon-check"></span> 个人资料<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
          <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 帮助页</a></li>
          <li><a href="admin-gallery.html"><span class="am-icon-th"></span> 相册页面<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
          <li><a href="admin-log.html"><span class="am-icon-calendar"></span> 系统日志</a></li>
          <li><a href="admin_dish.html"><span class="am-icon-bug"></span> 新增菜品</a></li>
        </ul>
      </li>
      <li><a href="admin_table.html"><span class="am-icon-table"></span> 我的菜单</a></li>
      <li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 表单</a></li>
      <li><a href="#"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-bookmark"></span> 公告</p>
        <p>时光静好，与君语；细水流年，与君同。—— Amaze</p>
      </div>
    </div>

    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-tag"></span> wiki</p>
        <p>Welcome to the Amaze</p>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的菜单</strong>  </div>
    </div>

    <div class="am-g">
      <div class="am-u-md-6 am-cf">
        <div class="am-fl am-cf">
          <div class="am-btn-toolbar am-fl">
            <div class="am-btn-group am-btn-group-xs">
              <button type="button" class="am-btn am-btn-default" type="button" onclick="location.href='admin_dish.html'"/><span class="am-icon-plus"></span> 新增</button>

            </div>

            <div class="am-form-group am-margin-left am-fl">
              <select>
                <option value="option1">所有类别</option>
                <option value="option2">凉菜</option>
                <option value="option3">招牌菜</option>
                <option value="option3">热菜</option>
                <option value="option3">汤羹煲炖类</option>
                <option value="option3">甜品</option>
                <option value="option3">饮品果汁类</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm" >
            <form  action="/hhw/index.php/Home/Index/search" autocomplete="on" method="post" enctype=”multipart/form-data”>
            <input  id='dishname' name='dishname' type="text" class="am-form-field" value="">
            <span class="am-input-group-btn">
              <input   class="am-btn am-btn-default" type="submit"  id="search" value="搜索" >

           <script type="text/javascript">
  function chg()
  {
    alert($('#dishname').val());
    $.post("/hhw/index.php/Home/Index/admin_table_search?dishname="+$('#dishname').val(),
            {},function(data){alert(data);}
           );
    location.href='admin_table_search.html';
  }
  </script>
            </span>
</form>
          </div>
        </div>
      </div>
    </div>


    <div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-id">ID</th><th class="table-title">菜名</th><th class="table-type">描述</th><th class="table-author">价格（元）</th><th class="table-date">种类</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>


          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

              <td><?php echo ($vo['dish_no']); ?></td>
              <td><a href="admin_dish.html"><?php echo ($vo['dish_name']); ?></a></td>
              <td><?php echo ($vo['description']); ?></td>
              <td><?php echo ($vo['price']); ?></td>
              <td><?php echo ($vo['type']); ?>
              </td>
              <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary" type="button" onclick="location.href='admin_dish.html'"/><span class="am-icon-pencil-square-o"></span> 编辑</button>

                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"onclick="del()"/><span class="am-icon-trash-o"></span> 删除</button>
                    <script type="text/javascript">
                    function del()
                    {

                    }
                    </script>
                  </div>
                </div>
              </td><?php endforeach; endif; else: echo "" ;endif; ?>
            </tr>

          </tbody>
        </table>
          <div class="am-cf">
            <div class="sum">
              共 <?php echo ($sum); ?> 条记录
          </div>
  <div class="am-fr">
    <ul class="am-pagination">
      <li class="am-disabled"><a href="#">«</a></li>
      <li class="am-active"><a href="#">1</a></li>
      <li><a href="#">»</a></li>
    </ul>
  </div>
</div>
          <div><?php echo ($page); ?></div>


          <hr />
          <p>注：.....</p>
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


</body>
</html>