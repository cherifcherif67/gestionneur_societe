<?php


include("projectFunctions.php");
include("transactionFunctions.php");


if((isset($_GET['action']))=='delete')
{
	foreach (getIdTransactionWithIdProject($_GET['id']) as $transaction) 
	{
		deleteTransaction($transaction);
	}
	deleteProject($_GET['id']);
	header('Location: http://localhost/STAGE/template/projectFront.php');
}


if ((isset($_POST['nomProj'])))
{
	updateProject(array($_POST['nomProj'],$_POST['Mnt_Proj'],$_POST['Avance_Proj'],$_POST['RG_Proj'],$_POST['Mode_paie_Proj'],$_POST['delai_Proj'],$_POST['penalite_Proj'],$_POST['date_Deb_Proj'],$_POST['idClt'],$_POST['date_fin_proj'],$_POST['idProj']));
	header('Location: http://localhost/STAGE/template/projectFront.php');
}


if(isset($_POST['addnomProj']))
{
	addProject(array($_POST['addnomProj'],$_POST['Mnt_Proj'],$_POST['Avance_Proj'],$_POST['RG_Proj'],$_POST['Mode_paie_Proj'],$_POST['delai_Proj'],$_POST['penalite_Proj'],$_POST['date_Deb_Proj'],$_POST['idClt'],$_POST['date_fin_proj']));
	header('Location: http://localhost/STAGE/template/projectFront.php');
}