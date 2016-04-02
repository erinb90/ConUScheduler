<?php

/**
 * Created by PhpStorm.
 * User: Server
 * Date: 3/6/2016
 * Time: 11:44 AM
 */

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

        $model = new CompletedCourses;

        $data = $_POST['CompletedCourses'];

        // continue validation here. Checkout beforeSave() method from Yii

        $grade_to_gpa = array("F"=>0,"D-"=>0.7,"D"=>1,"D+"=>1.3,"C-"=>1.7,"C"=>2.0,"C+"=>2.3,"B-"=>2.7,"B"=>3.0,"B+"=>3.3,"A-"=>3.7,"A"=>4.0,"A+"=>4.3,);
        $model->courseID = $data['courseID'];
        $model->Grade = $data['Grade'];
        $model->userID = Yii::app()->user->userID;
        $model->GPA = $grade_to_gpa[$data['Grade']];

        $model->save(); // insert row



        $this->redirect(array('record','added'=>1)); // the 'added' variable should appear in URL with a '1' if course was successfully added

    }
}