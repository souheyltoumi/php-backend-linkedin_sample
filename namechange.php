<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['name'])&&isset($_POST['prename']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $name = $_POST['name'];
	   	  	   	  $prename = $_POST['prename'];

		  $login = $_POST['login'];
          		  	

		  if($name!=""&&$prename!=""&&$login!=""){

	
		  	$req = $conn->prepare('UPDATE `user` SET `nom`=? , `prenom`=? WHERE `login`=?');
            $req->execute(array($name,$prename,$login));
			$result="SUCCES";
	        
			echo $result;
		  }else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	  
	
?>