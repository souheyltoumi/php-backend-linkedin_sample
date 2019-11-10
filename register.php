<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['email']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $password = $_POST['password'];
		  $email = $_POST['email'];
          $nom = $_POST['nom'];
		  $prenom = $_POST['prenom'];
		  $num = $_POST['num'];
		  $cin = $_POST['cin'];
		  
		$image=$_POST['image'];
   		 


		  $password=password_hash($password, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);

		  if($email!=""&&$nom!=""&&$password!=""&&$prenom!=""){
		  
		  	$req = $conn->prepare('SELECT  COUNT(*) AS nb FROM user WHERE  login=?  ');
$req->execute(array($email));
$donnees = $req->fetch();
$nb=$donnees['nb'];
if($nb==0){

			$target_dir="data/users/avatars";

			if(!file_exists($target_dir)){
			mkdir($target_dir,0777,true);
			}
			$target_dir=$target_dir ."/".rand()."_".time().".jpeg";*/


			if(file_put_contents($target_dir,base64_decode($image))){
		  	$req = $conn->prepare('INSERT INTO user (`nom`, `prenom`, `login`, `pass`,`num`,`job`,`image`) VALUES (?,?,?,?,?,?,?)');
            $req->execute(array($nom,$prenom,$email,$password,$num,$cin,$target_dir));
			$result="SUCCES";
		}
	        
	 
	 
}else{
	$result="E-mail déjà utilisé";
	
}
echo $result;
		  }else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	  
	
?>