<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TicketModel;


class Settings extends Controller
{
	public function index()
	{
		$this->is_auth('settings/desktop');		
	}

	public function login()
	{
		echo view('login');
	}

	
	public function is_auth($view) {
		session_start();
		if ($_SESSION['is_auth'] == true) {
			$check = new TicketModel();
			$auth = $check->checkLogin($_SESSION['secret_key'], $_SESSION['login']);
			if ($auth == true) {
				$data['login'] = $_SESSION['login'];
				
				echo view($view, $data);
			} else {
				echo view('login');
			}
		} else {
			echo view('login');
		}
	}	

	
	public function is_auth2() {
		session_start();
		if ($_SESSION['is_auth'] == true) {
			$check = new TicketModel();
			$auth = $check->checkLogin($_SESSION['secret_key'], $_SESSION['login']);
			if ($auth == true) {
				return true;
			} else {
				echo view('login');
			}
		} else {
			echo view('login');
		}
	}	

	public function auth() {
		$login = $_POST['login'];
		$pass  = $_POST['pass'];

		$auth = new TicketModel();
		$auth_result = $auth->auth($login, $pass);

		if ($auth_result == true) {
			return redirect()->to('/');
		} else {
			$data['error'] = 'Помилка авторизації. Перевірте логін/пароль!';
			echo view('login', $data);
		}
	}
	
	public function get_settings() {
		$name = 'user_problems';
		
		$settings = new TicketModel();
		$settingByName = $settings->getSetting($name);
		$value = $settingByName[0]->value;
		
		$arr_value = explode(';',$value);
		$arr_value = array_diff($arr_value, array(''));
		$json_value = json_encode($arr_value, JSON_UNESCAPED_UNICODE);
		return $json_value; 
	}
	
	public function get_problems() {
		
		$problems = new TicketModel();
		$problems_ob = $problems->getProblems();
		
		//var_dump($problems_ob);
		
		$arr_value = array_diff($problems_ob, array(''));
		$json_value = json_encode($arr_value, JSON_UNESCAPED_UNICODE);
		return $json_value;
	}
	
	public function get_checklist($id) {
		
		$list = new TicketModel();
		$list_array = $list->getChecklist($id);
		
		//var_dump($problems_ob);
		
		$arr_value = array_diff($list_array, array(''));
		$json_value = json_encode($arr_value, JSON_UNESCAPED_UNICODE);
		return $json_value;
	}
	
	public function get_setting_by_name($name) {
		
		$settings = new TicketModel();
		$settingByName = $settings->getSetting($name);
		$value = $settingByName[0]->value;
		
		
		return $value; 
	}
	
	public function updateSettings() {
		$name = 'user_problems';
		$value = $_POST['user_problems'];
		
		$settings = new TicketModel();
		$settings->addProblems($value);
		
		return redirect()->to(base_url('settings/desktop'));
	}
	
	public function addUser() {
		$data['login'] = $_POST['login'];
		$data['pass'] = $_POST['pass'];
		
		$user = new TicketModel();
		$user->addUser($data);
		
		return redirect()->to(base_url('settings/users'));
	}

	public function desktop() {
		
		if ($this->is_auth2() == true) {
			$problems = new TicketModel();
			$problems_ob = $problems->getProblems();
			$data['login'] = $_SESSION['login'];
			$data['user_problems'] = $problems_ob;
			$data['server_url'] = $this->get_setting_by_name('server_url');
			
			echo view('settings/desktop', $data);
		}
	}
	
	public function users() {
		if ($this->is_auth2() == true) {
			$data['login'] = $_SESSION['login'];
			$users = new TicketModel();
			$data['users'] = $users->get_users();
			echo view('settings/users', $data);
		}
	}


}
