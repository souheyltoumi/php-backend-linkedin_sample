<?php
 include 'config.inc.php';
 	$id=$_POST['login'];
   if(!isset($_POST['image'])||strlen($_POST['image'])==0){
	$resultat="Vous devez choisir une image !";
	echo $resultat;

	}else{
	
	
	$image=$_POST['image'];
    $target_dir="data/users/avatars";

if(!file_exists($target_dir)){
mkdir($target_dir,0777,true);
}

$target_dir=$target_dir ."/".rand()."_".time().".jpeg";
if(file_put_contents($target_dir,base64_decode($image))){
	$req = $conn->prepare('UPDATE `user` SET `image`=? WHERE login=?');
    $req->execute(array($target_dir,$id));
 $resultat="ok";

}
else{
	$resultat="Une erreur s'est produite. Veuillez réessayer plus tard.";

}
echo $resultat;
}

?>