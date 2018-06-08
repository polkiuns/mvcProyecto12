<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Course;
use Mini\Model\Auth;
use Mini\Model\Subject;
use Mini\Model\Teacher;
use Mini\Libs\Sesion;
use Mini\Libs\helper;
use Mini\Model\Lesson;
class DynamicselectsController extends Controller
{
	public function getLesson()
	{
		$lessons = Subject::getLessons($_POST['id_subject']);
		$teachers = Teacher::all();
		if(count($lessons)) {
			echo $this->view->render('scripts/getLesson' , ['lessons' => $lessons]);
		} else {
			echo $this->view->render('scripts/getLessonError' , ['error' => 'No se encuentran lecciones' , 'teachers' => $teachers]);
		}
		
	}

	public function getTeachers()
	{
		$teachers = Teacher::all();
		echo $this->view->render('scripts/getTeachers' , ['teachers' => $teachers]);
	}
	
	public function getTeacher()
	{
		$teacher = Lesson::getTeacher($_POST['id_lesson']);
		if(isset($teacher->name)) {
			echo $this->view->render('scripts/getTeacher' , ['teacher' => $teacher]);
		} else {
			echo $this->view->render('scripts/getTeacherError');
		}
		
	}

}