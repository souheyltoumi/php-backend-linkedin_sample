<?php

     include 'config.inc.php';
	 
	
	 // Check whether username or password is set from android	
     if(isset($_POST['login']) && isset($_POST['pass'])  )
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $password = $_POST['pass'];
		  $email = $_POST['login'];
		  
         
		  
		  if($password!=""&&$email!=""){
		  
		  	$req = $conn->prepare('SELECT  COUNT(*) AS nb FROM user WHERE  login=? ');
$req->execute(array($email));
$donnees = $req->fetch();
$nb=$donnees['nb'];
if($nb==1){
			$req = $conn->prepare('SELECT  pass AS n FROM user WHERE  login=? ');
			$req->execute(array($email));
			$donnees = $req->fetch();
			$n=$donnees['n'];
			if(password_verify($password,$n))
			{
				$result="SUCCES";
			}
			else
			{
				$result="wrong password";
			}

	
			
	        
	 
	 
}else{
	$result="user nexiste pas";
	
}
echo $result;
		  }else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	
	
?>