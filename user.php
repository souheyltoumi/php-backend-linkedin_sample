
<?php


// connexion a la base du donnée 
 include 'config.inc.php';
 
 
 if(isset($_POST['id'])){
 
 //initiation des variables 
$user = array();
$login=$_POST['id'];


// recherche des etablissements selon le type 
 // creation du requette 
 $req1 = $conn->prepare('SELECT * FROM user WHERE id=? ');
 
 // execution de requette 
  $req1->execute(array($login));

 while ($donnees1 = $req1->fetch(PDO::FETCH_ASSOC)){
	$temp1['Id']=$donnees1['id'];
	$temp1['Nom']=$donnees1['nom'];
	$temp1['prenom']=$donnees1['prenom'];
	$temp1['login']=$donnees1['login'];
	$temp1['num']=$donnees1['num'];
	$temp1['job']=$donnees1['job'];
	$temp1['image']=$donnees1['image'];

	
	array_push($user,$temp1);
}

echo json_encode(array("userinfo"=>$user),JSON_UNESCAPED_UNICODE);
	
 }
?>