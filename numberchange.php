<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['number']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $number = $_POST['number'];
		  $login = $_POST['login'];
          		  	

		  if($number!=""&&$login!=""){

	
		  	$req = $conn->prepare('UPDATE `user` SET `num`=? WHERE `login`=?');
            $req->execute(array($number,$login));
			$result="SUCCES";
	        
			echo $result;
		  }else{
			  $result="Une erreur s'est produite. Veuillez réessayer plus tard.";
			  echo $result;
			  
		  }
	 }	  
	
?>