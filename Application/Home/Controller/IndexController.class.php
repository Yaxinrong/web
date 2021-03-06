<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
// Author: Yaxinrong Huhuaiwen

class IndexController extends Controller {

    /*
     *生成验证码函数
     *
     * */
    public function verify_c(){
        // 设置验证码字符为纯数字
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 130;
        $Verify->imageH = 50;
        //$Verify->expire = 600;
        $Verify->entry();

    }
    /*
    *判断所输入的验证码是否正确
    *
    * */
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    /*
    *显示index.html函数
    *
    * */
    public function index(){
       // header("content-type:text/html;charset:utf-8;");
       // ob_clean();
        $this->display();
    }
    /*
    *登录验证函数
    *
    * */
    public function checked()
    {
        $v = new \Think\Verify();


        $name = $_POST['username'];
        $password = $_POST['password'];
        $c=$_POST['check'];
        $verify = I('param.verify',$c);
        $b= $v->check($verify);
        if ($name == "") {
            echo "请填写用户名<br>";
            echo "<script type='text/javascript'>alert('请填写用户名');
        </script>";


        } else if ($password == "") {
            echo "<script type='text/javascript'>alert('请填写密码');</script>";


        }
        
       else if(!$b){
            $this->error("亲，验证码输错了哦！",$this->site_url,3);
        }

        else {
            $colum = M("Restaurant");
            $condition['account'] = $name;
            $condition['password'] = $password;
            $result = $colum->where($condition)->select();

            if ( $result) {

                session_start();
                $_SESSION['username']=$_POST['username'];
                $this->success("登录成功！", U("Index/admin_user"));

            } else
                $this->success("密码错误！", U("Index/account"));

        }

    }
    /*
    *显示admin_gallery.html函数
    *
    * */
    public function admin_gallery(){
        $name = $_SESSION['username'];
        $colum = M("Restaurant");
        $condition['account'] =$name ;
        $restno = $colum->where($condition)->field('rest_no')->select();
        $dish = M("Restdish");
        $info=$restno[0];
        $conditionDish['rest_no'] =$info['rest_no'];
        $resultDish = $dish->where($conditionDish)->select();
        $image = $dish->where($conditionDish)->select();
        $this->assign('list',$image);
        $sum = count($resultDish);//获得当前总数
        $this->assign('sum',$sum);
        $this->display();

    }
    /*
    *注册验证函数
    *
    * */
    public function register()
    {
        $account_register=$_POST['account_register'];
        $password_register=$_POST['password_register'];
        $pwd_again_register=$_POST['pwd_again_register'];
        $phone_num=$_POST['phone_num'];
        $rest_name=$_POST['rest_name'];
        $description=$_POST['description'];
        $province=$_POST['province'];
        $email=$_POST['email'];
        $city=$_POST['city'];
        $zone=$_POST['zone'];
        $addr=$_POST['addr'];
        if( $email =="" || $account_register==""|| $password_register=="" || $addr=="" || $city=="" || $description=="" || $phone_num=="" || $province=="" || $rest_name=="" || $zone=="" )
        {
            $this->error('用户名、密码、电话、店铺名、店铺描述、省、市、区、详细地址都不能为空','Index/account#toregister');
        }
        else {
            if ($password_register != $pwd_again_register) {
                $this->error('两次输入的密码不一致,请重新输入！','Index/account#toregister');
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
                $data['email'] = $email;
                
                if (($this->checkStatus($account_register))) {
                    $this->error('用户名已存在！','Index/account#toregister');
                } else {

                    $result = $User->add($data);
                    if (!$result) {
                        $this->error('注册不成功！','Index/account#toregister');
                    } else {
                        session_start();
                        $_SESSION['username']=$account_register;
                        $_SESSION['password']=$password_register;

                     //   $this->success('注册成功!', 'modify_rest');
                        $this->success("注册成功！", U("Index/admin_user"));
                    }

                }
            }
        }
    }
    /*
    *判断注册的account是否有重复函数
    *
    * */
    public function checkStatus($name){
        $User = M("Restaurant");
        $map=array();
        $map['account']=$name;
        $map['rest_no']=array('gt',0);
        return $authInfo=$User->where($map)->find();
    }
    /*
    *显示admin_user函数
    *
    * */
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
    $this->assign('email',$info['email']);
    $this->assign('portrait',$info['portrait']);
    $this->display();
}
    /*
    *显示admin_dish函数
    *
    * */
    public function admin_dish()
    {
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $information=$column->where($condition)->find();
        $this->assign('portrait',$information['portrait']);

        $this->display();
    }
    /*
    *显示admin_table函数
    *
    * */
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
        $sum = count($resultDish);//获得当前总数
        $p =new \Think\Page($sum, 10);
        $page = $p->show();
        $list = $dish->where($conditionDish)->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page', $page);
        $this->assign('sum',$sum);
        $this->display();
}
    /*
    *显示admin_table_search函数
    *
    * */
    public function admin_table_search()
    {

        $dish = $_SESSION['dishname'];
        if ($dish == "") {
<<<<<<< HEAD
            echo "<script> alert('请输入你要查询的菜品名');parent.location.href='http://43.241.236.209/www/think/index.php/Home/Index/admin_table.html'; </script>";
=======
            echo "<script> alert('请输入你要查询的菜品名');parent.location.href='http://43.241.236.209/www/tp/index.php/Home/Index/admin_table.html'; </script>";
>>>>>>> 9e91c63796417774f738941c4632c407b4529706

        } else {
            $colum = M("Restdish");
            $result = $colum->query("select * from restdish where dish_name like '%$dish%' ");
            $this->assign('list',$result);
            $this->display();
        }
    }
    /*
    *search函数
    *
    * */
    public function search()
    {
        $dish = $_POST['dishname'];
        $_SESSION['dishname']=$dish;
        $this->success("搜索成功！", U("Index/admin_table_search"));
    }
    /*
    *修改个人信息函数
    *
    * */
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
           // $data['portrait']='__PUBLIC__/Dish_img/'.$pic;
            $condition['account']=$account;
      //     $result=$User->where($condition)->field('account','password')->filter('strip_tags')->save($data);

            $result = $User->where($condition)->save($data);
            if (!$result) {
                $this->error('修改不成功！','admin_user');
            } else {
                $this->success("修改成功！", U("Index/admin_user"));
            }
        }
    }
    /*
    *上传菜单函数
    *
    * */
    public function upload()
    {
        $arr=rand();
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();
        $info=$rest_no[0];
        $dish_name = $_POST['dish_name'];
        $finish_pic = $_POST['file'];
        $price = $_POST['price'];
        $type = $_POST['type'];
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
            $data['finish_pic']=$finish_pic;
            //上传文件

//            header("content-type:text/html;charset=utf-8");
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;
            $upload->rootPath = './Uploads/';
            $upload->savePath = '';
            $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub  = true;
            $upload->saveRule = 'com_create_guid';
            $upload->saveName=$arr.'-'.$_FILES["file"]["name"];

           //$fileExtensions=strrchr($fileName, '.');
           // $fileName = trim($fileName,$fileExtensions);

            $info   =   $upload->upload();
            //生成缩略图
            $image = new \Think\Image();
            $realfilepath = './Uploads/'.$info['file']['savepath'].'/';
            $image->open($realfilepath.$info['file']['savename']);
           // $savename = $realfilepath.'crop_'.$info['file']['savename'];
<<<<<<< HEAD
            $data['finish_pic']='http://43.241.236.209/www/think/Uploads/'.$info['file']['savepath'].$info['file']['savename'];
=======
            $data['finish_pic']='http://43.241.236.209/www/tp/Uploads/'.$info['file']['savepath'].$fileName;
>>>>>>> 9e91c63796417774f738941c4632c407b4529706

            $result = $User->add($data);
                if (!$result) {
                    $this->error('上传失败', 'admin_dish');
                } else {
                    $this->success('上传成功!', 'admin_table');
                    session_start();
                }
            }

        }
    /*
    *显示菜单函数
    *
    * */
    public function admin_m_dish(){
        $in=$_GET['i'];
        $_SESSION['i']=$in;
        
    }
    public function delete_dish(){
        $in= $_SESSION['i']-1;
        $name = $_SESSION['username'];
        $colum = M("Restaurant");
        $condition['account'] =$name ;
        $restno = $colum->where($condition)->field('rest_no')->select();
        $dish = M("Restdish");
        $info=$restno[0];
        $conditionDish['rest_no'] =$info['rest_no'];
        $dishname = $dish->where($conditionDish)->field('dish_name')->select();
        $i=$dishname[$in];
        $p=$i['dish_name'];
        dump($p);
        $c = M("Restdish");
        $result = $c->execute("delete from restdish where dish_name='$p'");
        if( $result){
            $this->success('成功删除记录！！','admin_table');
        }else{
            $this->error('恭喜你，出错啦！','admin_table');

        }

    }
    public function admin_modify_dish(){

        $in= $_SESSION['i']-1;
        $name = $_SESSION['username'];
        $colum = M("Restaurant");
        $condition['account'] =$name ;
        $restno = $colum->where($condition)->field('rest_no')->select();
        $dish = M("Restdish");
        $info=$restno[0];
        $conditionDish['rest_no'] =$info['rest_no'];
        $resultDish = $dish->where($conditionDish)->select();
        $dishname = $dish->where($conditionDish)->field('dish_name')->select();
        $i=$dishname[$in];
        $_SESSION['dishname']=$i['dish_name'];
        $dish_name=$_SESSION['dishname'];
        $column=M('restdish');
        $condition1['dish_name']=$dish_name;
        $information1=$column->where($condition1)->find();
        $this->assign('dish_name',$information1['dish_name']);
        $this->assign('price',$information1['price']);
        $this->assign('type',$information1['type']);
        $this->assign('signature',$information1['signature']);
        $this->assign('description',$information1['description']);
        //dump($information1);
        $this->assign('file',$information1['finish_pic']);
        $rest_no=$information1['rest_no'];
        $user=M('Restaurant');
        $condition2['rest_no']=(int)$rest_no;
        $information2=$user->where($condition2)->find();
        $this->assign('portrait',$information2['portrait']);

        $this->display();
    }
    /*
    *修改菜单函数
    *
    * */
    public function modifyDish(){

        $arr=rand();
       $dish_name= $_SESSION['dishname'];

        $modify_name=$_POST['dish_name'];
        $price=$_POST['price'];
        $type=$_POST['type'];
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
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;
            $upload->rootPath = './Uploads/';
            $upload->savePath = '';
            $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
            $upload->autoSub  = true;
            //  $upload->subName  = array('date','Ymd');
            $upload->saveRule = 'com_create_guid';
            $upload->saveName=$arr.'-'.$_FILES["file"]["name"];


            $info   =   $upload->upload();
            if($info){
<<<<<<< HEAD
                $data['finish_pic']='http://43.241.236.209/www/think/Uploads/'.$info['file']['savepath'].$info['file']['savename'];
=======
                $data['finish_pic']='http://43.241.236.209/www/tp/Uploads/'.$info['file']['savepath'].$fileName;
>>>>>>> 9e91c63796417774f738941c4632c407b4529706
                $result = $User->where($condition)->save($data);
            }
            else{
                $result = $User->where($condition)->save($data);
            }
            if (!$result) {
                $this->error('修改不成功！','admin_modify_dish');
            } else {
                $this->success('修改成功!', 'admin_table');

            }

        }
    }
    /*
    *显示admin_changePassword函数
    *
    * */
    public function admin_changePassword(){
        $this->display();
    }
    /*
    *修改密码函数
    *
    * */
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
    /*
    *显示admin_log函数
    *
    * */
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
    /*
    *上传头像函数
    *
    * */
    public function portrait(){
        $arr=rand();
        $rest_name=$_SESSION['username'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;
        $upload->rootPath = './Upload/';
        $upload->savePath = '';
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub  = true;
        //  $upload->subName  = array('date','Ymd');
        $upload->saveRule = 'com_create_guid';
        $upload->saveName=$arr.'-'.$_FILES["file"]["name"];

        $info   =   $upload->upload();
        //生成缩略图
     //   $image = new \Think\Image();
     //   $fileName=$arr.'-'.$_FILES["file"]["name"];
     //   $realfilepath = './Upload/'.$info['file']['savepath'].'/';
      //  $image->open($realfilepath.$info['file']['savename']);
        //$savename = $realfilepath.'crop_'.$info['file']['savename'];
<<<<<<< HEAD
        $data['portrait']='http://43.241.236.209/www/think/Upload/'.$info['file']['savepath'].$info['file']['savename'];
=======
        $data['portrait']='http://43.241.236.209/www/tp/Upload/'.$info['file']['savepath'].$fileName;

>>>>>>> 9e91c63796417774f738941c4632c407b4529706
        $result=$column->where($condition)->field('portrait')->filter('strip_tags')->save($data);
       // $result = $column->execute("update restaurant set portrait= '$data['portrait']’ where account='$rest_name'");
        if( $result){
            $this->success('头像保存成功！','admin_user');

        }else{
            $this->error('头像保存不成功！','admin_user');

        }

    }

    public function account(){
        unset($_SESSION['username']);
        $this->display();
    }

}