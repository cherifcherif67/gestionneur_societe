<?php
function deleteCommercial($input)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('DELETE FROM commercial WHERE idComm= ?');
	$reponse->execute(array($input));
}
function updateCommercial($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('UPDATE commercial SET date_pub= ?, lib_proj=?, Clt_comm=?, Hexonore__comm=?, mode_paie=?, caution=?, visite=?, devis=?, Avance=? , participant=? , Mnt_prop=? , type_paie=? WHERE idComm = ?') ;
	$reponse->execute($list);
}
function checkCommercial($input)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('UPDATE commercial SET etat= 1 WHERE idComm = ?') ;
	$reponse->execute($input);
}
function addCommercial($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare("INSERT INTO commercial (date_pub,lib_proj,Clt_comm,Hexonore__comm,mode_paie,caution,visite,devis,Avance, participant,Mnt_prop,type_paie,etat) VALUES (? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
		$reponse->execute($list);
}