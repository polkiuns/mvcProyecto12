<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Model\Auth;
use Mini\Model\Course;

class AdminController extends Controller
{
	public function index()
	{
		if(Sesion::get('logged')){
		echo $this->view->render('admin/index');			
		} else {
		header('location: ' . URL . '');
		}

	}

	public function courses()
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			$courses = Course::all();
			$model = new Course;
			echo $this->view->render('admin/courses/index' , ['courses' => $courses , 'model' => $model]);	
			
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');				
			}
	}
}