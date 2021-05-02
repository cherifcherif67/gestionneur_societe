<?php

include("commercialFunctions.php");
include("clientFunctions.php");
include("projectFunctions.php");


if((isset($_GET['action']))=='delete')
{
	deleteCommercial($_GET['id']);
	header('Location: http://localhost/STAGE/template/commercialFront.php');
}

if ((isset($_POST['date_pub'])))
{
	updateCommercial(array($_POST['date_pub'],$_POST['lib_proj'],$_POST['Clt_comm'],$_POST['Hexonore__comm'],$_POST['mode_paie'],$_POST['caution'],$_POST['visite'],$_POST['devis'],$_POST['Avance'],$_POST['participant'],$_POST['Mnt_prop'],$_POST['type_paie'],$_POST['idComm']));
	header('Location: http://localhost/STAGE/template/commercialFront.php');
}

if(isset($_POST['Adddate_pub']))
{
	addCommercial(array($_POST['Adddate_pub'],$_POST['lib_proj'],$_POST['Clt_comm'],$_POST['Hexonore__comm'],$_POST['mode_paie'],$_POST['caution'],$_POST['visite'],$_POST['devis'],$_POST['Avance'],$_POST['participant'],$_POST['Mnt_prop'],$_POST['type_paie'],0));
	header('Location: http://localhost/STAGE/template/commercialFront.php');
}
if (isset($_POST['Validate_Avance_Proj']))
{
	addClient(array($_POST['Clt_comm'],$_POST['Hexonore__comm']));
	addProject(array($_POST['lib_proj'],-1,$_POST['Validate_Avance_Proj'],$_POST['RG_Proj'],$_POST['mode_paie'],$_POST['delai_Proj'],$_POST['penalite_Proj'],'1999-12-12',getLastClient(),'1999-12-12'));
	checkCommercial(array($_POST['idComm']));
	header('Location: http://localhost/STAGE/template/commercialFront.php?check=validé');
	
}