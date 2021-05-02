<?php
session_start();
include("transactionFunctions.php");
$db =new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
if((isset($_GET['action']))=='delete'){
	deleteTransaction($_GET['id']);
	header('Location: http://localhost/STAGE/template/transactionFront.php');
}
if ((isset($_POST['Benicifiaire']))){
	updateTransaction(array($_POST['Benicifiaire'],$_POST['nature_trans'],$_POST['AFF_trans'],$_POST['Mnt_HT'],$_POST['Avance_trans'],$_POST['AvanceRG_trans'],$_POST['R_source'],$_POST['Type_paie_trans'],$_POST['Echeance'],$_POST['Date_trans'],$_POST['idProj'],$_POST['num_doc'],$_POST['idTrans']));
	
	header('Location: http://localhost/STAGE/template/transactionFront.php');
}
if(isset($_POST['AddBenicifiaire'])){
	addTransaction(array($_POST['AddBenicifiaire'],$_POST['nature_trans'],$_POST['AFF_trans'],$_POST['Mnt_HT'],$_POST['Avance_trans'],$_POST['AvanceRG_trans'],$_POST['R_source'],$_POST['Type_paie_trans'],$_POST['Echeance'],$_POST['Date_trans'],$_POST['idProj'],$_POST['num_doc']));
	header('Location: http://localhost/STAGE/template/transactionFront.php');
}