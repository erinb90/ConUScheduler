<?php

/**
 * Created by PhpStorm.
 * User: Server
 * Date: 3/6/2016
 * Time: 11:44 AM
 */
use app\models\CompletedCoursesForm;
class ProfileController extends Controller
{

    public $layout='//layouts/column2';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionRecord()
    {
        $model = new CompletedCourses();
        $this->render('record',
            array(
                'model'=> $model
            )
        );
    }


    public function filters()
    {
        return array(
            'accessControl',
        );
    }


    public function actionAddCompleted()
    {
        $model = new PreferenceForm();
        $model = new app\models\CompletedCoursesForm();
        Yii::app()->db->createCommand()->insert('completed_courses', array(
            'userId'=>19,
            'courseId'=>5,
            'Grade'=>"A+",
            'GPA'=>4.3,
        ));;

        if ($model->load(Yii::$app->request->post())) {
            // valid data received in $model
            $temp=$_POST['courseCode'];
            $data="\"$temp\"";
            $sql="SELECT * FROM course WHERE course_code=$data";
            $test=Yii::app()->db->createCommand($sql);
            $data=$test->queryAll();
            $id_request=$data[0]["ID"];
            $grade_to_gpa=array("F"=>0,"D-"=>0.7,"D"=>1,"D+"=>1.3,"C-"=>1.7,"C"=>2.0,"C+"=>2.3,"B-"=>2.7,"B"=>3.0,"B+"=>3.3,"A-"=>3.7,"A"=>4.0,"A+"=>4.3,);
            $id=Yii::app()->user->userID;
            $gpa=$grade_to_gpa[$_POST['grade']];
            $grade=$_POST['grade'];
            Yii::app()->db->createCommand()->insert('completed_courses', array(
                'userId'=>$id,
                'courseId'=>$id_request,
                'Grade'=>"$grade",
                'GPA'=>$gpa,
            ));;

            // do something meaningful here about $model ...

            return $this->render('record', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('record', ['model' => $model]);
        }
    }
}