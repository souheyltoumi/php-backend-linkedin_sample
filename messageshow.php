
<?php


// connexion a la base du donnée 
 include 'config.inc.php';
  
 //initiation des variables 
$messages = array();
$ref=$_POST['ref'];


// recherche des etablissements selon le type 
 // creation du requette 
 $req1 = $conn->prepare('SELECT * FROM message WHERE  ref=? ORDER BY id DESC');

 
 // execution de requette 
 $req1->execute(array($ref));

 while ($donnees1 = $req1->fetch(PDO::FETCH_ASSOC)){
	$temp1['Id']=$donnees1['id'];
	//$temp1['id_user']=$donnees1['id_user'];
	$temp1['text']=$donnees1['text'];
	$temp1['sender']=$donnees1['sender'];
	$req = $conn->prepare('SELECT  image AS image FROM user WHERE  login=? ');
		  $req->execute(array($donnees1['sender']));
		  $donnees = $req->fetch();
		  $image=$donnees['image'];
		  		$temp1['image']=$image;

	

		
		$temp1['ref']=$donnees1['ref'];


	
	array_push($messages,$temp1);
}

echo json_encode(array("messages"=>$messages),JSON_UNESCAPED_UNICODE);
	

?>