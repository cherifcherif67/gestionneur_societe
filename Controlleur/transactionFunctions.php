<?php 
function deleteTransaction($input)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('DELETE FROM transaction WHERE idTrans= ?');
	$reponse->execute(array($input));
}
function updateTransaction($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare('UPDATE transaction SET Benicifiaire= ?, nature_trans=?, AFF_trans=?, Mnt_HT=?, Avance_trans=?, AvanceRG_trans=?, R_source=?, Type_paie_trans=?, Echeance=?, Date_trans=? , idProj=?,num_doc=? WHERE idTrans = ?') ;
	$reponse->execute($list);	
}
function addTransaction($list)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
	$reponse=$db->prepare("INSERT INTO transaction (Benicifiaire,nature_trans,AFF_trans,Mnt_HT,Avance_trans,AvanceRG_trans,R_source,Type_paie_trans,Echeance,Date_trans,idProj,num_doc) VALUES (? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$reponse->execute($list);
}
function getIdTransactionWithIdProject($input)
{
	$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $reponse=$db->prepare("SELECT * FROM transaction WHERE idProj = ? "); 
    $reponse->execute(array($input));
    $listTransactions = array();
    while ($donnees=$reponse->fetch()) {
    	array_push($listTransactions, $donnees['idTrans']); 
    }
    return $listTransactions ;
}