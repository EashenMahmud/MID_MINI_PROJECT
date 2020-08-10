<?php
    
    include("connection.php");
    session_start();
	
	if(isset($_POST['submit'])){

		$username = $_POST['userName'];
		$password = $_POST['password'];
		
		if($username == "" || $password == "" ){
            header('location: login.html?msg=All fields are required');
		}else{
			
			$sql = "select * from userLogin where id='".$username."' and password='".$password."'";


			$result = mysqli_query($connection, $sql);
			$row = mysqli_fetch_assoc($result);


			if(count($row) > 0){

                $userName = $row['ID'];
                $name = $row['Name'];
                $email = $row['Email'];
                $userType = $row['Type'];

                

                setcookie('STATUS', 'OK', time()+3600, '/');
                
				setcookie('name', $name, time()+3600, '/');
                setcookie('email', $email, time()+3600, '/');
                
               

                if($userType == "user")
                {
                     $_SESSION['status'] = "OK";
                     
				     header('location: UserHome.html');

                }
                if($userType == "admin")
                {
                    $_SESSION['status'] = "OK";
                    header('location: AdminHome.html');

                }

				
				
				
			}else{
                echo " Invalid username or password";
               
			}
		}	

	}else{
		echo "invalid request";
		
	}