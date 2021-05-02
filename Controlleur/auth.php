<?php
if(isset($_POST['email'])){
$bdd = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
$ok = false ;
    $reponse = $bdd->prepare('SELECT * FROM user WHERE adressMail=?');
    $reponse->execute(array($_POST['email']));
    while ($donnees=$reponse->fetch()) {
    	if ($donnees['passWord']==$_POST['pass']){
    		$ok=true;
    		header('Location: ../template/clientFront.php');
    	}
    }	if (!$ok){     	
    	header('Location: ../template/index.php?validate=non');
    }
}
if(isset($_POST['email_a_verifie']))
{
    $bdd = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $ok = false ;
    $reponse = $bdd->prepare('SELECT COUNT(*) as Nb FROM user WHERE adressMail=?');
    $reponse->execute(array($_POST['email_a_verifie']));
    $exist = $reponse->fetch();
    if($exist>0){
        $bdd = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
        $reponse = $bdd->prepare('SELECT * FROM user WHERE adressMail=?');
        $reponse->execute(array($_POST['email_a_verifie']));
        while ($donnees=$reponse->fetch()) {
                ini_set('SMTP','smtp.topnet.tn');
                $to      = 'cherif.cherif@enis.tn';
                $subject = 'Recuperation mot de passe TCB';
                $message = 'Salut Monsieur / Madame 
Voici ci-joint votre mot de passe : 
'.$donnees['passWord'] . '
Cordialement .';
                $headers = array(
                    'From' => 'cherifcherif536@gmail.com',
                    'Reply-To' => $donnees['adressMail'],
                    'X-Mailer' => 'PHP/' . phpversion()
                );

                mail($to, $subject, $message, $headers);
                header('Location: ../template/index.php?forgot=yes&validate=yes');
                exit();
        }
    }
        header('Location: ../template/index.php?forgot=yes&validate=non');

}
?>