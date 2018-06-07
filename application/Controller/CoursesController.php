<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Course;
use Mini\Model\Auth;
use Mini\Libs\Sesion;
use Mini\Libs\helper;

class CoursesController extends Controller
{
	public function index()
	{
		$courseModel = new Course();
		$courses = $courseModel->parents();
		echo $this->view->render('courses/index',
						['courses' => $courses,
						'courseModel' => $courseModel
						
							]);
	}

	public function create()
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			$courses = Course::all();
			echo $this->view->render('admin/courses/create', ['courses' => $courses]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	
	}

	public function store()
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/courses/create');
			} else {
				if ( ! isset($_POST["name"])){
					$_POST["name"] = "";
				}
				$url = helper::createSlug($_POST["name"]);
				$data = ['name' => $_POST["name"],
					  	'course_id' => $_POST["course_id"],
					  	'url' => $url
					  ];

				if (Course::store($data)) {
					header('location: ' . URL . 'courses/create');
				} else {
					header('location: ' . URL . 'courses/create');
						}
			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}
	
	
	}

	public function edit($course_url)
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			$selectedCourse = Course::findUrl($course_url);
			$courses = Course::all();
			echo $this->view->render('admin/courses/edit', ['selectedCourse' => $selectedCourse , 'courses'=>$courses]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
			
	}

	public function update()
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/courses');
			} else {
				$exist = Course::find($_POST["id"]);
				if($exist){
				if ( ! isset($_POST["name"])){
					$_POST["name"] = "";
				}
				$url = helper::createSlug($_POST["name"]);
				$data = ['name' => $_POST["name"],
					  	'course_id' => $_POST["course_id"],
					  	'url' => $url , 
					  	'id' => $_POST["id"]
					  ];

				if (Course::update($data)) {
					header('location: ' . URL . 'admin/courses');
				} else {
					header('location: ' . URL . 'admin/courses');
						}					
					} else {
						header('location: ' . URL . 'admin/courses');
					}

			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}
	
			
	}
	
	public function delete()
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			if ( ! $_POST) {
				echo $this->view->render('admin');
			} else {
				$exist = Course::find($_POST["id"]);
				if($exist){
				$data = [
					  	'id' => $_POST["id"]
					  ];

				if (Course::delete($data)) {
					header('location: ' . URL . 'admin/courses');
				} else {
					header('location: ' . URL . 'admin/courses');
						}					
					} else {
						header('location: ' . URL . 'admin/courses');
					}

			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}		
	}
}