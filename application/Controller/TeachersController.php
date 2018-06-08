<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Subject;
use Mini\Model\Auth;
use Mini\Model\Teacher;
use Mini\Libs\Sesion;
use Mini\Libs\helper;
use Mini\Model\Course;

class TeachersController extends Controller
{
	public function index()
	{

	}

	public function create()
	{
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			$subjects = subject::all();
			echo $this->view->render('admin/teachers/create', ['subjects' => $subjects]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	}

	public function store()
	{
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/teachers/create');
			} else {
				$data = ['name' => $_POST["name"],
					  	'subjects_id' => $_POST["subject_id"],
					  	'surname' => $_POST["surname"],
					  	'phone' => $_POST["phone"],
					  	'address' => $_POST["address"],
					  	'dni' => $_POST["dni"],
					  	'email' => $_POST["email"],
					  	'password' => $_POST["password"],
					  ];

				if (Teacher::store($data)) {
					header('location: ' . URL . 'admin/teachers');
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
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			$selectedTeacher = Teacher::find($id);
			$subjects = Subject::all();
			$model = new Teacher;
			echo $this->view->render('admin/teachers/edit', ['selectedTeacher' => $selectedTeacher , 'subjects'=>$subjects , 'model' => $model]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	}

	public function update()
	{

		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/teachers');
			} else {
				$exists = Teacher::find($_POST['id']);
				if($exists) {
					if($_POST['password']) {
						$data = ['name' => $_POST["name"],
					  	'subjects_id' => $_POST["subject_id"],
					  	'surname' => $_POST["surname"],
					  	'user_id' => $_POST["user_id"],					  	
					  	'phone' => $_POST["phone"],
					  	'id' => $_POST["id"],
					  	'address' => $_POST["address"],
					  	'dni' => $_POST["dni"],
					  	'email' => $_POST["email"],
					  	'password' => $_POST["password"],
					  ];						
					} else {
						$data = ['name' => $_POST["name"],
					  	'subjects_id' => $_POST["subject_id"],
					  	'surname' => $_POST["surname"],
					  	'user_id' => $_POST["user_id"],
					  	'id' => $_POST["id"],
					  	'phone' => $_POST["phone"],
					  	'address' => $_POST["address"],
					  	'dni' => $_POST["dni"],
					  	'email' => $_POST["email"],
					  ];						
					}

				if (Teacher::update($data)) {
					header('location: ' . URL . 'admin/teachers');
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
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			if ( ! $_POST) {
				echo $this->view->render('admin');
			} else {
				$exist = Teacher::findUser($_POST["id"]);
				if($exist){
				$data = [
					  	'id' => $_POST["id"]
					  ];

				if (Teacher::delete($data)) {
					header('location: ' . URL . 'admin/teachers');
				} else {
					header('location: ' . URL . 'admin/');
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
				echo $this->view->render('subjects/index' , ['subject' => $subject , 'subjectModel' => $subjectModel]);
			} else {
			header('location: ' . URL . '');				
			}

			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
			}	
	}
}