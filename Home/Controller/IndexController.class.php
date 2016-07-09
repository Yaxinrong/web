<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();

    }
    public function check()
    {
//        dump($_GET['username']);
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
            $result = $colum->where($condition)->select();

//            dump($result);

            if ( $result) {

                session_start();
                $_SESSION['username']=$_POST['username'];
               // echo $_SESSION['username'];
                //echo "验证成功！<br>";
                //echo"<script type='text/javascript'>alert('登陆成功');</script>";
                $this->success("登陆成功！", U("Index/admin_user"));

            } else

                //echo "密码错误<br>";
                //echo "<script type='text/javascript'>alert('密码错误');</script>";
                $this->success("密码错误！", U("Index/index"));

            //echo "<a href='login.php'>返回</a>";

        }

    }

    public function admin_user()
    {
        $this->display();
    }
    public function admin_table()
    {

        $name = $_SESSION['username'];
        $colum = M("Restaurant");
        $condition['account'] =$name ;
        $restno = $colum->where($condition)->field('rest_no')->select();
        $dish = M("Restdish");
        $conditionDish['rest_no'] =(int) $restno;
        $resultDish = $dish->where($conditionDish)->select();
        dump($resultDish);
        $sum = count($resultDish);//获得当前总数
    
        $p =new \Think\Page($sum, 10);
        $page = $p->show();
        $list = $dish->where($conditionDish)->limit($p->firstRow.','.$p->listRows)->select();
     
        $this->assign('list',$list);
        $this->assign('page', $page);
        $this->assign('sum',$sum);

$this->display();
      
}
    public function search()
    {
        $dish = $_POST['dishname'];

        if ($dish == "") {
            echo "<script> alert('请输入你要查询的菜品名');parent.location.href='http://localhost/tp/index.php/Home/Index/admin_table.html'; </script>";

        } else {
            $colum = M("Restdish");
            $result = $colum->query("select * from restdish where dish_name like '$dish%' ");
            dump($result);
            $this->ajaxReturn(json_encode($result));

        }

    }

}