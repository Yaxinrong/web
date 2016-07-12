<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();

    }
    public function check()
    {
        $name = $_POST['username'];
        $password = $_POST['password'];
        if ($name == "") {
            echo "请填写用户名<br>";
            echo "<script type='text/javascript'>alert('请填写用户名');
        </script>";


        } elseif ($password == "") {
            echo "<script type='text/javascript'>alert('请填写密码');</script>";

        } else {
            $colum = M("Restaurant");
            $condition['account'] = $name;
            $condition['password'] = $password;
            $result = $colum->where($condition)->select();

            if ( $result) {

                session_start();
                $_SESSION['username']=$_POST['username'];
                $this->success("登陆成功！", U("Index/admin_user"));

            } else
                $this->success("密码错误！", U("Index/index"));

        }

    }
    public function register()
    {
        $account_register=$_POST['account_register'];
        $password_register=$_POST['password_register'];
        $pwd_again_register=$_POST['pwd_again_register'];
        $phone_num=$_POST['phone_num'];
        $rest_name=$_POST['rest_name'];
        $description=$_POST['description'];
        $province=$_POST['province'];
        $city=$_POST['city'];
        $zone=$_POST['zone'];
        $addr=$_POST['addr'];

        if($account_register==""|| $password_register=="" || $addr=="" || $city=="" || $description=="" || $phone_num=="" || $province=="" || $rest_name=="" || $zone=="" )
        {
            $this->error('用户名、密码、电话、店铺名、店铺描述、省、市、区、详细地址都不能为空','Index/index#toregister');
        }
        else {
            if ($password_register != $pwd_again_register) {
                $this->error('两次输入的密码不一致,请重新输入！','Index/index#toregister');
            }
            else {
                $User = M("Restaurant"); // 实例化User对象
                $data['account'] = $account_register;
                $data['password'] = $password_register;
                $data['phoneNum'] = $phone_num;
                $data['rest_name'] = $rest_name;
                $data['province'] = $province;
                $data['city'] = $city;
                $data['zone'] = $zone;
                $data['addr'] = $addr;
                $data['description'] = $description;

                if (($this->checkStatus($account_register))) {
                    $this->error('用户名已存在！','Index/index#toregister');
                } else {

                    $result = $User->add($data);
                    if (!$result) {
                        $this->error('注册不成功！','Index/index#toregister');
                    } else {
                        session_start();
                        $_SESSION['account']=$account_register;
                        $_SESSION['password']=$password_register;

                     //   $this->success('注册成功!', 'modify_rest');
                        $this->success("注册成功！", U("Index/admin_user"));
                    }

                }
            }
        }
    }
    public function checkStatus($name){
        $User = M("Restaurant");
        $map=array();
        $map['account']=$name;
        $map['rest_no']=array('gt',0);
        return $authInfo=$User->where($map)->find();
    }

    public function admin_user()
{
    $account=$_SESSION['username'];
    $column=M('Restaurant');
    $condition['account']=$account;
    $information=$column->where($condition)->select();
    $info=$information[0];
    //   $phone=$result_information[phoneNum];
    $this->assign('phoneNum',$info['phonenum']);
    //  $this->assign('password',$info['password']);
    $this->assign('rest_name',$info['rest_name']);
    $this->assign('description',$info['description']);
    $this->assign('province',$info['province']);
    $this->assign('city',$info['city']);
    $this->assign('zone',$info['zone']);
    $this->assign('addr',$info['addr']);


    $this->display();
}
    public function admin_dish()
    {
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();
        $this->display();
    }
    public function admin_table()
    {
        $name = $_SESSION['username'];
        $colum = M("Restaurant");
        $condition['account'] =$name ;
        $restno = $colum->where($condition)->field('rest_no')->select();
        $dish = M("Restdish");
        $info=$restno[0];
      $conditionDish['rest_no'] =$info['rest_no'];
        $resultDish = $dish->where($conditionDish)->select();
        $dishname = $dish->where($conditionDish)->field('dish_name')->select();
        $i=$dishname[0];
        $_SESSION['dishname']=$i['dish_name'];
        $sum = count($resultDish);//获得当前总数
        $p =new \Think\Page($sum, 10);
        $page = $p->show();
        $list = $dish->where($conditionDish)->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page', $page);
        $this->assign('sum',$sum);
$this->display();
}
    public function admin_table_search()
    {

        $dish = $_SESSION['dishname'];
        if ($dish == "") {
            echo "<script> alert('请输入你要查询的菜品名');parent.location.href='http://localhost/tp/index.php/Home/Index/admin_table.html'; </script>";

        } else {
            $colum = M("Restdish");
            $result = $colum->query("select * from restdish where dish_name like '%$dish%' ");
            $this->assign('list',$result);
            $this->display();
        }
    }
    public function search()
    {
        $dish = $_POST['dishname'];
        $_SESSION['dishname']=$dish;
        $this->success("搜索成功！", U("Index/admin_table_search"));
    }
    public function modify(){
        $account=$_SESSION['username'];
        $password=$_SESSION['password'];
        $phone_num=$_POST['phoneNum'];
        $rest_name=$_POST['rest_name'];
        $description=$_POST['description'];
        $province=$_POST['province'];
        $city=$_POST['city'];
        $zone=$_POST['zone'];
        $addr=$_POST['addr'];
        if($addr==""|| $city=="" || $description=="" || $phone_num=="" || $province=="" || $rest_name=="" || $zone==""  )
        {
            $this->error('电话、店铺名、店铺描述、省、市、区、详细地址都不能为空','admin_user');
        }
        else {

            $User = M("Restaurant"); // 实例化User对象
            $data['account'] = $account;
           $data['password'] = $password;
            $data['phoneNum'] = $phone_num;
            $data['rest_name'] = $rest_name;
            $data['province'] = $province;
            $data['city'] = $city;
            $data['zone'] = $zone;
            $data['addr'] = $addr;
            $data['description'] = $description;
            $condition['account']=$account;
            $result = $User->where($condition)->save($data);
            if (!$result) {
                $this->error('修改不成功！','admin_user');
            } else {
                $this->success("修改成功！", U("Index/admin_user"));
            }
        }
    }
    public function upload()
    {
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();
        $info=$rest_no[0];
        $dish_name = $_POST['dish_name'];
        $finish_pic = $_POST['file'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $checked = $_POST['checked'];
        $description = $_POST['description'];
        if ($dish_name == "" || $price == "" || $type == "" || $description == "") {
            $this->error('菜名、价格、类型、描述都不能为空！','admin_dish');
        }
        else {
            $User = M("restdish"); // 实例化User对象

                        $data['rest_no']=$info['rest_no'];
            $data['description'] = $description;
            $data['dish_name'] = $dish_name;
            $data['price'] = $price;
            $data['type'] = $type;
            $data['signature'] = $checked;
            $data['finish_pic']=$finish_pic;
            if($checked)
            {
                                $data['signature'] = 'true';
            }
            else {

                               $data['signature'] ='false';
            }

            //上传文件
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize=10145728;//大小
            $upload->saveName=$_POST['file'];
            $upload->exts=array('jpg','png','gif','jpeg');//类型
            $upload->rootPath  ='./Public/Dish_img/'; // 设置附件上传根目录
            $upload->savePath  =''; // 设置附件上传（子）目录
            $fileName=$_POST['file'];
          //  $fileExtensions=strrchr($fileName, '.');
           // $fileName = trim($fileName,$fileExtensions);
          //  $upload->saveName= $fileName;
            $data['finish_pic']='http://localhost/tp/PUBLIC/Dish_img/right/'.$fileName;
           /* dump($data);
            $info   =   $upload->upload();


            //生成缩略图
            $image = new \Think\Image();
            $image->open($data['finish_pic']);
            $savename =$data['finish_pic'];
            if($image->width() > 80){
                $image->thumb(80, 60,\Think\Image::IMAGE_THUMB_CENTER)->save($savename);
            }else{
                $image->save($savename);
            }*/
            $result = $User->add($data);
                if (!$result) {
                    $this->error('上传失败', 'admin_dish');
                } else {
                    $this->success('上传成功!', 'admin_table');
                    session_start();
                }
            }

        }




    public function admin_modify_dish(){
        $dish_name=$_SESSION['dishname'];
        $column=M('restdish');
        $condition['dish_name']=$dish_name;
        $information=$column->where($condition)->find();
        $this->assign('dish_name',$information['dish_name']);
        $this->assign('price',$information['price']);
        $this->assign('type',$information['type']);
        $this->assign('signature',$information['signature']);
        $this->assign('description',$information['description']);
        $this->display();
    }



    public function modifyDish(){
       // $dish_name=$_SESSION['dish_name'];
       $dish_name= $_SESSION['dishname'];
        //$rest_no=$_SESSION['rest_no'];
        $modify_name=$_POST['dish_name'];
        $price=$_POST['price'];
        $type=$_POST['type'];
        $checked=$_POST['signature'];
        $description=$_POST['description'];


        if($description=="" || $price=="" || $type=="")
        {
            $this->error('价格，类型，和描述都不能为空','admin_modify_dish');
        }
        else {

            $User = M("restdish"); // 实例化User对象
            $condition['dish_name']=$dish_name;
            $rest_no=$User->where($condition)->field('rest_no')->find();
            $finish_pic=$User->where($condition)->field('finish_pic')->find();
            $data['rest_no'] = $rest_no;
            $data['description'] = $description;
            $data['dish_name'] = $modify_name;
            $data['price'] = $price;
            $data['type'] = $type;
            if($checked)
            {
                $data['signature'] = 'true';
            }
            else {
                $data['signature'] ='false';
            }
            $data['finish_pic'] = $finish_pic;

            $result = $User->where($condition)->save($data);
            if (!$result) {
                $this->error('修改不成功！','admin_modify_dish');
            } else {
                $this->success('修改成功!', 'admin_table');

            }

        }
    }
    public function admin_changePassword(){
        $this->display();
    }
    public function modifyPassword(){
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $password=$column->where($condition)->field('password')->select();
        $info=$password[0];
        $p=$info['password'];
        $oldPassword = $_POST['oldpassword'];
        $newPassword = $_POST['newpassword'];
        $confirmPassword = $_POST['confirm'];
        if( $oldPassword!=$p){
            $this->error('原先密码不正确！','admin_changePassword');
        }else if( $newPassword !=$confirmPassword){
            $this->error('确认密码与设置密码不一致！','admin_changePassword');
        }else{
            $result = $column->execute("update restaurant set password='$newPassword' where account='$rest_name'");
            if( $result){
                $this->success('密码修改成功！','admin_user');

            }else{
                $this->error('密码修改不成功！','admin_user');

            }
        }

    }
    public function admin_log(){
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();
        $info=$rest_no[0];
        $conditionDish['rest_no'] =$info['rest_no'];
        $comment=M('Comment');
        $resultDish = $comment->where($conditionDish)->select();
        $this->assign('list',$resultDish);
        $this->display();
    }




}