<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['message']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  
		  $login = $_POST['login'];
          $message = $_POST['message'];
		  $ref = $_POST['ref'];
	
		  
		



		  if($login!=""&&$message!=""&&$ref!=""){
		  
		  	

			
		  	$req = $conn->prepare('INSERT INTO message (`text`, `sender`, `ref`) VALUES (?,?,?)');
            $req->execute(array($message,$login,$ref));
            $date = date("D M d, Y G:i");
            $req = $conn->prepare('UPDATE `discussion` SET `last_msg`=	? ,`time`=? WHERE id= ?');
            $req->execute(array($message,$date,$ref));

			$result="SUCCES";
			echo $result;

		
	        
	 
	 

	
}
		  else{
			  $result="Verifier  champs";
			  echo $result;
			  
		  }
	 }	  
	
?>