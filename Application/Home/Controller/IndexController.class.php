<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
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

                        $this->success('注册成功!', 'uploaddish');
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
    public function uploaddish()
    {
        $rest_name=$_SESSION['account'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $this->display();

    }
    
    public function upload()
    {
       // session_start();
        $rest_name=$_SESSION['account'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();
        $info=$rest_no[0];
        $dish_name = $_POST['dish_name'];
        $finish_pic = $_POST['file_upload'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $checked = $_POST['checked'];
        $description = $_POST['description'];
        if ($dish_name == "" || $price == "" || $type == "" || $description == "") {
            $this->error('菜名、价格、类型、描述都不能为空！','uploaddish');
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
               // $picres= $User->add(); // 写入用户数据到数据库
                $result = $User->add($data);
                if (!$result) {
                    $this->error('上传失败','uploaddish');
                }
                else {
                    $this->success('上传成功!', 'modify_dish');
                    session_start();
                    $_SESSION['dish_name']=$dish_name;
                    $_SESSION['rest_no']=$rest_no;
                    dump($info['rest_no']);
                }
        }
        }

    public function checkDish($dish_name){
        $User = M("restdish");
        $map=array();
        $map['dish_name']=$dish_name;
        $map['dish_no']=array('gt',0);
        return $authInfo=$User->where($map)->find();
    }

  
    public function modify_rest(){
        $account=$_SESSION['account'];
        $column=M('Restaurant');
        $condition['account']=$account;
        $information=$column->where($condition)->find();
        $info=$information[0];

        $this->assign('phoneNum',$info['phonenum']);

        $this->assign('rest_name',$info['rest_name']);
        $this->assign('description',$info['description']);
        $this->assign('province',$info['province']);
        $this->assign('city',$info['city']);
        $this->assign('zone',$info['zone']);
        $this->assign('addr',$info['addr']);
        $this->display();
    }
    public function home(){
        $this->display();

    }
    public function modifyReat(){
        $account=$_SESSION['account'];
        $password=$_SESSION['password'];
        //$password=$_POST['password'];
        //$password_again=$_POST['password_again'];
        $phone_num=$_POST['phoneNum'];
        $rest_name=$_POST['rest_name'];
        $description=$_POST['description'];
        $province=$_POST['province'];
        $city=$_POST['city'];
        $zone=$_POST['zone'];
        $addr=$_POST['addr'];

        if($addr==""|| $city=="" || $description=="" || $phone_num=="" || $province=="" || $rest_name=="" || $zone==""  )
        {
            $this->error('电话、店铺名、店铺描述、省、市、区、详细地址都不能为空','modify_rest');
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
                        $this->error('修改不成功！','modify_rest');
                    } else {
                        $this->success('修改成功!', 'home');
                       
                    }

        }
    }


    public function modify_dish(){
        $dish_name=$_SESSION['dish_name'];
        $column=M('restdish');
        $condition['dish_name']=$dish_name;
        $information=$column->where($condition)->find();
       // dump($information);
        $this->assign('dish_name',$information['dish_name']);
        $this->assign('price',$information['price']);
        $this->assign('type',$information['type']);
        $this->assign('signature',$information['signature']);
        $this->assign('description',$information['description']);
        $this->display();
    }



    public function modifyDish(){
        $dish_name=$_SESSION['dish_name'];
        //$rest_no=$_SESSION['rest_no'];
        $modify_name=$_POST['dish_name'];
        $price=$_POST['price'];
        $type=$_POST['type'];
        $checked=$_POST['signature'];
        $description=$_POST['description'];


        if($description=="" || $price=="" || $type=="")
        {
            $this->error('价格，类型，和描述都不能为空','modify_dish');
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
                $this->error('修改不成功！','modify_dish');
            } else {
                $this->success('修改成功!', 'home');

            }

        }
    }





}