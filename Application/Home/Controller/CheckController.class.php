<?php
namespace Home\Controller;
use Think\Controller;
class CheckController extends Controller
{
    public function index()
    {
        $name = $_POST['username'];
        $password = $_POST['password'];
        if ($name == "") {

            echo "请填写用户名<br>";
            echo "<script type='text/javascript'>alert('请填写用户名');
        </script>";


        } elseif ($password == "") {

            //echo "请填写密码<br><a href='login.php'>返回</a>";
            echo "<script type='text/javascript'>alert('请填写密码');</script>";

        } else {
            $colum = M("Restaurant");
            $condition['account'] = $name;
            $condition['password'] = $password;
            $colum->where($condition)->select();

            if (($colum['account'] == $name) && ($colum['password'] == $password)) {

                //echo "验证成功！<br>";
                //echo"<script type='text/javascript'>alert('登陆成功');</script>";
                $this->success("login success", U("Index/admin_user"));

            } else

                //echo "密码错误<br>";
                echo "<script type='text/javascript'>alert('密码错误');</script>";

            //echo "<a href='login.php'>返回</a>";

        }

    }

}