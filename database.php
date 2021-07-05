<?php

class database {

	private $dbh;

	public function __construct(){
		try {
			$dsn = "mysql:host=localhost;dbname=examenoefeningjonathan;charset=utf8";
			$this->dbh = new PDO($dsn, 'root', '');
			// echo "Database connectie gemaakt ";			
		} catch (\PDOException $exception) {
			exit('Database connectie gefaald. Error message: ' . $exception->getMessage());
		}
	}

	//<-------------------------(inserts)------------------------->

	public function insert_usertypes(){
		$sql = "INSERT IGNORE INTO usertypes VALUES 
		(:id, :type, :created_at, :updated_at),
		(:id2, :type2, :created_at2, :updated_at2)";
		$statement = $this->dbh->prepare($sql);
		$statement->execute([
		'id' => '1',
		'type' => "admin",
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),

		'id2' => '2',
		'type2' => "user",
		'created_at2' => date('Y-m-d H:i:s'),
		'updated_at2' => date('Y-m-d H:i:s'),
		]); 
	}

	public function insert_users(){
		$hashed_password = password_hash('default', PASSWORD_DEFAULT);
		$sql = "INSERT IGNORE INTO users VALUES 
		(NULL, :usertypes_id, :email, :username, :password, :created_at, :updated_at),
		(NULL, :usertypes_id2, :email2, :username2, :password2, :created_at2, :updated_at2)";
		$statement = $this->dbh->prepare($sql);
		$statement->execute([
		'usertypes_id' => '1',
		'email' => 'defaultadmin@gmail.com',
		'username' => 'defaultadmin',
		'password' => $hashed_password,
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),

		'usertypes_id2' => '2',
		'email2' => 'defaultuser@gmail.com',
		'username2' => 'defaultuser',
		'password2' => $hashed_password,
		'created_at2' => date('Y-m-d H:i:s'),
		'updated_at2' => date('Y-m-d H:i:s'),
		]);
	}

	//<-------------------------(inserts-end)------------------------->

	//<-------------------------(signup-login)------------------------->

	public function login($email, $wachtwoord){
		$sql = "SELECT * FROM gebruiker WHERE email = :email";

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute(['email'=>$email]);
     
        $result = $stmt->fetch();

        $hashed_password = $result['wachtwoord'];
            
        if ($email && password_verify($wachtwoord, $hashed_password)) {

            session_start();
            // save userdata in session variables
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['voornaam'] = $result['voornaam'];
            $_SESSION['achternaam'] = $result['achternaam'];
            $_SESSION['is_admin'] = $result['is_admin'];
            $_SESSION['loggedin'] = true;

			header("refresh:3;url=welcome.php");
            return '<h3 class=succes>Login succesful</h3>';     
        }else{
        	return "<h3 class=error>Incorrect username and/or password. Please fix your input and try again.</h3>";
        }
	        
	}

	public function signup_user($voornaam, $achternaam, $email, $wachtwoord){

		$hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
		$sql = "INSERT IGNORE INTO gebruiker VALUES (NULL, :voornaam, :achternaam, :email, :wachtwoord, :is_admin, :created_at, :updated_at)";
		$statement = $this->dbh->prepare($sql);
		$statement->execute([
		'voornaam' => $voornaam,
		'achternaam' => $achternaam,
		'email' => $email,
		'wachtwoord' => $hashed_password,
		'is_admin' => FALSE,
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s')
		]); 
	}

	//<-------------------------(signup-login-end)------------------------->

	public function select($statement, $named_placeholder){

        // prepared statement (send statement to server  + checks syntax)
        $statement = $this->dbh->prepare($statement);

        $statement->execute($named_placeholder);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        var_dump($result);

    }

    //<-------------------------(feed)------------------------->

    public function insert_image($id, $filename){

			// $sql = "UPDATE image SET Filename = :Filename WHERE id = :id";
			$sql = "INSERT IGNORE INTO post VALUES (NULL, :inhoud, :poster_id, NULL, :created_at, :updated_at)";
			$statement = $this->dbh->prepare($sql);
			$statement->execute([
			'inhoud' => $filename,
			'poster_id' => $id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
			echo '<script language="javascript">';
				echo 'alert("Gegevens updated")';
				echo '</script>';
			header("refresh:1");

	}

	//<-------------------------(feed-end)------------------------->

	//<-------------------------(deletes)------------------------->

	public function delete_post($id){
		$sql = "DELETE FROM post WHERE id = :id ";

		$stmt = $this->dbh->prepare($sql);
		$stmt->execute($id);
		header("refresh:0;user_page.php");
		}

	//<-------------------------(deletes-end)------------------------->

	public function decline_vriend($vriend_A, $vriend_B){
		$sql = "DELETE FROM vrienden WHERE vriend_A = :vriend_A AND vriend_B = :vriend_B";

		$stmt = $this->dbh->prepare($sql);
		$stmt->execute([
		'vriend_A' => $vriend_A, 
		'vriend_B' => $vriend_B
		]);
		header("refresh:0;");
		}

		public function accept_vriend($vriend_A, $vriend_B){
		$sql = "UPDATE vrienden SET is_bevestigd = :is_bevestigd WHERE vriend_A = :vriend_A AND vriend_B = :vriend_B";

		$statement = $this->dbh->prepare($sql);
		$statement->execute([
		'vriend_A' => $vriend_A, 
		'vriend_B' => $vriend_B,
		'is_bevestigd' => TRUE
		]);
		}
		
}


?>