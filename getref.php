<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['login']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  $login = $_POST['login'];
          $login1 = $_POST['login1'];

          		  	$req1 = $conn->prepare('SELECT  id AS nb FROM user WHERE  login=? ');
					$req1->execute(array($login));
					$donnees = $req1->fetch();
					$n1=$donnees['nb'];
					$req2 = $conn->prepare('SELECT  id AS nb2 FROM user WHERE  login=? ');
					$req2->execute(array($login1));
					$donnees2 = $req2->fetch();
					$n2=$donnees2['nb2'];

		  if($login1!=""&&$login!=""){

		  	$req = $conn->prepare('SELECT  COUNT(*) AS n FROM discussion WHERE ( (id_1=? AND id_2=?) OR (id_1=? AND id_2 =?))');
            $req->execute(array($n1,$n2,$n2,$n1));
            $donnees5 = $req->fetch();
					$n=$donnees5['n'];
					if($n==0)
					{
						echo 0;
					}

					else{
	
		  	$req = $conn->prepare('SELECT  id AS n FROM discussion WHERE ( (id_1=? AND id_2=?) OR (id_1=? AND id_2 =?))');
            $req->execute(array($n1,$n2,$n2,$n1));
            $donnees5 = $req->fetch();
			$result=$donnees5['n'];
	        
			echo $result;
		}
		  }else{
			  $result="Verifier les champs";
			  echo $result;
			  
		  }
	 }	  
	
?>