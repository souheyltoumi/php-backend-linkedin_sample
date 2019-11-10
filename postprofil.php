
<?php


// connexion a la base du donnée 
 include 'config.inc.php';
  
 //initiation des variables 
		$posts = array();
		$login = $_POST['login'];




// recherche des etablissements selon le type 
 // creation du requette 
		   $req0 = $conn->prepare('SELECT id AS nb FROM user  WHERE  login=?');
		   $req0->execute(array($login));
	$donnees0 = $req0->fetch();
	$nb=$donnees0['nb'];

 $req1 = $conn->prepare('SELECT * FROM post WHERE  id_user=? ORDER BY id DESC');

 
 // execution de requette 
 $req1->execute(array($nb));

 while ($donnees1 = $req1->fetch(PDO::FETCH_ASSOC)){
	$temp1['Id']=$donnees1['id'];
	//$temp1['id_user']=$donnees1['id_user'];
	$temp1['text']=$donnees1['text'];
	$temp1['time']=$donnees1['time'];
	$req = $conn->prepare('SELECT  nom  AS nom FROM user WHERE  id=? ');
		$req->execute(array($donnees1['id_user']));
		$donnees = $req->fetch();
		$req = $conn->prepare('SELECT  prenom  AS prenom FROM user WHERE  id=? ');
		$req->execute(array($donnees1['id_user']));
				$donnees2 = $req->fetch();

		$req = $conn->prepare('SELECT  image  AS image FROM user WHERE  id=? ');
		$req->execute(array($donnees1['id_user']));
				$donnees3 = $req->fetch();

		$temp1['nom']=$donnees['nom'];
		$temp1['prenom']=$donnees2['prenom'];
	$temp1['image']=$donnees3['image'];

	
	array_push($posts,$temp1);
}

echo json_encode(array("posts"=>$posts),JSON_UNESCAPED_UNICODE);
	

?>