<?php 
session_start();
include ("header.php") ;
?>
<button type="button" class="btn btn-outline-secondary" style="margin-top: 50px; margin-bottom: 10px; left: 1200px;position: relative;" data-toggle="modal" data-target="#example2ModalCenter" ><i class="fa fa-lg fa-plus" style="padding-right: 5px;" aria-hidden="true"></i>add Transaction</button>
<table id="customers"  >
  <tr>
    <th>Benicifiaire</th>
    <th>Nature transaction</th>
    <th>AFF_transaction</th>
    <th>Montant HT</th>
    <th>Avance transaction</th>
    <th>AvanceRG transaction</th>
    <th>R_source</th>
    <th>Type paiement transaction</th>
    <th>Echeance</th>
    <th>Projet associé</th>
    <th>numero document</th>
    <th>Date transaction</th>
    <th>Action</th>
  </tr>
  <?php
$db = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $req='SELECT * FROM transaction';
    $reponse=$db->query($req);
    
    while ($donnees=$reponse->fetch()) {  
    $rep=$db->prepare('SELECT nomProj FROM projet WHERE idProj = ?');
    $rep->execute(array($donnees['idProj']));                                        
?>
  <tr>
    <td><?php echo $donnees['Benicifiaire']; ?></td>
    <td><?php echo $donnees['nature_trans']; ?></td>
    <td><?php echo $donnees['AFF_trans']; ?></td>
    <td><?php echo $donnees['Mnt_HT']; ?></td>
    <td><?php echo $donnees['Avance_trans']; ?></td>
    <td><?php echo $donnees['AvanceRG_trans']; ?></td>
    <td><?php echo $donnees['R_source']; ?></td>
    <td><?php echo $donnees['Type_paie_trans']; ?></td>
    <td><?php echo $donnees['Echeance']; ?></td>
    <?php while ($don=$rep->fetch()) { ?>
    <td><?php echo $don['nomProj']; ?></td>
    <?php } ?> 
    <td><?php echo $donnees['num_doc']; ?></td>
    <td><?php echo $donnees['Date_trans']; ?></td>
    <td style="text-align: center;"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#example1ModalCenter<?php echo $donnees['idTrans']; ?>"><i class="fa fa-lg fa-refresh" style=" padding-right: 5px;"></i></a>update</button>
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter<?php echo $donnees['idTrans']; ?>"><i class="fa fa-lg fa-trash" style="padding-right: 5px;" ></i></a>delete</button></td>
  </tr>
  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $donnees['idTrans']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment effacer la transaction ayant le Benicifiaire <?php echo $donnees['Benicifiaire']; ?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="../Controlleur/transactionService.php?action=delete&id=<?php echo $donnees['idTrans']; ?>"><button type="button" class="btn btn-primary">Delete</button></a>
      </div>
    </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="example1ModalCenter<?php echo $donnees['idTrans']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal1CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/transactionService.php" method="POST" style="margin-left: 15px;">
          <input type="text" name="idTrans" value="<?php echo $donnees['idTrans'] ; ?>" hidden="true">
     		<h2>Benicifiaire:</h2>
    		<input type="text" name="Benicifiaire" value="<?php echo $donnees['Benicifiaire']; ?>" placeholder="Benicifiaire du transaction" required >
    		<h2>Nature du transaction :</h2>
        <select name="nature_trans" hidden="true">
            <option value="Paiement" <?php if($donnees['nature_trans']=='Paiement'){echo "selected='selected'" ;} ?>>Paiement</option>
            <option value="Reglement" <?php if($donnees['nature_trans']=='Reglement'){echo "selected='selected'" ;} ?>>Reglement</option>
          </select>
           
    		<h2>AFF transaction :</h2>
    		<input type="text" name="AFF_trans" value="<?php echo $donnees['AFF_trans']; ?>" placeholder="AFF du transaction" required >
    		<h2>Montant HT:</h2>
    		<input type="number" step="any" name="Mnt_HT" value="<?php echo $donnees['Mnt_HT']; ?>" placeholder="Saisir le montant HT" required >
    		<h2>Avance transaction:</h2>
    		<input type="number" step="any" name="Avance_trans" value="<?php echo $donnees['Avance_trans']; ?>" placeholder="Saisir l'Avance transaction" required >
    		<h2>AvanceRG du transaction:</h2>
    		<input type="number" step="any" name="AvanceRG_trans" value="<?php echo $donnees['AvanceRG_trans']; ?>" placeholder="Saisir l'AvanceRG du transaction ... " required >
    		<h2>R_source:</h2>
    		<input type="number" name="R_source" value="<?php echo $donnees['R_source']; ?>" placeholder="Saisir le R_source ..." required >
    		<h2>Type du paiement du transaction :</h2>
        <select name="Type_paie_trans" hidden="true">
            <option value="Virement" <?php if($donnees['Type_paie_trans']=='Virement'){echo "selected='selected'" ;} ?> >Virement</option>
            <option value="Especes" <?php if($donnees['Type_paie_trans']=='Especes'){echo "selected='selected'" ;} ?> >Especes</option>
            <option value="Cheque" <?php if($donnees['Type_paie_trans']=='Cheque'){echo "selected='selected'" ;} ?>>Cheque</option>
            <option value="TPE" <?php if($donnees['Type_paie_trans']=='TPE'){echo "selected='selected'" ;} ?>>TPE</option>
          </select>
        
    		<h2>Projet associé:</h2>
    		<select name="idProj" hidden="true" >
    			<?php
           		$req1='SELECT * FROM projet';
           		$reponse1=$db->query($req1);
           		while ($tab=$reponse1->fetch()) {
           			if ($tab['idProj']==$donnees['idProj']){    		
                     	?>
                    <option selected="selected" value="<?php echo $tab['idProj']; ?>"><?php echo $tab['nomProj']; ?></option>
                  <?php }else{ ?>
                  	<option value="<?php echo $tab['idProj']; ?>"><?php echo $tab['nomProj']; ?></option><?php }}?>
            </select>
    		<h2>Echeance:</h2>
    		<input type="number" name="Echeance" value="<?php echo $donnees['Echeance']; ?>" placeholder="Saisir l'Echeance ..." required >
    		<h2>Numero du document:</h2>
    		<input type="number" name="num_doc" value="<?php echo $donnees['num_doc']; ?>" placeholder="Saisir le numero du document ..." required >
    		<h2>Date transaction:</h2>
    		<input type="date" name="Date_trans" value="<?php echo $donnees['Date_trans']; ?>" required >
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Update" class="btn btn-primary"> 
      </div>
      </form>
    </div>
  </div>
</div>

 <?php } ?>
 
</table>
<div class="modal fade" id="example2ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModal1CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal ADD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/transactionService.php" method="POST" style="margin-left: 15px;">
     		<h2>Benicifiaire:</h2>
    		<input type="text" name="AddBenicifiaire" placeholder="Saisir le Benicifiaire du transaction ..." required >
    		<h2>Nature du transaction :</h2>
         <select name="nature_trans" hidden="true">
            <option value="Paiement">Paiement</option>
            <option value="Reglement">Reglement</option>
          </select>
           <br> <br>
    		<h2>AFF transaction :</h2>
    		<input type="text" name="AFF_trans"placeholder="Saisir l'AFF du transaction ..." required >
    		<h2>Montant HT:</h2>
    		<input type="number" step="any" name="Mnt_HT" placeholder="Saisir le montant HT ..." required >
    		<h2>Avance transaction:</h2>
    		<input type="number" step="any" name="Avance_trans" placeholder="Saisir l'Avance transaction ..." required >
    		<h2>AvanceRG du transaction:</h2>
    		<input type="number" step="any" name="AvanceRG_trans" placeholder="Saisir l'AvanceRG du transaction ... " required >
    		<h2>R_source:</h2>
    		<input type="number" name="R_source" placeholder="Saisir le R_source ..." required >
    		<h2>Type du paiement du transaction :</h2>
        <select name="Type_paie_trans" hidden="true">
            <option value="Virement">Virement</option>
            <option value="Especes">Especes</option>
            <option value="Cheque">Cheque</option>
            <option value="TPE">TPE</option>
          </select>
           <br> <br>
    		<h2>Projet associé:</h2>
    		<select name="idProj" hidden="true" >
    			<?php
           		$req1='SELECT * FROM projet';
           		$reponse1=$db->query($req1);
           		while ($tab=$reponse1->fetch()) {
           			?>
                  	<option value="<?php echo $tab['idProj']; ?>"><?php echo $tab['nomProj']; ?></option><?php }?>
            </select>
            <br><br><br>
    		<h2>Echeance:</h2>
    		<input type="number" name="Echeance" placeholder="Saisir l'Echeance ..." required >
    		<h2>Numero du document:</h2>
    		<input type="number" name="num_doc" placeholder="Saisir le numero du document ..." required >
    		<h2>Date transaction:</h2>
    		<input type="date" name="Date_trans" required >
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="ADD" class="btn btn-primary"> 
        </div>

      </form>
    </div>
  </div>
</div>
</body>
</html>