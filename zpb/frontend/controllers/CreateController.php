<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\Role_type;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class CreateController extends Controller{

    /* 去除Yii框架格式 */
    public $layout=false;
	
	/* 防csrf攻击 */
	public $enableCsrfValidation = false;
	
    /* 发布职位 */
    public function actionIndex(){
        // $rows = (new \yii\db\Query())   
        // ->select(['*'])   
        // ->from('zpb_article_sort') 
        // ->limit(5)
        // ->all();
        $type = (new \yii\db\query())->select(['*'])->from('zpb_type')->where(['type_pid'=>0])->all();
        foreach($type as $key=>$v)
        {
            $type[$key]['child']=(new \yii\db\query())->select(['*'])->from('zpb_type')->where(['type_pid'=>$v['type_id']])->all();
            foreach($type[$key]['child'] as $k=>$val)
            {
                $type[$key]['child'][$k]['chilrden']=(new \yii\db\query())->select(['*'])->from('zpb_type')->where(['type_pid'=>$val['type_id']])->all();
            }
        }
        $study = (new \yii\db\query())->select(['*'])->from('zpb_study')->all();
        $suffer = (new \yii\db\query())->select(['*'])->from('zpb_suffer')->all();
        return $this->render('index.html',array('type'=>$type,'study'=>$study,'suffer'=>$suffer));
    }

	/* 职位添加入库 */
    public function actionInsert()
    {
        $connection = Yii::$app->db; 
        $session = Yii::$app->session;
        $m_id=$session['m_id'];
        $request=Yii::$app->request->post();
		$suffer = (new \yii\db\query())->select(['*'])->from('zpb_suffer')->where(['suf_name'=>$request['suf_name']])->one();
		$study = (new \yii\db\query())->select(['*'])->from('zpb_study')->where(['stu_name'=>$request['stu_name']])->one();
        $data['m_id']=$m_id;
        $data['rec_time']=time();
		$data['suf_id']= $suffer['suf_id'];
		$data['stu_id']= $study['stu_id'];
		$data['rec_title'] = $request['type_name'];
		$data['rec_branch'] = $request['rec_branch'];
		$data['rec_nature'] = $request['rec_nature'];
		$data['rec_moneymin'] = $request['rec_moneymin'].'K';
		$data['rec_moneymax'] = $request['rec_moneymax'].'K';
		$data['rec_city'] = $request['rec_city'];
		$data['rec_sport'] = $request['rec_sport'];
		$data['rec_desc'] = $request['rec_desc'];
		$data['rec_address'] = $request['rec_address'];
		$data['rec_email'] = $request['rec_email'];
        $command = $connection->createCommand()->insert('zpb_recruit',$data)->execute();
        if($command)
        {
            echo 1;
        }
    }

    public function actionPreview()
    {
        return $this->render('preview.html');
    }

    /* 发布职位左边公共 */
    public function actionLeft(){
        return $this->render('left.html');
    }

    /* 我的公司主页 */
    public function actionMyhome(){
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$row = (new \yii\db\query())->select(['*'])->from('zpb_firm')->where(['m_id'=>$m_id])->one();
		$rows = (new \yii\db\query())->select(['*'])->from('zpb_field')->where(['field_id'=>$row['field_id']])->one();
		$row['field_name'] = $rows['field_name'];
		$firm_xy = $row['firm_xy'];
		$firm_xy = explode(',',$firm_xy);
		$field = (new \yii\db\query())->select(['*'])->from('zpb_field')->all();
        return $this->render('myhome.html',['arr'=>$row,'field'=>$field,'firm_xy'=>$firm_xy]);
    }
	

	/* 公司详细信息修改 */
	public function actionDetails()
	{
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db =  Yii::$app->db;
		$request = Yii::$app->request->get('firm_name');
		$res = $db->createCommand()->update('zpb_firm',['firm_name'=>$request],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
	}
	/* 公司介绍修改 */
	public function actionDesc()
	{
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db = Yii::$app->db;
		$request = Yii::$app->request->get('firm_desc');
		$res = $db->createCommand()->update('zpb_firm',['firm_desc'=>$request],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
	}
	/* 公司地点 领域 规模 修改 */
	public function actionCity()
	{
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db = Yii::$app->db;
		$request = Yii::$app->request->get();
		$field = (new \yii\db\query())->select(['field_id'])->from('zpb_field')->where(['field_name'=>$request['fin']])->one();
		$res = $db->createCommand()->update('zpb_firm',['firm_address'=>$request['city'],'firm_sca'=>$request['sca'],'field_id'=>$field['field_id']],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	/* 公司融资阶段修改 */
	public function actionStage()
	{
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db = Yii::$app->db;
		$request = Yii::$app->request->get('stage');
		$res = $db->createCommand()->update('zpb_firm',['firm_stage'=>$request],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
	}
	
	/* 公司创始人 */
	public function actionFounder()
	{
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db = Yii::$app->db;
		$request = Yii::$app->request->get('founder');
		$res = $db->createCommand()->update('zpb_firm',['firm_founder'=>$request],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
	}
	
	/* 删除标签 */
	public function actionDel_firm_xy()
	{
		$session = Yii::$app->session;
		$m_id = $session['m_id'];
		$db = Yii::$app->db;
		$request = Yii::$app->request->get('a');
		$row = (new \yii\db\query())->select(['firm_xy'])->from('zpb_firm')->innerjoin('zpb_field','zpb_field.field_id=zpb_firm.field_id')->where(['m_id'=>$m_id])->one();
		$firm_xy = $row['firm_xy'];
		$firm_xy = explode(',',$firm_xy);
		$key = array_search($request,$firm_xy);
		if ($key !== false)
		{
			array_splice($firm_xy, $key , 1);
		}
		$xy = implode(',',$firm_xy);
		$res = $db->createCommand()->update('zpb_firm',['firm_xy'=>$xy],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
	}
	
	/* 标签添加 */
	public function actionLabel()
	{
		$session = Yii::$app->session;
		$db = Yii::$app->db;
		$m_id = $session['m_id'];
		$request = Yii::$app->request->get('b');
		$row = (new \yii\db\query())->select(['firm_xy'])->from('zpb_firm')->innerjoin('zpb_field','zpb_field.field_id=zpb_firm.field_id')->where(['m_id'=>$m_id])->one();
		$firm_xy = $row['firm_xy'];
		if(!$firm_xy=='')
		{
			$firm_xy = $firm_xy.','.$request;
		}
		else
		{
			$firm_xy = $firm_xy.','.$request;
			$firm_xy = substr($firm_xy,1);
		}
		$res = $db->createCommand()->update('zpb_firm',['firm_xy'=>$firm_xy],'m_id=:id',[':id'=>$m_id])->execute();
		if($res)
		{
			echo 1;
		}
	}
	
	/* logo无刷新上传 */
	public function actionLogo()
	{
		$session = Yii::$app->session;
		$db = Yii::$app->db;
		$m_id = $session['m_id'];
		if(!file_exists($_FILES['upload_file']['name'])) 
		{
			$path = 'frontend/assets/style/images/logo/';
			if(move_uploaded_file($_FILES['upload_file']['tmp_name'],$path.$_FILES['upload_file']['name']))
			{
				$res = $db->createCommand()->update('zpb_firm',['firm_logo'=>$path.$_FILES['upload_file']['name']],'m_id=:id',[':id'=>$m_id])->execute();
				if($res)
				{
					echo $path.$_FILES['upload_file']['name'];
				}
			}
		}
	}
	
    /* 申请认证*/
    public function actionAuth(){
        return $this->render('auth.html');
    }

    /* 待处理简历 */
    public function actionInterview(){
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
        $posts =(new \yii\db\query())->select(['*'])->from('zpb_record')->innerjoin('zpb_preson','zpb_preson.m_id=zpb_record.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_preson.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_preson.suf_id')->innerjoin('zpb_resume','zpb_resume.m_id=zpb_preson.m_id')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_record.rec_id')->innerjoin('zpb_members','zpb_members.m_id=zpb_record.m_id')->where('zpb_recruit.m_id='.$m_id.' and zpb_record.sta_id=0')->all();
		// print_r($posts);
        foreach($posts as $k=>$v)
		{
			$posts[$k]['res_hope'] = unserialize($v['res_hope']);
			$posts[$k]['res_works'] = unserialize($v['res_works']);
			$posts[$k]['res_works_undergo'] = unserialize($v['res_works_undergo']);
			$posts[$k]['res_study_undergo'] = unserialize($v['res_study_undergo']);
			$posts[$k]['res_project_experiences'] = unserialize($v['res_project_experiences']);
		}
		// print_r($posts);die;
        return $this->render('interview.html',['posts'=>$posts]);
     }

    /* 已通知面试简历 */
    public function actionHaverefuse(){
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
        $posts =(new \yii\db\query())->select(['*'])->from('zpb_record')->innerjoin('zpb_preson','zpb_preson.m_id=zpb_record.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_preson.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_preson.suf_id')->innerjoin('zpb_resume','zpb_resume.m_id=zpb_preson.m_id')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_record.rec_id')->innerjoin('zpb_members','zpb_members.m_id=zpb_record.m_id')->where('zpb_recruit.m_id='.$m_id.' and zpb_record.sta_id=1')->all();
		
        foreach($posts as $k=>$v)
		{
			$posts[$k]['res_hope'] = unserialize($v['res_hope']);
			$posts[$k]['res_works'] = unserialize($v['res_works']);
			$posts[$k]['res_works_undergo'] = unserialize($v['res_works_undergo']);
			$posts[$k]['res_study_undergo'] = unserialize($v['res_study_undergo']);
			$posts[$k]['res_project_experiences'] = unserialize($v['res_project_experiences']);
		}
        return $this->render('haverefuse.html',['posts'=>$posts]);
    }

    /* 不合适简历 */
    public function actionNorefuse(){
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
        $posts =(new \yii\db\query())->select(['*'])->from('zpb_record')->innerjoin('zpb_preson','zpb_preson.m_id=zpb_record.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_preson.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_preson.suf_id')->innerjoin('zpb_resume','zpb_resume.m_id=zpb_preson.m_id')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_record.rec_id')->innerjoin('zpb_members','zpb_members.m_id=zpb_record.m_id')->where('zpb_recruit.m_id='.$m_id.' and zpb_record.sta_id=2')->all();
        foreach($posts as $k=>$v)
		{
			$posts[$k]['res_hope'] = unserialize($v['res_hope']);
			$posts[$k]['rec_works'] = unserialize($v['rec_works']);
			$posts[$k]['res_works_undergo'] = unserialize($v['res_works_undergo']);
			$posts[$k]['res_study_undergo'] = unserialize($v['res_study_undergo']);
			$posts[$k]['res_project_experiences'] = unserialize($v['res_project_experiences']);
		}
        return $this->render('norefuse.html',['posts'=>$posts]);
    }

    /* 自动过滤简历 */
    public function actionAutofilter(){
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
        $posts =(new \yii\db\query())->select(['*'])->from('zpb_record')->innerjoin('zpb_preson','zpb_preson.m_id=zpb_record.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_preson.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_preson.suf_id')->innerjoin('zpb_resume','zpb_resume.m_id=zpb_preson.m_id')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_record.rec_id')->innerjoin('zpb_members','zpb_members.m_id=zpb_record.m_id')->where('zpb_recruit.m_id='.$m_id.' and zpb_record.sta_id=3')->all();
        foreach($posts as $k=>$v)
		{
			$posts[$k]['res_hope'] = unserialize($v['res_hope']);
			$posts[$k]['res_works'] = unserialize($v['res_works']);
			$posts[$k]['res_works_undergo'] = unserialize($v['res_works_undergo']);
			$posts[$k]['res_study_undergo'] = unserialize($v['res_study_undergo']);
			$posts[$k]['res_project_experiences'] = unserialize($v['res_project_experiences']);
		}
        return $this->render('autofilter.html',['posts'=>$posts]);
    }
	
	/* 我发布的职位 */
    public function actionPositions(){
		$connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
		$command = $connection->createCommand("SELECT * FROM zpb_recruit join zpb_study on zpb_study.stu_id=zpb_recruit.stu_id join zpb_suffer on zpb_suffer.suf_id=zpb_recruit.suf_id WHERE m_id=$m_id and sta_id=0");
		$posts = $command->queryAll();
		$count = count($posts);
		foreach($posts as $k=>$v)
		{
			$posts[$k]['num'] = count($connection->createCommand("SELECT * FROM zpb_record WHERE rec_id=".$v['rec_id'])->queryAll());
		}
        return $this->render('positions.html',['arr'=>$posts,'count'=>$count]);
    }
	
	/* 有效职位 */
	public function actionValid()
	{
		$connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
		$command = $connection->createCommand("SELECT * FROM zpb_recruit join zpb_study on zpb_study.stu_id=zpb_recruit.stu_id join zpb_suffer on zpb_suffer.suf_id=zpb_recruit.suf_id WHERE m_id=$m_id and sta_id=0");
		$posts = $command->queryAll();
		$count = count($posts);
		foreach($posts as $k=>$v)
		{
			$posts[$k]['num'] = count($connection->createCommand("SELECT * FROM zpb_record WHERE rec_id=".$v['rec_id'])->queryAll());
		}
        return $this->render('valid.html',['arr'=>$posts,'count'=>$count]);
	}
	
	/* 职位下线 */
	public function actionXiaxian()
	{
		$id = Yii::$app->request->post('id');
		$connection = \Yii::$app->db;
		$command = $connection->createCommand()->update('zpb_recruit',['sta_id'=>1],'rec_id='.$id)->execute();
		if($command)
		{
			echo 1;
		}
	}
	
	/* 职位上线 */
	public function actionShangxian()
	{
		$id = Yii::$app->request->post('id');
		$connection = \Yii::$app->db;
		$command = $connection->createCommand()->update('zpb_recruit',['sta_id'=>0],'rec_id='.$id)->execute();
		if($command)
		{
			echo 1;
		}
	}
	
	/* 职位删除 */
	public function actionCut()
	{
		$id = Yii::$app->request->post('id');
		$connection = \Yii::$app->db;
		$command = $connection->createCommand()->delete('zpb_recruit',['rec_id'=>$id])->execute();
		if($command)
		{
			echo 1;
		}
	}
	
    /*已下线职位*/
    public function actionNovalid(){
		$connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
		$command = $connection->createCommand("SELECT * FROM zpb_recruit join zpb_study on zpb_study.stu_id=zpb_recruit.stu_id join zpb_suffer on zpb_suffer.suf_id=zpb_recruit.suf_id WHERE m_id=$m_id and sta_id=1");
		$posts = $command->queryAll();
		$count = count($posts);
		foreach($posts as $k=>$v)
		{
			$posts[$k]['num'] = count($connection->createCommand("SELECT * FROM zpb_record WHERE rec_id=".$v['rec_id'])->queryAll());
		}
        return $this->render('novalid.html',['arr'=>$posts,'count'=>$count]);
    }
    
	/*通过面试*/
    public function actionUp(){
        $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
        $posts=\Yii::$app->request->post('id');
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("UPDATE zpb_record SET sta_id=1 WHERE record_id=$posts");
        $command->execute();
        $posts =(new \yii\db\query())->select(['*'])->from('zpb_record')->innerjoin('zpb_preson','zpb_preson.m_id=zpb_record.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_preson.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_preson.suf_id')->innerjoin('zpb_resume','zpb_resume.m_id=zpb_preson.m_id')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_record.rec_id')->innerjoin('zpb_members','zpb_members.m_id=zpb_record.m_id')->where('zpb_recruit.m_id='.$m_id.' and zpb_record.sta_id=1')->all();
        foreach($posts as $k=>$v)
		{
			$posts[$k]['res_hope'] = unserialize($v['res_hope']);
			$posts[$k]['rec_work'] = unserialize($v['rec_work']);
			$posts[$k]['res_works_undergo'] = unserialize($v['res_works_undergo']);
			$posts[$k]['res_study_undergo'] = unserialize($v['res_study_undergo']);
			$posts[$k]['res_project_experiences'] = unserialize($v['res_project_experiences']);
		}
        return $this->render('haverefuse.html',['posts'=>$posts]);
    }
	
	/* 不合适简历 */
    public function actionNo(){
        $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id = $session['m_id'];
        $posts=\Yii::$app->request->post('id');
        $command = $connection->createCommand("UPDATE zpb_record SET sta_id=2 WHERE record_id=$posts");
        $command->execute();
        $posts =(new \yii\db\query())->select(['*'])->from('zpb_record')->innerjoin('zpb_preson','zpb_preson.m_id=zpb_record.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_preson.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_preson.suf_id')->innerjoin('zpb_resume','zpb_resume.m_id=zpb_preson.m_id')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_record.rec_id')->innerjoin('zpb_members','zpb_members.m_id=zpb_record.m_id')->where('zpb_recruit.m_id='.$m_id.' and zpb_record.sta_id=1')->all();
        foreach($posts as $k=>$v)
		{
			$posts[$k]['res_hope'] = unserialize($v['res_hope']);
			$posts[$k]['rec_work'] = unserialize($v['rec_work']);
			$posts[$k]['res_works_undergo'] = unserialize($v['res_works_undergo']);
			$posts[$k]['res_study_undergo'] = unserialize($v['res_study_undergo']);
			$posts[$k]['res_project_experiences'] = unserialize($v['res_project_experiences']);
		}
        return $this->render('norefuse.html',['posts'=>$posts]);
    }
	
	/* 删除简历 */
    public function actionDel(){
        $connection = \Yii::$app->db;
        $posts=\Yii::$app->request->post('id');
        $command = $connection->createCommand()->delete('zpb_record', "record_id = $posts")->execute();
        if($command){
            echo 1;
        }else{
            echo 0;
        }
    }

}
