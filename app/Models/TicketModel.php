<?php 

namespace App\Models;
 
use CodeIgniter\Model;
class TicketModel extends Model
{
    protected $table = 'tickets';
    
    public function getTickets()
    {
        return $this->findAll();
    }

    public function getTicketsByStatus($status)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tickets');
        $builder->where('status', $status);
        $tickets = $builder->get();

        //var_dump($this->findAll());
        return $tickets->getResultArray();
        
        //return $tickets;
    }

    public function getTicketById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tickets');
        $builder->where('id', $id);
        $ticket = $builder->get();

        return $ticket->getResultArray();
	}

    public function changeStatus($id, $status_type) {
        $db = \Config\Database::connect();
        $builder = $db->table('tickets');
        $data = [
            'status' => $status_type,
            'doer'   => $_SESSION['login']
        ];

        $builder->where('id', $id);
        $builder->update($data);
        
    }

    public function auth($login, $pass) {
        $secretWord = 'GloryToUkraine!';
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('login', $login);
        $user = $builder->get();
        foreach ($user->getResult() as $row) {
            if (md5($pass) == $row->password && sha1(md5($pass)) == $row->hash) {
                $builder = $db->table('sessions');
                $builder->where('login', $login);
                $builder->delete();
                $secret_key = sha1($login . sha1(md5($pass)) . $secretWord);
                $data = [
                    'login'      => $login,
                    'user_id'    => $row->id,
                    'ip'         => $_SERVER['REMOTE_ADDR'],
                    'secret_key' => $secret_key
                ];
                $builder->insert($data);
                session_start();
                $_SESSION["is_auth"] = true;
                $_SESSION["secret_key"] = $secret_key;
                $_SESSION["login"] = $login;

                return true;
            }
        }
        //print_r($user);
    }

    public function checkLogin($key, $login) {
        $db = \Config\Database::connect();
        $builder = $db->table('sessions');
        $builder->where('secret_key', $key);
        $check = $builder->get();
        foreach ($check->getResult() as $row) {
            if ($login == $row->login) {
                return true;
            } else {
                return false;
            }
        }
    }
	
	public function getSetting($name) {
		$db = \Config\Database::connect();
        $builder = $db->table('settings');
        $builder->where('name', $name);
		$setting = $builder->get();
		
		return $setting->getResult();
	}
	
	public function getProblems() {
		$db = \Config\Database::connect();
        $builder = $db->table('problems');
		$problems = $builder->get();
		
		return $problems->getResultArray();
	}
	
	public function getChecklist($id) {
		$db = \Config\Database::connect();
        $builder = $db->table('check_list');
		$builder->where('problem_id', $id);
		$list = $builder->get();
		
		return $list->getResultArray();
	}
	
	public function get_users() {
		$db = \Config\Database::connect();
        $builder = $db->table('users');
		$users = $builder->get();
		
		return $users->getResult();
	}
	
	public function updateSettings($name, $value) {
		$db = \Config\Database::connect();
        $builder = $db->table('settings');
        $data = [
            'value'  => $value
        ];

        $builder->where('name', $name);
        $builder->update($data);
	}
	
	public function addProblems($value) {
		$db = \Config\Database::connect();
        $builder = $db->table('problems');
		
        $data = [
            'name'      => $value
        ];
		
        $builder->insert($data);
	}
	
	
    public function addUser($data) {
		$secretWord = 'GloryToUkraine!';
        $db = \Config\Database::connect();
        $builder = $db->table('users');
		
		$password = md5($data['pass']);
		$hash = sha1($password);
		
        $data = [
            'login'     => $data['login'],
            'password'  => $password,
			'hash'      => $hash
        ];
		
        $builder->insert($data);
        
    }
}

?>