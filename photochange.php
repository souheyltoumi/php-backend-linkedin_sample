<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['image']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $image = $_POST['image'];
		  $login = $_POST['login'];
		  $req = $conn->prepare('SELECT  image AS target FROM user WHERE  login=? ');
		  $req->execute(array($login));
		  $donnees = $req->fetch();
		  $target=$donnees['target'];
    $target_dir="data/users/avatars";
    $target_dir=$target_dir ."/".rand()."_".time().".jpeg";

          		  	

		  if($image!=""&&$login!=""){
		  	if(file_put_contents($target_dir,base64_decode($image))&& unlink($target)){
	$req = $conn->prepare('UPDATE `user` SET `image`=? WHERE login=?');
    $req->execute(array($target_dir,$login));
    
 	$result="SUCCES";
 	echo $result;

}
else{
	$resultat="Une erreur s'est produite. Veuillez réessayer plus tard.";
	        
			echo $result;
		  	}}else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	  
	
?>