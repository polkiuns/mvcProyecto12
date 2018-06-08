<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Subject;
use Mini\Model\Auth;
use Mini\Libs\Sesion;
use Mini\Libs\helper;
use Mini\Model\Course;
use Mini\Model\Lesson;


class LessonsController extends Controller
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
		if(Auth::authorice($_SESSION['role'], 'create', 'lesson')) {
			$subjects = Subject::all();
			echo $this->view->render('admin/lessons/create', ['subjects' => $subjects]);
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
				if(isset($_POST['published'])){
				$data = ['name' => $_POST["name"],
					  	'subject_id' => $_POST["subject_id"],
					  	'lesson_id' => $_POST["lesson_id"],
					  	'teacher_id' => $_POST["teacher_id"],
					  	'published' => 1
					  ];					
				} else {
				$data = ['name' => $_POST["name"],
					  	'subject_id' => $_POST["subject_id"],
					  	'lesson_id' => $_POST["lesson_id"],
					  	'teacher_id' => $_POST["teacher_id"],
					  	'published' => 0
					  ];							
				}


				if (Lesson::store($data)) {
					header('location: ' . URL . 'lessons/create');
				} else {
					header('location: ' . URL . 'admin/');
						}
			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}
	}

	public function edit($id)
	{
		if(Auth::authorice($_SESSION['role'], 'edit', 'subject')) {
			$selectedLesson = Lesson::find($id);
			$subjects = Subject::all();
			$model = new Lesson;
			echo $this->view->render('admin/lessons/edit', ['selectedLesson' => $selectedLesson , 'subjects'=>$subjects , 'model' => $model]);
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
				$exists = Lesson::find($_POST['id']);
				if($exists) {
					if(isset($_POST['published'])) {
					$data = ['name' => $_POST["name"],
					  	'subject_id' => $_POST["subject_id"],
					  	'lesson_id' => $_POST["lesson_id"],
					  	'teacher_id' => $_POST["teacher_id"],
					  	'id' => $_POST["id"],
					  	'published' => 1
					  ];						
					} else {
					$data = ['name' => $_POST["name"],
					  	'subject_id' => $_POST["subject_id"],
					  	'lesson_id' => $_POST["lesson_id"],
					  	'teacher_id' => $_POST["teacher_id"],
					  	'id' => $_POST["id"],
					  	'published' => 0
					  ];	
					}


				if (Lesson::update($data)) {
					header('location: ' . URL . 'admin/lessons');
				} else {
					header('location: ' . URL . 'admin/');
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
				$exist = Lesson::find($_POST["id"]);
				if($exist){
				$data = [
					  	'id' => $_POST["id"]
					  ];

				if (Lesson::delete($data)) {
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
}