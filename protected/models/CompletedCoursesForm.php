<?php
namespace app\models;


/**
 * Created by PhpStorm.
 * User: Bryce
 * Date: 2016-04-02
 * Time: 2:39 PM
 */
class CompletedCoursesForm extends CFormModel
{
    public $courseID;
    public $grade;

    public function rules()
    {
        return [
            ['courseID', 'grade', 'required'],
        ];
    }
}