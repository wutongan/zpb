<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\Role_type;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
header("content-type:text/html; charset=utf-8");
/*
* @ author     wutongan
* @ time 	   2016-06-11	
* @ copyright  zhaopinba
* 
*/
class SiteController extends Controller{

    /* 去除Yii框架格式 */
    public $layout=false;
	public $enableCsrfValidation=false;
    /* 前台首页 */
    public function actionIndex(){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('zpb_article_sort')
            ->limit(5)
            ->all();
        $type = (new \yii\db\query())->select(['*'])->from('zpb_type')->where(['type_pid'=>0])->all();
        foreach($type as $key=>$v)
        {
            $type[$key]['child']=(new \yii\db\query())->select(['*'])->from('zpb_type')->where(['type_pid'=>$v['type_id']])->all();
            foreach($type[$key]['child'] as $k=>$val)
            {
                $type[$key]['child'][$k]['chilrden']=(new \yii\db\query())->select(['*'])->from('zpb_type')->where(['type_pid'=>$val['type_id']])->all();
            }
        }
        //热门职位
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("select * from zpb_firm INNER JOIN zpb_recruit ON zpb_firm.m_id=zpb_recruit.m_id JOIN zpb_study ON zpb_recruit.stu_id=zpb_study.stu_id JOIN zpb_suffer ON zpb_recruit.suf_id=zpb_suffer.suf_id JOIN zpb_field  ON zpb_firm.field_id=zpb_field.field_id   WHERE rec_host=0 and zpb_recruit.sta_id=0  limit 5");
        $posts = $command->queryAll();
        foreach($posts as $k=>$v)
        {
            $aa = $v['firm_xy'];
            $aa = explode(',',$aa);
            $posts[$k]['ld'] = $aa;
        }
        //最新职位
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("select * from zpb_firm INNER JOIN zpb_recruit ON zpb_firm.m_id=zpb_recruit.m_id JOIN zpb_study ON zpb_recruit.stu_id=zpb_study.stu_id JOIN zpb_suffer ON zpb_recruit.suf_id=zpb_suffer.suf_id JOIN zpb_field  ON zpb_firm.field_id=zpb_field.field_id  WHERE zpb_recruit.sta_id=0 and rec_host=1 ORDER BY rec_time DESC limit 5");
        $news = $command->queryAll();
        foreach($news as $k=>$v)
        {
            $aa = $v['firm_xy'];
            $aa = explode(',',$aa);
            $news[$k]['ld'] = $aa;
        }
        return $this->render('index.html',array('type'=>$type,'rows'=>$rows,'posts'=>$posts,'news'=>$news));
    }

    /* 公共头部 */
    public function actionHead(){

        return $this->render('head.html');
    }

    /* 公共底部 */
    public function actionFooter(){

        return $this->render('footer.html');
    }

    /* 进入详情页*/
    public function actionParticulars(){
        //获取进入详情页面的id
        $connection = \Yii::$app->db;
        $request = Yii::$app->request;
        $id = $request->get('id');
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("select * from zpb_firm INNER JOIN zpb_recruit ON zpb_firm.m_id=zpb_recruit.m_id JOIN zpb_study ON zpb_recruit.stu_id=zpb_study.stu_id JOIN zpb_suffer ON zpb_recruit.suf_id=zpb_suffer.suf_id JOIN zpb_field  ON zpb_firm.field_id=zpb_field.field_id   WHERE rec_id='$id'");
        $data = $command->queryAll();

        return $this->render('particulars.html',array('data'=>$data));
    }
    /*添加详情信息*/
    public function actionAdd()
    {
        $connection =Yii::$app->db;
        $session=Yii::$app->session;
        $m_id=$session['m_id'];

        if( $m_id == array() )
        {
            echo "<script>alert('请先登录');location.href='index.php?r=login/index'</script>";
        }
        else
        {
            $command = $connection->createCommand("select * FROM zpb_members  WHERE m_id='$m_id'");
            $data = $command->queryone();
            // print_r($data);die;
            // die;
            $m_type=$data['m_type'];
            if( $m_type == 2 )
            {
                echo "<script>alert('非常抱歉，企业无法投递简历');location.href='index.php?r=site/index'</script>";
            }
            else
            {
                $request = Yii::$app->request;
                $rec_id = $request->get('rec_id');
                $arr=$connection->createCommand("select * from zpb_record where rec_id='$rec_id' and m_id='$m_id' and sta_id = 0")->queryone();
				// print_r($arr);die;
				if($arr)
				{
					echo "<script>alert('您已经对该公司投递过');location.href='index.php?r=site/index'</script>";
				}
				else
				{
					$record_time=time();
					$command = $connection->createCommand("insert into zpb_record (rec_id,m_id,record_time) values ('$rec_id','$m_id','$record_time')")->execute();
					if($command == 1)
					{
						echo "<script>alert('投递成功');location.href='index.php?r=site/index'</script>";
					}
					
				}
            }
        }
    }

  /* 收藏职位 */
	public function actionCollect()
	{
		$id = Yii::$app->request->get('id');
		$session=Yii::$app->session;
        $m_id = $session['m_id'];
		if(empty($m_id))
		{
			$info['err'] = 2;
			$info['msg'] = '请先登陆';
			$info['href'] = 'index.php?r=login/index';
		}
		else
		{
			$row = (new \yii\db\query())->select(['m_type'])->from('zpb_members')->where(['m_id'=>$m_id])->one();
			if($row['m_type']==2)
			{
				$info['err'] = 1;
				$info['msg'] = '您不能收藏该招聘信息'; 
			}
			else
			{
				$rows = (new \yii\db\query())->select(['*'])->from('zpb_collect')->where(['m_id'=>$m_id,'rec_id'=>$id])->one();
				if($rows)
				{
					$info['err'] = 1;
					$info['msg'] = '该信息已经收藏';
				}
				else
				{
					$connection = Yii::$app->db;
					$data['m_id'] = $m_id;
					$data['rec_id'] = $id;
					$data['col_time'] = time();
					$res = $connection->createCommand()->insert('zpb_collect',$data)->execute();
					if($res)
					{
						$info['err'] = 0;
						$info['msg'] = '收藏成功';
					}
				}
			}	
		}
		echo json_encode($info);
	}
	/* 取消收藏 */
	public function actionNocollect()
	{
		$id = Yii::$app->request->post('id');
		$session=Yii::$app->session;
        $m_id = $session['m_id'];
		$db = Yii::$app->db;
		$res = $db->createCommand()->delete('zpb_collect',['col_id'=>$id])->execute();
		if($res)
		{
			echo 1;
		}
	}
}
