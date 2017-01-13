<?php 
	require_once('dbconfig.php');

	
	class OWNER
	{
	    private $conn;

	    public function __construct()
	    {
	    	$database 	= new Database();
	    	$db 		= $database->dbConnection();
	    	$this->conn = $db;
	    }

	    public function runQuery($sql)
	    {
	    	$stmt	= $this->conn->prepare($sql);
	    	return $stmt;
	    }

	    public function saveRenter($fname, $gender, $father, $mother, $phone, $address, $irole, $iowner, $iroom)
	    {
	    	try {
	    		$stmt = $this->conn->prepare(
	    				"INSERT INTO tbl_renter(fullname,gender,father,mother,phone,address,id_role,id_owner,id_room)
	    				VALUES(:fname,:gender,:father,:mother,:phone,:address,:irole,:iowner,:iroom)"
	    			);
	    		$stmt->bindparam(":fname", $fname);
	    		$stmt->bindparam(":gender", $gender);
	    		$stmt->bindparam(":father", $father);
	    		$stmt->bindparam(":mother", $mother);
	    		$stmt->bindparam(":phone", $phone);
	    		$stmt->bindparam(":address", $address);
	    		$stmt->bindparam(":irole", $irole);
	    		$stmt->bindparam(":iowner", $iowner);
	    		$stmt->bindparam(":iroom", $iroom);
	    		$stmt->execute();

	    		return $stmt;
	    	} catch (PDOException $e) {
	    		$e->getMessage();
	    	}
	    }

	    public function updateRenter($fname, $gender, $father, $mother, $phone, $address, $irole, $iowner, $iroom, $irenter)
	    {
	    	try {
	    		$stmt = $this->conn->prepare(
	    				"UPDATE tbl_renter
	    				SET fullname=:fname,
	    				gender=:gender,
	    				father=:father,
	    				mother=:mother,
	    				phone=:phone,
	    				address=:address,
	    				id_role=:irole,
	    				id_owner=:iowner,
	    				id_room=:iroom
	    				WHERE id_renter=:irenter"
	    			);

	    		$stmt->bindParam(':fname', $fname);
	    		$stmt->bindParam(':gender', $gender);
	    		$stmt->bindParam(':father', $father);
	    		$stmt->bindParam(':mother', $mother);
	    		$stmt->bindParam(':phone', $phone);
	    		$stmt->bindParam(':address', $address);
	    		$stmt->bindParam(':irole', $irole);
	    		$stmt->bindParam(':iowner', $iowner);
	    		$stmt->bindParam(':iroom', $iroom);
	    		$stmt->bindParam(':irenter', $irenter);
	    		$stmt->execute();

	    		return $stmt;
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function saveRoom($owner, $rname, $iclass, $status, $photo)
	    {
	    	try {
	    		$stmt = $this->conn->prepare(
	    				"INSERT INTO tbl_rooms(id_owner,room_name,id_class,status,photo)
	    				VALUES(:owner,:rname,:iclass,:status,:photo)"
	    			);
	    		$stmt->bindparam(":owner", $owner);
	    		$stmt->bindparam(":rname", $rname);
	    		$stmt->bindparam(":iclass", $iclass);
	    		$stmt->bindparam(":status", $status);
	    		$stmt->bindparam(":photo", $photo);
	    		$stmt->execute();

	    		return $stmt;
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function updateRoom($owner, $rname, $iclass, $status, $photo, $iroom)
	    {
	    	try {
	    		$stmt = $this->conn->prepare(
	    				"UPDATE tbl_rooms
	    				SET id_owner=:owner,
	    					room_name=:rname,
	    					id_class=:iclass,
	    					status=:status,
	    					photo=:photo
	    				WHERE id_room=:iroom"
	    			);

	    		$stmt->bindParam(':owner', $owner);
	    		$stmt->bindParam(':rname', $rname);
	    		$stmt->bindParam(':iclass', $iclass);
	    		$stmt->bindParam(':status', $status);
	    		$stmt->bindParam(':photo', $photo);
	    		$stmt->bindParam(':iroom', $iroom);
	    		$stmt->execute();
	    		return $stmt;
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function saveClass($owner, $cname, $price)
	    {
	    	try {
	    		$stmt = $this->conn->prepare(
	    				"INSERT INTO tbl_class(id_owner,class_name,price)
	    				VALUES(:owner,:cname,:price)"
	    			);
	    		$stmt->bindparam(":owner", $owner);
	    		$stmt->bindparam(":cname", $cname);
	    		$stmt->bindparam(":price", $price);
	    		$stmt->execute();

	    		return $stmt;
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function updateClass($owner, $cname, $price, $id_class)
	    {
	    	try {
	    		$stmt = $this->conn->prepare(
	    				"UPDATE tbl_class
	    				SET id_owner=:owner,
	    					class_name=:cname,
	    					price=:price
	    				WHERE id_class=:id_class"
	    			);

	    		$stmt->bindParam(':owner', $owner);
	    		$stmt->bindParam(':cname', $cname);
	    		$stmt->bindParam(':price', $price);
	    		$stmt->bindParam(':id_class', $id_class);
	    		$stmt->execute();

	    		return $stmt;
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function register($uname, $upass, $umail, $ufname, $gender, $phone, $address, $role)
	    {
	    	try {
	    		$new_password = password_hash($upass, PASSWORD_DEFAULT);
	    		$stmt = $this->conn->prepare(
	    			"INSERT INTO tbl_owner(username,password,email,fullname,gender,phone,address,id_role)
	    				VALUES(:uname,:pass,:email,:name,:gender,:phone,:address,:role)"
	    			);

	    		$stmt->bindparam(":uname", $uname);
	    		$stmt->bindparam(":pass", $new_password);
	    		$stmt->bindparam(":email", $umail);
	    		$stmt->bindparam(":name", $ufname);
	    		$stmt->bindparam(":gender", $gender);
	    		$stmt->bindparam(":phone", $phone);
	    		$stmt->bindparam(":address", $address);
	    		$stmt->bindparam(":role", $role);

	    		$stmt->execute();

	    		return $stmt;
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function doLogin($uname,$umail,$upass)
	    {
	    	try {
	    		$stmt = $this->conn->prepare("SELECT id_owner, username, email,	password FROM tbl_owner WHERE username=:uname OR email=:umail");
	    		$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
	    		$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	    		if ($stmt->rowCount() == 1) {
	    			if (password_verify($upass, $ownerRow['password'])) {
	    				$_SESSION['user_session'] = $ownerRow['id_owner'];
	    				return true;
	    			} else {
	    				return false;
	    			}
	    		}
	    	} catch (PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function is_loggedin()
	    {
	    	if (isset($_SESSION['user_session'])) {
	    		return true;
	    	}
	    }

	    public function redirect($url)
	    {
	    	header("Location: $url");
	    }

	    public function doLogout()
	    {
	    	session_destroy();
	    	unset($_SESSION['user_session']);
	    	return true;
	    }
	}
 ?>