<?php

     include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['login']))
     {
		 
		 
		 
		  // Innitialize Variable
		  $result='';
	   	  
		  $login = $_POST['login'];
          $message = $_POST['message'];
		  $login1 = $_POST['login1'];
		  $req0 = $conn->prepare('SELECT  id  AS n FROM user WHERE  login=? ');
		$req0->execute(array($login));
				$donnees0 = $req0->fetch();
				$n1=$donnees0['n'];
				$req1 = $conn->prepare('SELECT  id  AS n FROM user WHERE  login=? ');
		$req1->execute(array($login1));
				$donnees1 = $req1->fetch();
				$n2=$donnees1['n'];
				$req = $conn->prepare('SELECT  COUNT(*) AS n FROM discussion WHERE ( (id_1=? AND id_2=?) OR (id_1=? AND id_2 =?))');
            $req->execute(array($n1,$n2,$n2,$n1));
            $donnees5 = $req->fetch();
					$n=$donnees5['n'];
					if($n==0)
					{
						 $date = date("D M d,Y G:i");

						$req = $conn->prepare('INSERT INTO discussion (`id_1`, `id_2`, `last_msg`, `time`) VALUES (?,?,?,?)');
           				 $req->execute(array($n1,$n2,$message,$date));
            			$req1 = $conn->prepare('SELECT  id  AS ref FROM discussion WHERE ( (id_1=? AND id_2=?)OR (id_1=? AND id_2 =?)) ');
						$req1->execute(array($n1,$n2,$n2,$n1));
						$donnees1 = $req1->fetch();
						$ref=$donnees1['ref'];
						$req2 = $conn->prepare('INSERT INTO message (`text`, `sender`, `ref`) VALUES (?,?,?)');
            			$req2->execute(array($message,$login,$ref));
            			$result="SUCCES";
						echo $result;
						







					}





	
		  
		



		  else {


		  	if($login!=""&&$message!=""){
		  		$req1 = $conn->prepare('SELECT  id  AS ref FROM discussion WHERE ( (id_1=? AND id_2=?)OR (id_1=? AND id_2 =?)) ');
						$req1->execute(array($n1,$n2,$n2,$n1));
						$donnees1 = $req1->fetch();
						$ref=$donnees1['ref'];
		  
		  	

			
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
			  
		  }}
		  
	 }	  
	
?>