<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
header("content-type:text/html;charset=utf-8");
class FirmController extends Controller{

	/* 去除Yii框架格式 */
    public $layout=false;

    /* 公司列表 */
	public function actionIndex(){
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM zpb_field');
        $posts = $command->queryAll();
        $res = $connection->createCommand("select * from zpb_firm
join zpb_field on zpb_firm.field_id = zpb_field.field_id
join zpb_members on zpb_firm.m_id = zpb_members.m_id
")->queryAll();
//        print_r($res);die;
        return $this->render('index.html',['posts'=>$posts,'res'=>$res]);
	}
	//完善公司 信息  
	public function actionBindstep1(){

		return $this->render('bindstep1.html');
	}
	public function actionBindstep2(){

		return $this->render('bindstep2.html');
	}
	public function actionBindstep3(){

		return $this->render('bindstep3.html');
	}
	public function actionAct(){
		$request = Yii::$app->request;
		$tel = $request->post('tel');
		$email=$request->post('email');
		$session = Yii::$app->session;
		$name=$session['email'];
		$connection = \Yii::$app->db;
		$re=$connection->createCommand()->update('zpb_members', ['m_email' => "$email",'m_phone'=>"$tel"], "m_email='$name'")->execute();
		if($re){
            $this->redirect(array('firm/bindstep2','stuat'=>2));
		}else{
			$this->redirect(array('firm/bindstep1','stuat'=>2));
		}
	}
	
	public function actionAct2()
	{
		$request = Yii::$app->request;
		$firm_name = $request->post('companyName');
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db = Yii::$app->db;
		$res = $db->createCommand()->insert('zpb_firm',['m_id'=>$m_id,'firm_name'=>$firm_name])->execute();
		if($res)
		{
			$this->redirect(array('firm/bindstep3','stuat'=>2));
		}
		else
		{
			$this->redirect(array('firm/bindstep2','stuat'=>2));
		}
	}
}
