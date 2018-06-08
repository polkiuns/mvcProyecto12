<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Subject;
use Mini\Model\Auth;
use Mini\Libs\Sesion;
use Mini\Libs\helper;
use Mini\Model\Course;
use Mini\Model\Lesson;

class SubjectsController extends Controller
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
			echo $this->view->render('admin/subjects/create', ['courses' => $courses]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	}

	public function store()
	{
		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/subjects/create');
			} else {
				$url = helper::createSlug($_POST["name"]);
				$data = ['name' => $_POST["name"],
					  	'courses_id' => $_POST["course_id"],
					  	'description' => $_POST["description"],
					  	'url' => $url
					  ];

				if (Subject::store($data)) {
					header('location: ' . URL . 'subjects/create');
				} else {
					header('location: ' . URL . 'admin/courses');
						}
			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}
	}

	public function edit($subject_url)
	{
		if(Auth::authorice($_SESSION['role'], 'edit', 'subject')) {
			$selectedSubject = Subject::findUrl($subject_url);
			$courses = Course::all();
			$model = new Subject;
			echo $this->view->render('admin/subjects/edit', ['selectedSubject' => $selectedSubject , 'courses'=>$courses , 'model' => $model]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	}

	public function update()
	{

		if(Auth::authorice($_SESSION['role'], 'create', 'course')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/subjects');
			} else {
				$exists = Subject::find($_POST['id']);
				if($exists) {
				$url = helper::createSlug($_POST["name"]);
				$data = ['name' => $_POST["name"],
					  	'courses_id' => $_POST["course_id"],
					  	'description' => $_POST["description"],
					  	'id' => $_POST["id"],
					  	'url' => $url
					  ];

				if (Subject::update($data)) {
					header('location: ' . URL . 'admin/subjects');
				} else {
					header('location: ' . URL . 'admin/subjects');
						}					
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
				$exist = Subject::find($_POST["id"]);
				if($exist){
				$data = [
					  	'id' => $_POST["id"]
					  ];

				if (Subject::delete($data)) {
					header('location: ' . URL . 'admin/subjects');
				} else {
					header('location: ' . URL . 'admin/subjects');
						}					
					} else {
						header('location: ' . URL . 'admin/subjects');
					}

			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}		
	}

	public function show($url)
	{
		if(Auth::authorice($_SESSION['role'], 'show', 'subject')) {

			$subject = Subject::findUrl($url);
			if($subject) {
				$subjectModel = new Subject;
				$subjectLessons = Lesson::parents($subject->id);
				$lessonModel = new Lesson;
				echo $this->view->render('subjects/index' , ['subject' => $subject , 'subjectModel' => $subjectModel , 'subjectLessons' => $subjectLessons , 'lessonModel' => $lessonModel]);
			} else {
			header('location: ' . URL . '');				
			}

			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}	
	}
}