<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Subject;
use Mini\Model\Auth;
use Mini\Model\Teacher;
use Mini\Model\Student;

use Mini\Libs\Sesion;
use Mini\Libs\helper;
use Mini\Model\Course;

class StudentsController extends Controller
{
	public function index()
	{

	}

	public function create()
	{
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			$subjects = subject::all();
			echo $this->view->render('admin/students/create', ['subjects' => $subjects]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	}

	public function store()
	{
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/students/create');
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

				if (Student::store($data)) {
					header('location: ' . URL . 'admin/students');
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
			$selectedStudent = Student::find($id);
			$subjects = Subject::all();
			$model = new Student;
			echo $this->view->render('admin/students/edit', ['selectedStudent' => $selectedStudent , 'subjects'=>$subjects , 'model' => $model]);
		} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . '');
		}
	}

	public function update()
	{

		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			if ( ! $_POST) {
				echo $this->view->render('admin/students');
			} else {
				$exists = Student::find($_POST['id']);
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

				if (Student::update($data)) {
					header('location: ' . URL . 'admin/students');
				} else {
					header('location: ' . URL . 'admin/');
						}					
				}

			}
			} else {
			Sesion::addFeedback('feedback_negative' , 'Error');
			header('location: ' . URL . 'admin/');
			}
			
	}
	
	public function delete()
	{
		if(Auth::authorice($_SESSION['role'], 'view', 'teacher')) {
			if ( ! $_POST) {
				echo $this->view->render('admin');
			} else {
				$exist = Student::findUser($_POST["id"]);
				if($exist){
				$data = [
					  	'id' => $_POST["id"]
					  ];

				if (Student::delete($data)) {
					header('location: ' . URL . 'admin/students');
				} else {
					header('location: ' . URL . 'admin/');
						}					
					} else {
						header('location: ' . URL . 'admin/students');
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