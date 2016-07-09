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
//                echo "两次输入的密码不一致,请重新输入！";
//                echo "<a href='Index.html'>重新输入</a>"
            }
            //else if($code!=$_SESSION['check'])
            //{
            //     echo"验证码错误！";
            //  }
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

                        $this->success('注册成功!', 'modify_rest');
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
        $rest_no=$column->where($condition)->field('rest_no')->select();
        dump($rest_no);
        $this->display();

    }
    
    public function upload()
    {
       // session_start();
        $rest_name=$_SESSION['account'];
        $column=M('Restaurant');
        $condition['account']=$rest_name;
        $rest_no=$column->where($condition)->field('rest_no')->select();

        $dish_name = $_POST['dish_name'];
        $finish_pic = $_POST['file_upload'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $checked = $_POST['checked'];
        $description = $_POST['description'];
        import('ORG.Net.UploadFile');
       //// $pic = new UploadFile();// 实例化上传类
       // $pic->maxSize  = 3145728 ;// 设置附件上传大小
      //  $pic->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      //  $pic->savePath =  './Public/Uploads/';// 设置附件上传目录
       // if(!$pic->upload()) {// 上传错误提示错误信息
       //     $this->error($pic->getErrorMsg());
       // }else{// 上传成功 获取上传文件信息
       //     $info =  $pic->getUploadFileInfo();
      //  }
// 保存表单数据 包括附件数据
        if ($dish_name == "" || $price == "" || $type == "" || $description == "") {
            $this->error('菜名、价格、类型、描述都不能为空！','uploaddish');
        }
        else {

            $User = M("restdish"); // 实例化User对象
            $data['rest_no']=$rest_no;

            $data['description'] = $description;
            $data['dish_name'] = $dish_name;
            $data['price'] = $price;
            $data['type'] = $type;
            $data['finish_pic']=$finish_pic;
            if($checked)
            {
                $data['signature'] = 1;
            }
            else {
                $data['signature'] = 0;
            }
            if (($this->checkStatus($dish_name))) {
                $this->error('该菜名已存在','uploaddish');
            } else {
               // $picres= $User->add(); // 写入用户数据到数据库
                $result = $User->add($data);
                if (!$result) {
                    $this->error('上传失败','uploaddish');
                }
                else {
                    $this->success('上传成功!', 'home');
                }

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

  /*  public function uploadify()
    {
        if (isset($_FILES['ori_img'])){
            $upload = new \Think\UploadFile();// 实例化上传类
            $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');
            //$upload->savePath = './Public/Uploads/' . $path; // 设置附件上传目录
            $upload->savePath = '__PUBLIC__/image' . 'thumb/'; // 设置附件上传目录
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->saveRule = 'time';
            $upload->uploadReplace = true; //是否存在同名文件是否覆盖
            $upload->thumb = true; //是否对上传文件进行缩略图处理
            $upload->thumbMaxWidth = '100,300'; //缩略图处理宽度
            $upload->thumbMaxHeight = '50,150'; //缩略图处理高度
            //$upload->thumbPrefix = $prefix; //缩略图前缀
            $upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
            //$upload->thumbPath = './Public/Uploads/' . $path . date('Ymd', time()) . '/'; //缩略图保存路径
            $upload->thumbPath = '__PUBLIC__/image' . 'thumb/' . date('Ymd', time()) . '/'; //缩略图保存路径

            //$upload->thumbRemoveOrigin = true; //上传图片后删除原图片
            $upload->thumbRemoveOrigin = false; //上传图片后删除原图片
            $upload->autoSub = true; //是否使用子目录保存图片
            $upload->subType = 'date'; //子目录保存规则
            $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式

            if (!$upload->upload()) {// 上传错误提示错误信息
                echo json_encode(array('msg' => $this->error($upload->getErrorMsg()), 'status' => 0));
            } else {// 上传成功 获取上传文件信息
                $info = $upload->getUploadFileInfo();
                $picname = $info[0]['savename'];

                $picname = explode('/', $picname);
                //$picname = $picname[0] . '/' . $prefix . $picname[1];
                $picname = $picname[0] . '/' . '_hz' . $picname[1];
                print_r($picname);
                echo json_encode(array('status' => 1, 'msg' => $picname));
            }
        }
    }
*/
    public function modify_rest(){
        $account=$_SESSION['account'];
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
    public function home(){
        $this->display();

    }
    public function modify(){
        $account=$_SESSION['account'];

        $password=$_POST['password'];
        //$password_again=$_POST['password_again'];
        $phone_num=$_POST['phoneNum'];
        $rest_name=$_POST['rest_name'];
        $description=$_POST['description'];
        $province=$_POST['province'];
        $city=$_POST['city'];
        $zone=$_POST['zone'];
        $addr=$_POST['addr'];

        if($password=="" || $addr==""|| $city=="" || $description=="" || $phone_num=="" || $province=="" || $rest_name=="" || $zone==""  )
        {
            $this->error('密码、电话、店铺名、店铺描述、省、市、区、详细地址都不能为空','modify_rest');
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
                    $result = $User->where(account=='$account')->save($data);
                    if (!$result) {
                        $this->error('修改不成功！','modify_rest');
                    } else {
                        $this->success('修改成功!', 'home');
                    }

        }
    }
}