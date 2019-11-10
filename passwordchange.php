<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['pass1']))
     {


     	  $result='';
	   	  $pass1 = $_POST['pass1'];
	   	  $pass2 = $_POST['pass2'];
	   	  $pass3 = $_POST['pass3'];

		  $login = $_POST['login'];
		 $req = $conn->prepare('SELECT  pass AS password FROM user WHERE  login=? ');
		  $req->execute(array($login));
		  $donnees = $req->fetch();
		  $password=$donnees['password'];
		  if($pass2!=$pass3)
		  {
		  	$result="verify the confirmation of password";
		  	echo $result;
		  }else
		  {
		 
		 
		  // Innitialize Variable
		
          		  	

		  if($pass1!=""&&$login!=""){


		  	if($pass1=$password){
		  		$pass2=password_hash($pass2, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);


	
		  	$req = $conn->prepare('UPDATE `user` SET `pass`=? WHERE `login`=?');
            $req->execute(array($pass2,$login));
			$result="SUCCES";
	        
			echo $result;
		}
		else{
			$result="wrong password entry";
			echo $result ;
		}
		  }else{
			  $result="Une erreur s'est produite. Veuillez réessayer plus tard.";
			  echo $result;
			  
		  }}
	 }	  
	
?>