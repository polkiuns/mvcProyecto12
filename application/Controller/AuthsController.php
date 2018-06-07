<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Auth;
use Mini\Libs\Sesion;

class AuthsController extends Controller
{
	public function login()
	{
		if(Sesion::get('logged')){
			echo $this->view->render('admin/index');
		} else {
			echo $this->view->render('auth/login');
		}		
		
	}
	
	public function doLogin()
	{
		if(Sesion::get('logged')){
			header('location: ' . URL . '');
		} else {
			
			if (Auth::user($_POST)) {
				$user = Auth::user($_POST);
				Sesion::add('name' , $user->name);
				Sesion::add('email' , $user->email);
				Sesion::add('password' , $user->password);
				Sesion::add('role' , $user->role);
				Sesion::add('logged' , true);
				Sesion::addFeedback('feedback_positive' , 'Logueo con exito');
				header('location: ' . URL . '/');
				} else {
				echo $this->view->render('auth/login');
				}			
		}

	}
	public function logout()
	{
		if(Sesion::get('logged')) {
			Sesion::destroy();
			header('location: ' . URL . '');
		} else {
			header('location: ' . URL . '');
		}
	}

	
}