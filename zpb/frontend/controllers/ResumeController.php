<?php
namespace frontend\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\Session;
use yii\web\Request;
use frontend\models\Zpb_recruit;
use \yii\data\Pagination;


class ResumeController extends Controller
{
    public $enableCsrfValidation = false;
    /* 去除Yii框架格式 */
    public $layout = false;

    /* 我的简历模板展示 */
    public function actionIndex()
    {
        $session = Yii::$app->session;
          //模拟session
        $m_id=$session->get('m_id');  //取出个人用户登录的id

        $query = (new \yii\db\Query())
            ->select('pre_name,pre_time,pre_age,pre_sex,stu_name,suf_name,m_phone,m_email,sta_name,pre_head,res_hope,res_works_undergo,res_project_experiences,res_study_undergo,res_desc,res_works')
            ->from('zpb_preson AS p')
            ->leftJoin('zpb_members AS m','m.m_id=p.m_id')
            ->leftJoin('zpb_study AS s','s.stu_id = p.stu_id')
            ->leftJoin('zpb_suffer AS su','su.suf_id = p.suf_id')
            ->leftJoin('zpb_resume AS r','r.m_id = p.m_id')
            ->leftJoin('zpb_status AS st','st.sta_id = p.sta_id')
            ->where(['m.m_id'=>$m_id])
            ->One();
        //反序列化取出期望工作
        $query['res_hope']=unserialize($query['res_hope']);
        //反序列化取出工作经历
        $query['res_works_undergo']=unserialize($query['res_works_undergo']);
        //反序列化取出项目经验
        $query['res_project_experiences']=unserialize($query['res_project_experiences']);
        //反序列化取出教育经历
        $query['res_study_undergo']=unserialize($query['res_study_undergo']);
        //反序列化取出个人作品
        $query['res_works']=unserialize($query['res_works']);
        //查询学历
        $study = (new \yii\db\Query())
            ->select('*')
            ->from('zpb_study')
            ->all();
        //查询工作经验
        $suffer = (new \yii\db\Query())
            ->select('*')
            ->from('zpb_suffer')
            ->all();
        //目前状态
        $status = (new \yii\db\Query())
            ->select('*')
            ->from('zpb_status')
            ->all();
        return $this->render('index.html',['query' => $query,'study' =>$study ,'suffer' => $suffer , 'status' => $status]);
    }

    /* 简历预览 */
    public function actionPreview()
    {
        $session = Yii::$app->session;
        $m_id=$session->get('m_id');  //取出个人用户登录的id

        $query = (new \yii\db\Query())
            ->select('pre_name,pre_time,pre_age,pre_sex,stu_name,suf_name,m_phone,m_email,sta_name,pre_head,res_hope,res_works_undergo,res_project_experiences,res_study_undergo,res_desc,res_works')
            ->from('zpb_preson AS p')
            ->leftJoin('zpb_members AS m','m.m_id=p.m_id')
            ->leftJoin('zpb_study AS s','s.stu_id = p.stu_id')
            ->leftJoin('zpb_suffer AS su','su.suf_id = p.suf_id')
            ->leftJoin('zpb_resume AS r','r.m_id = p.m_id')
            ->leftJoin('zpb_status AS st','st.sta_id = p.sta_id')
            ->where(['m.m_id'=>$m_id])
            ->One();
        //反序列化取出期望工作
        $query['res_hope']=unserialize($query['res_hope']);
        //反序列化取出工作经历
        $query['res_works_undergo']=unserialize($query['res_works_undergo']);
        //反序列化取出项目经验
        $query['res_project_experiences']=unserialize($query['res_project_experiences']);
        //反序列化取出教育经历
        $query['res_study_undergo']=unserialize($query['res_study_undergo']);
        //反序列化取出个人作品
        $query['res_works']=unserialize($query['res_works']);

        return $this->render('preview.html',['query' => $query]);
    }

    /* 个人头像上传 */
    public function actionUpload(){
        //文件上传根目录
        $dir_base = "./frontend/assets/style/images/preson/";
        //如果上传新图,则把原图删掉
        $img=\Yii::$app->request->post('img');
        $file=$_FILES['upload_file'];
        //截取图片后缀名
        $jpg = substr($file['name'], strrpos($file['name'], '.'));
        //定义文件名
        $filename = rand(0, 9999).mt_rand(0, 9999).$jpg;
        //判断文件是否上传
        if(!file_exists($_FILES['upload_file']['name'])){
            //移动目录
           if(move_uploaded_file($_FILES['upload_file']['tmp_name'],iconv('utf-8','gb2312',$dir_base.$filename)))
           {
               $session = Yii::$app->session;
               $m_id=$session->get('m_id');  //取出个人用户登录的id
               $re=\Yii::$app->db->createCommand()->update('zpb_preson', ['pre_head' => $filename , 'pre_time'  => time()], 'm_id ='.$m_id)->execute();
               if($re){
                   echo substr($dir_base.$filename,2);
               }
           }
        }
    }

    /* 头部修改名称 */
    public function actionTitle(){
        $resumeName = \Yii::$app->request->get('resumeName');
        $session = Yii::$app->session;
        $m_id=$session->get('m_id');  //取出个人用户登录的id
        $re=\Yii::$app->db->createCommand()->update('zpb_preson', ['pre_name' => $resumeName , 'pre_time'  => time()], 'm_id ='.$m_id)->execute();
        if(empty($resumeName)){
            $rows['error']= 0;
            $rows['msg']= '请输入你的真实姓名';
        }else{
            if($re){
                $rows = (new \yii\db\Query())->select(['pre_name', 'pre_time'])
                    ->from('zpb_preson')
                    ->where(['m_id' => $m_id])
                    ->One();
                $rows['pre_time']=date('Y-m-d H:i:s',$rows['pre_time']);
                $rows['error'] = 1;
            }else{
                $rows['error']= 0;
                $rows['msg']= '修改失败';
            }
        }
        echo json_encode($rows);
    }

    /* 基本信息修改 */
    public function actionPreson(){
        $pre_name = \Yii::$app->request->get('pre_name');
        $pre_sex = \Yii::$app->request->get('pre_sex');
        $stu_name = \Yii::$app->request->get('stu_name');
        $suf_name = \Yii::$app->request->get('suf_name');
        $m_phone = \Yii::$app->request->get('m_phone');
        $m_email = \Yii::$app->request->get('m_email');
        $sta_name = \Yii::$app->request->get('sta_name');
        $reg="/^1[356]\d{9}$/";
        $reg1="/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i";
        if(empty($pre_name)){
            $rows['error']= 0;
            $rows['msg']= '请输入你的真实姓名';
        }else  if(empty($m_phone)){
            $rows['error']= 0;
            $rows['msg']= '请输入手机号';
        }else if(!preg_match($reg,$m_phone)){
            $rows['error']= 0;
            $rows['msg']= '请输入有效的手机号';
        }else if(empty($m_email)){
            $rows['error']= 0;
            $rows['msg']= '请输入接收面试通知的常用邮箱';
        }else if(preg_match($reg1,$m_email)){
            $rows['error']= 0;
            $rows['msg']= '请输入有效的常用邮箱，如：vivi@lagou.com';
        }else{
            //查询学历
            $study = (new \yii\db\Query())
                ->select('stu_id')
                ->from('zpb_study')
                ->where(['stu_name' => $stu_name])
                ->One();
            //查询工作经验
            $suffer = (new \yii\db\Query())
                ->select('suf_id')
                ->from('zpb_suffer')
                ->where(['suf_name' => $suf_name])
                ->One();
            //目前状态
            $status = (new \yii\db\Query())
                ->select('sta_id')
                ->from('zpb_status')
                ->where(['sta_name' => $sta_name])
                ->One();
            $session = Yii::$app->session;
            $m_id=$session->get('m_id');  //取出个人用户登录的id

            //执行修改
            \Yii::$app->db->createCommand()->update('zpb_preson', ['pre_name' => $pre_name, 'pre_sex' => $pre_sex, 'stu_id' => $study['stu_id'], 'suf_id' => $suffer['suf_id'],'sta_id' =>$status['sta_id'],'pre_time'=> time()], 'm_id ='.$m_id)->execute();

            \Yii::$app->db->createCommand()->update('zpb_members', ['m_phone' => $m_phone, 'm_email' => $m_email], 'm_id ='.$m_id)->execute();
            $rows['error']= 1;
        }
		
        echo json_encode($rows);
    }

    /* 修改期望工作 */
    public function actionHope(){
        $expectCity= \Yii::$app->request->get('expectCity');
        $type_mold= \Yii::$app->request->get('type_mold');
        $expectPosition= \Yii::$app->request->get('expectPosition');
        $expectSalary= \Yii::$app->request->get('expectSalary');
        if(empty($expectCity)){
            $rows['error']=0;
            $rows['msg']='请选择您的期望城市';
        }else if(empty($expectPosition)){
            $rows['error']=0;
            $rows['msg']='请输入有效的期望职位，如：产品经理';
        }else if(empty($expectSalary)){
            $rows['error']=0;
            $rows['msg']='请输入期望月薪';
        }else{
            $session = Yii::$app->session;
            $m_id=$session->get('m_id');  //取出个人用户登录的id
            //序列化
            $arr = array('expectCity'=>$expectCity, 'type_mold'=>$type_mold,'expectPosition'=>$expectPosition, 'expectSalary'=>$expectSalary);
            $res_hope=serialize($arr);

            //执行修改
            \Yii::$app->db->createCommand()->update('zpb_resume', ['res_hope' => $res_hope], 'm_id ='.$m_id)->execute();
            \Yii::$app->db->createCommand()->update('zpb_preson',['pre_time'=> time()], 'm_id ='.$m_id)->execute();

            $rows['error']=1;
        }
        echo json_encode($rows);
    }

    /* 修改工作经历 */
    public function actionWorks_undergo(){
        $arr = \Yii::$app->request->get();
        if(empty($arr['companyName'])){
            $rows['error']=0;
            $rows['msg']='请输入有效的公司名称，如：拉勾网';
        }else if(empty($arr['positionName'])){
            $rows['error']=0;
            $rows['msg']='请输入有效的职位名称，如：产品经理';
        }else if(empty($arr['companyYearStart']) || empty($arr['companyMonthStart'])){
            $rows['error']=0;
            $rows['msg']='请选择开始时间';
        }else if(empty($arr['companyYearEnd']) || empty($arr['companyMonthEnd'])){
            $rows['error']=0;
            $rows['msg']='请选择结束时间';
        }else if($arr['companyYearStart'] > $arr['companyYearEnd']){
            $rows['error']=0;
            $rows['msg']='开始时间需早于结束时间';
        }else{
            $session = Yii::$app->session;
            $m_id=$session->get('m_id');  //取出个人用户登录的id

            //序列化
            $data = array('companyName'=>$arr['companyName'], 'positionName'=>$arr['positionName'],'companyYearStart'=>$arr['companyYearStart'], 'companyMonthStart'=>$arr['companyMonthStart'], 'companyYearEnd'=>$arr['companyYearEnd'], 'companyMonthEnd'=> $arr['companyMonthEnd']);
            $res_works_undergo=serialize($data);
            //执行修改
            \Yii::$app->db->createCommand()->update('zpb_resume', ['res_works_undergo' => $res_works_undergo], 'm_id ='.$m_id)->execute();
            \Yii::$app->db->createCommand()->update('zpb_preson',['pre_time'=> time()], 'm_id ='.$m_id)->execute();
            $rows['error']=1;
        }
        echo json_encode($rows);
    }

    /* 修改项目经验 */
    public function actionProject_experiences(){
        $arr = \Yii::$app->request->get();
        if(empty($arr['projectName'])){
            $rows['error']=0;
            $rows['msg']='请输入项目名称';
        }else if(empty($arr['thePost'])){
            $rows['error']=0;
            $rows['msg']='请输入担任职务';
        }else if(empty($arr['projectYearStart']) || empty($arr['projectMonthStart'])){
            $rows['error']=0;
            $rows['msg']='请选择开始时间';
        }else if(empty($arr['projectYearEnd']) || empty($arr['projectMonthEnd'])){
            $rows['error']=0;
            $rows['msg']='请选择结束时间';
        }else if($arr['projectYearStart'] > $arr['projectYearEnd']){
            $rows['error']=0;
            $rows['msg']='开始时间需早于结束时间';
        }else{
            $session = Yii::$app->session;
            $m_id=$session->get('m_id');  //取出个人用户登录的id

            //序列化
            $data = array('projectName'=>$arr['projectName'], 'thePost'=>$arr['thePost'],'projectYearStart'=>$arr['projectYearStart'], 'projectMonthStart'=>$arr['projectMonthStart'], 'projectYearEnd'=>$arr['projectYearEnd'], 'projectMonthEnd'=> $arr['projectMonthEnd'] , 'projectDescription' =>$arr['projectDescription']);
            $res_project_experiences=serialize($data);
            //执行修改
            \Yii::$app->db->createCommand()->update('zpb_resume', ['res_project_experiences' => $res_project_experiences], 'm_id ='.$m_id)->execute();
            \Yii::$app->db->createCommand()->update('zpb_preson',['pre_time'=> time()], 'm_id ='.$m_id)->execute();
            $rows['error']=1;
        }
        echo json_encode($rows);
    }

    /* 修改教育背景 */
    public function actionStudy_undergo(){
        $arr = \Yii::$app->request->get();
        if(empty($arr['schoolName'])){
            $rows['error']=0;
            $rows['msg']='请输入学校名称';
        }else if(empty($arr['degree'])){
            $rows['error']=0;
            $rows['msg']='请选择学历';
        }else if(empty($arr['professionalName'])){
            $rows['error']=0;
            $rows['msg']='请输入专业名称，如：软件工程';
        }else if(empty($arr['schoolYearStart'])){
            $rows['error']=0;
            $rows['msg']='请选择开始时间';
        }else if(empty($arr['schoolYearEnd'])){
            $rows['error']=0;
            $rows['msg']='请选择结束时间';
        }else if($arr['schoolYearStart'] >= $arr['schoolYearEnd']){
            $rows['error']=0;
            $rows['msg']='开始年份需小于结束年份';
        }else{
            $session = Yii::$app->session;
            $m_id=$session->get('m_id');  //取出个人用户登录的id

            //序列化
            $data = array('schoolName'=>$arr['schoolName'], 'degree'=>$arr['degree'],'professionalName'=>$arr['professionalName'], 'schoolYearStart'=>$arr['schoolYearStart'], 'schoolYearEnd'=>$arr['schoolYearEnd']);
            $res_study_undergo=serialize($data);
            //执行修改
            \Yii::$app->db->createCommand()->update('zpb_resume', ['res_study_undergo' => $res_study_undergo], 'm_id ='.$m_id)->execute();
            \Yii::$app->db->createCommand()->update('zpb_preson',['pre_time'=> time()], 'm_id ='.$m_id)->execute();
            $rows['error']=1;
        }
        echo json_encode($rows);
    }

    /* 修改自我描述 */
    public function actionRes_desc(){
        $selfDescription = \Yii::$app->request->get('selfDescription');
        $session = Yii::$app->session;
        $m_id=$session->get('m_id');  //取出个人用户登录的id
        //执行修改
        $re=\Yii::$app->db->createCommand()->update('zpb_resume', ['res_desc' => $selfDescription], 'm_id ='.$m_id)->execute();
        if($re){
            echo 1;
            \Yii::$app->db->createCommand()->update('zpb_preson',['pre_time'=> time()], 'm_id ='.$m_id)->execute();
        }else{
            echo 0;
        }
    }

    /* 修改展示作品*/
    public function actionRes_works(){
        $arr=\Yii::$app->request->get();
        $reg="/^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/";
        if(!preg_match($reg,$arr['workLink'])){
            $rows['error']=0;
            $rows['msg']='请输入有效的作品链接, 如:http://www.sian.com';
        }else{
            $session = Yii::$app->session;
            $m_id=$session->get('m_id');  //取出个人用户登录的id

            //序列化
            $data = array('workLink'=>$arr['workLink'], 'workDescription'=>$arr['workDescription']);
            $res_works=serialize($data);
            //执行修改
            \Yii::$app->db->createCommand()->update('zpb_resume', ['res_works' => $res_works], 'm_id ='.$m_id)->execute();
            \Yii::$app->db->createCommand()->update('zpb_preson',['pre_time'=> time()], 'm_id ='.$m_id)->execute();
            $rows['error']=1;
        }
        echo json_encode($rows);
    }

    /* 我收藏的职位 */
    public function actionCollections()
    {
		$session = Yii::$app->session;
		$m_id = $session->get('m_id');
		$data = (new \yii\db\query())->select(['*'])->from('zpb_collect')->innerjoin('zpb_recruit','zpb_recruit.rec_id=zpb_collect.rec_id')->innerjoin('zpb_firm','zpb_firm.m_id=zpb_recruit.m_id')->innerjoin('zpb_study','zpb_study.stu_id=zpb_recruit.stu_id')->innerjoin('zpb_suffer','zpb_suffer.suf_id=zpb_recruit.suf_id')->where('zpb_collect.m_id='.$m_id)->all();
        return $this->render('collections.html',['arr'=>$data]);
    }

    /* 我投递的职位 */
    public function actionToudi()
    {
        $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id=$session['m_id'];
        // $data = (new \yii\db\query())->select(['*'])->from('zpb_recruit')->innerjoin('zpb_firm')->where(['zpb_recruit.m_id'=>$m_id])->one();
        $command = $connection->createCommand("select * from zpb_record INNER JOIN zpb_recruit ON zpb_record.rec_id=zpb_recruit.rec_id JOIN zpb_resume ON zpb_record.m_id=zpb_resume.m_id JOIN zpb_firm ON zpb_record.m_id=zpb_firm.m_id where zpb_record.m_id='$m_id'");
        $data = $command->queryAll();
        return $this->render('toudi.html',['show'=>$data]);
    }
    /* 显示投递成功 */
    public function actionFirst()
    {
        $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id=$session['m_id'];
        $command = $connection->createCommand("select * from zpb_record INNER JOIN zpb_recruit ON zpb_record.rec_id=zpb_recruit.rec_id JOIN zpb_resume ON zpb_record.m_id=zpb_resume.m_id JOIN zpb_firm ON zpb_record.m_id=zpb_firm.m_id WHERE zpb_record.m_id='$m_id' AND zpb_record.sta_id=1");
        $data = $command->queryAll();
        // print_r($data);die;
         return $this->render('toudi.html',['show'=>$data]);
    }
    /* 不合适 */
    public function actionNo()
    {
       $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id=$session['m_id'];
        $command = $connection->createCommand("select * from zpb_record INNER JOIN zpb_recruit ON zpb_record.rec_id=zpb_recruit.rec_id JOIN zpb_resume ON zpb_record.m_id=zpb_resume.m_id JOIN zpb_firm ON zpb_record.m_id=zpb_firm.m_id WHERE zpb_record.m_id='$m_id' AND zpb_record.sta_id=0 ");
        $data = $command->queryAll();
         // print_r($data);die;
         return $this->render('toudi.html',['show'=>$data]); 
    }
    /* 被查看 */
     public function actionLooks(){
        $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id=$session['m_id'];
        $command = $connection->createCommand("select * from zpb_record INNER JOIN zpb_recruit ON zpb_record.rec_id=zpb_recruit.rec_id JOIN zpb_resume ON zpb_record.m_id=zpb_resume.m_id JOIN zpb_firm ON zpb_record.m_id=zpb_firm.m_id WHERE zpb_record.m_id='$m_id' AND zpb_record.sta_id=2");
        $data = $command->queryAll();
        // print_r($data);die;
         return $this->render('toudi.html',['show'=>$data]);
     }
     /*通过筛选*/
     public function actionShai(){
        $connection = \Yii::$app->db;
        $session = Yii::$app->session;
        $m_id=$session['m_id'];
        $command = $connection->createCommand("select * from zpb_record INNER JOIN zpb_recruit ON zpb_record.rec_id=zpb_recruit.rec_id JOIN zpb_resume ON zpb_record.m_id=zpb_resume.m_id JOIN zpb_firm ON zpb_record.m_id=zpb_firm.m_id WHERE zpb_record.m_id='$m_id' AND zpb_record.sta_id=3");
        $data = $command->queryAll();
        // print_r($data);die;
         return $this->render('toudi.html',['show'=>$data]);
     }
    /* 我的订阅 和我订阅的职位 */
    public function actionSubscribe()
    {
        return $this->render('subscribe.html');
    }

    /* 我的职位推荐 */
    public function actionMlist()
    {
        return $this->render('mlist.html');
    }

    /* 我要找工作 */
    public function actionWorklist()
    {
        //查询学历
        $study = (new \yii\db\Query())
            ->select('*')
            ->from('zpb_study')
            ->all();
        //查询工作经验
        $suffer = (new \yii\db\Query())
            ->select('*')
            ->from('zpb_suffer')
            ->all();
        $query = Zpb_recruit::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>9]);

        //工作和简历遍历
        $arr = (new \yii\db\Query())
            ->select('rec_title,rec_city,rec_moneymin,rec_moneymax,suf_name,stu_name,rec_sport,rec_time,field_name,firm_name,firm_leader,firm_stage,firm_sca,firm_xy,rec_id')
            ->from('zpb_recruit AS r')
            ->leftJoin('zpb_firm AS f','r.m_id=f.m_id')
            ->leftJoin('zpb_field AS fi','fi.field_id=f.field_id')
            ->leftJoin('zpb_study AS stu','stu.stu_id=r.stu_id')
            ->leftJoin('zpb_suffer AS su','su.suf_id=r.suf_id')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->All();
        foreach($arr as $k=>$v){
            $arr[$k]['firm_xy'] = explode(',',$v['firm_xy']);
        }
        return $this->render('worklist.html',['study'=>$study,'suffer'=>$suffer,'query'=>$arr, 'pages' => $pages]);
    }


    /* 账号设置 */
    public function actionAccount()
    {
        return $this->render('account.html');
    }

    /* 修改密码 */
    public function actionUpdatepwd()
    {
        $session = Yii::$app->session;
        $m_id=$session->get('m_id');  //取出个人用户登录的id
        return $this->render('updatepwd.html');
    }
}