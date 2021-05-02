<?php 

 function deleteClient($input)
{	
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('DELETE FROM client WHERE id= ?');
	$reponse->execute(array($input));
}
function updateClient($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('UPDATE client SET nom= ?, Hexonore=? WHERE id= ?') ;
	$reponse->execute($list);
}
function addClient($list)
{	
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare("INSERT INTO client (nom, Hexonore) VALUES (? , ?)");
	$reponse->execute($list);
}
function getLastClient()
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse = $db->query("SELECT * FROM client ORDER BY id DESC LIMIT 1");
	while ($donnees=$reponse->fetch()){
		return $donnees['id'] ;
	}

}