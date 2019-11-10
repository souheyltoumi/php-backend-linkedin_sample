<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['text']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $user = $_POST['login'];
          $text = $_POST['text'];
          $date = date("D M d, Y G:i");

          		  	$req1 = $conn->prepare('SELECT  id AS nb FROM user WHERE  login=? ');
					$req1->execute(array($user));
					$donnees = $req1->fetch();
					$nb=$donnees['nb'];

		  if($user!=""&&$text!=""){

	
		  	$req = $conn->prepare('INSERT INTO post (`id_user`, `text`, `time`) VALUES (?,?,?)');
            $req->execute(array($nb,$text,$date));
			$result="SUCCES";
	        
			echo $result;
		  }else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	  
	
?>