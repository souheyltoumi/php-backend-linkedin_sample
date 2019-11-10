
<?php


// connexion a la base du donnée 
 include 'config.inc.php';
  
 //initiation des variables 
$Notifs = array();

$login =$_POST['login'];
$req0 = $conn->prepare('SELECT  id  AS n FROM user WHERE  login=? ');
		$req0->execute(array($login));
				$donnees0 = $req0->fetch();
				$n=$donnees0['n'];

// recherche des etablissements selon le type 
 // creation du requette 
 $req1 = $conn->prepare('SELECT * FROM notif WHERE  id_2=? ORDER BY id DESC');

 
 // execution de requette 
 $req1->execute(array($n));

 while ($donnees1 = $req1->fetch(PDO::FETCH_ASSOC)){
	$temp1['Id']=$donnees1['id'];
	//$temp1['id_user']=$donnees1['id_user'];
	$temp1['notif_type']=$donnees1['notif_type'];
	$req2 = $conn->prepare('SELECT  nom  AS n FROM user WHERE  id=? ');
		$req2->execute(array($donnees1['id_1']));
		$donnees5 = $req2->fetch();
		$name=$donnees5['n'];
		$temp1['id_1']=$donnees5['n'];
		$temp1['id_2']=$donnees1['id_2'];


	
		$req = $conn->prepare('SELECT  image  AS image FROM user WHERE  id=? ');
		$req->execute(array($donnees1['id_1']));
		$donnees3 = $req->fetch();
	$temp1['image']=$donnees3['image'];
		$temp1['user1_id']=$donnees1['id_1'];


	
	array_push($Notifs,$temp1);
}

echo json_encode(array("notifs"=>$Notifs),JSON_UNESCAPED_UNICODE);
	

?>