<?php
namespace frontend\controllers;
use yii\web\Session;
use Yii;
use yii\web\Controller;

class LoginController extends Controller{

    /* 去除Yii框架格式 */
    public $layout=false;
    public $enableCsrfValidation=false;

    /* 登录 */
    public function actionIndex(){
        return $this->render('login.html');
    }

    /* 注册 */
    public function actionRegister(){
        return $this->render('register.html');
    }
    /*登陆成功*/
    public function actionShow(){
        $request = Yii::$app->request;
        $email = $request->post('email');
        $password = $request->post('password');
        $str=$email.$password;
        $farr = array(
            "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
            "/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
        );
        $str = preg_replace($farr,'',$str);
        if($str){
            $connection=Yii::$app->db;
            $command = $connection->createCommand("select * from zpb_members where m_email='$email' or m_phone='$email' and m_pwd='".md5($password)."'");
            $posts = $command->queryAll();
            if($posts){
                $session = Yii::$app->session;
                //方法1：
                $session['email']=$posts[0]['m_email'];
                $session['name']=$posts[0]['m_user'];
				$session['m_id']=$posts[0]['m_id'];
                if($posts[0]['m_type']==1){
					$session['stuat']=1;
                    echo "1";
                }else{
					$session['stuat']=2;
                    echo "2";
                }
            }else{
                echo "账号密码错误";
            }

        }else{
            echo "登陆失败";
        }


    }
    //添加用户  注册
    public function actionAdd(){
        $connection = \Yii::$app->db;
        $request = Yii::$app->request;
        $email= $request->post('email');
        $pwd=$request->post('password');
        $type=$request->post('type');
		 $command = $connection->createCommand("select m_id from zpb_members where m_email='$email'");
            $po = $command->queryAll();
			if($po){
				echo "用户已存在";die;
			}
        $re=$connection->createCommand()->insert('zpb_members', [
            'm_email' => $email,
            'm_pwd' => md5($pwd),
            'm_type' => $type,
        ])->execute();
        if($re){
            $session = Yii::$app->session;
            //方法1：
            $session['email']=$email;
            if($type==2){
				 $command = $connection->createCommand("select m_id from zpb_members where m_email='$email'");
            $pos = $command->queryAll();
				 $session['stuat']=2;
				 $session['m_id']=$pos[0]['m_id'];
                echo '2';
            }else if($type==1){
				 $command = $connection->createCommand("select m_id from zpb_members where m_email='$email'");
            $pos = $command->queryAll();
				$session['stuat']=1;
				 $session['m_id']=$pos[0]['m_id'];
                $connection->createCommand()->insert('zpb_preson', [
                    'm_id' => $pos[0]['m_id'],

                ])->execute();
                $connection->createCommand()->insert('zpb_resume', [
                    'm_id' => $pos[0]['m_id'],
                ])->execute();
                echo '1';
            }else{
                echo "注册失败";
            }
        }else{
            echo "注册失败";
        }


    }

    /**
     * 过滤参数
     * @param string $str 接受的参数
     * @return string
     */
    static public function filterWords($str)
    {
        $farr = array(
            "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
            "/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
        );
        $str = preg_replace($farr,'',$str);
        //return $str;
        if(is_array($arr)){
            foreach($arr as $k => $v){
                $arr[$k] = self::filterWords($v);
            }
        }else{
            $arr = self::filterWords($v);
        }
        //return $arr;
    }

    /**
     * 过滤接受的参数或者数组,如$_GET,$_POST
     * @param array|string $arr 接受的参数或者数组
     * @return array|string
     */
    static public function filterArr($arr)
    {
        if(is_array($arr)){
            foreach($arr as $k => $v){
                $arr[$k] = self::filterWords($v);
            }
        }else{
            $arr = self::filterWords($v);
        }
        return $arr;
    }

	public function actionStunt(){
		$session = Yii::$app->session;
		unset($session['stuat']);
		unset($session['email']);
		unset($session['name']);
		unset($session['m_id']);
		return $this->render('login.html');
	}


}