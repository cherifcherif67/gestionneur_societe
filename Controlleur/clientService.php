<?php
include("clientFunctions.php");
include("projectFunctions.php");
include("transactionFunctions.php");
if((isset($_GET['action']))=='delete'){
	foreach (getIdProjectWithIdClient($_GET['id']) as $project) {
		foreach (getIdTransactionWithIdProject($project) as $transaction) {
			deleteTransaction($transaction);
		}
		deleteProject($project);
	}
	deleteClient($_GET['id']);
	header('Location: http://localhost/STAGE/template/clientFront.php');
}
if ((isset($_POST['id']))){
	updateClient(array($_POST['name'],$_POST['Hexonore'],$_POST['id']));
	header('Location: http://localhost/STAGE/template/clientFront.php');
}
if(isset($_POST['addClientName'])and isset($_POST['addClientHexonore'])){
	addClient(array($_POST['addClientName'],$_POST['addClientHexonore']));
	header('Location: http://localhost/STAGE/template/clientFront.php');
}