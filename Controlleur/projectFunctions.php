<?php 
function deleteProject($input)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('DELETE FROM projet WHERE idProj= ?');
	$reponse->execute(array($input));
}
function updateProject($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('UPDATE projet SET nomProj= ?, Mnt_Proj=?, Avance_Proj=?, RG_Proj=?, Mode_paie_Proj=?, delai_Proj=?, penalite_Proj=?, date_Deb_Proj=?, idClt=? , date_fin_proj=? WHERE idProj = ?') ;
	$reponse->execute($list);	
}
function addProject($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare("INSERT INTO projet (nomProj,Mnt_Proj,Avance_Proj,RG_Proj,Mode_paie_Proj,delai_Proj,penalite_Proj,date_Deb_Proj,idClt, date_fin_proj) VALUES (? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$reponse->execute($list);
}
function getIdProjectWithIdClient($input){
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $reponse=$db->prepare("SELECT * FROM projet where idClt =? "); 
    $reponse->execute(array($input));
    $listProjets = array();
    while ($donnees=$reponse->fetch()) {
    	array_push($listProjets, $donnees['idProj']); 
    }
    return $listProjets ;
}