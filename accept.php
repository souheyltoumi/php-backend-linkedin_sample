<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if( $_POST['id'] &&  $_POST['login1'])
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $id = $_POST['id'];
		  $login1 = $_POST['login1'];
          
		  
		$req0 = $conn->prepare('SELECT  id AS n1 FROM user WHERE  login=?  ');
			$req0->execute(array($login1));
			$donnees0 = $req0->fetch();
			$n1=$donnees0['n1'];
			
   		 
			$req3 = $conn->prepare('SELECT  nom AS name FROM user WHERE  id=?  ');
			$req3->execute(array($n1));
			$donnees3 = $req3->fetch();
			$name1=$donnees3['name'];
			$notif=$name1." has accepted your offer";





		  if($login1!=""&&$id!=""){
		  
		  	$req = $conn->prepare('SELECT  COUNT(*) AS nb FROM notif WHERE  notif_type=?  ');
			$req->execute(array($notif));
			$donnees = $req->fetch();
			$nb=$donnees['nb'];
			if($nb==0){
			
		  	$req = $conn->prepare('INSERT INTO notif (`id_1`, `id_2`, `notif_type`) VALUES (?,?,?)');
            $req->execute(array($n1,$id,$notif));
			$result="SUCCES";
		
	        
	 
	 
}else{
	$result="already done";
	
}
echo $result;
		  }else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	  
	
?>