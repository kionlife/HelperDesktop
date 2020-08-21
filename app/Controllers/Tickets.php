<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TicketModel;


class Tickets extends Controller
{
	public function index()
	{
		$this->is_auth('main');	
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

	public function add() {
		$text = $_POST['text'];
		$clientID = $_POST['clientId'];
		$script = $_POST['script'];
		$db = db_connect();
		$db->query("INSERT INTO tickets(text, client_id, script) VALUES ('$text', '$clientID', '$script')");
	}


	public function new()
	{
		$this->is_auth('new');
	}

	public function all()
	{
		$this->is_auth('all');
	}

	public function accept()
	{
		$this->is_auth('accept');
	}

	public function changeStatus($id) {
		session_start();
		$status_type = $_POST['status'];
		$status = new TicketModel();
		$status->changeStatus($id, $status_type);
	}

	public function get($status) {
		$tickets = new TicketModel();

		if ($status != 'all') {
			$data = [
				'tickets'  => $tickets->getTicketsByStatus($status)
			];
		} else {
			$data = [
				'tickets'  => $tickets->getTickets()
			];
		}

		echo view('ticket', $data);
	}

	public function getByStatus($status) {
		$tickets = new TicketModel();

		$data = [
			'tickets'  => $tickets->getTicketsByStatus($status)
		];

		//var_dump($data);
		echo view('ticket', $data);
	}
	
	public function getScripts() {
		// $id = $_POST['id'];
		$id = 39;
		$ticket_model = new TicketModel();
		$ticket = $ticket_model->getTicketById($id);
		
		//var_dump($ticket);
		
		return $ticket[0]['script'];
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
		//var_dump($auth_result);
	}

	//--------------------------------------------------------------------

}
