<?php 
session_start();
include ("header.php") ;
?>
<button type="button" class="btn btn-outline-secondary" style="margin-top: 50px; margin-bottom: 10px; left: 1200px;position: relative;" data-toggle="modal" data-target="#example2ModalCenter" ><i class="fa fa-lg fa-plus" style="padding-right: 5px;" aria-hidden="true"></i>add Project</button>
<table id="customers"  >
  <tr>
    <th>Nom du Projet</th>
    <th>Montant du Projet</th>
    <th>Avance du Projet</th>
    <th>RG_Proj</th>
    <th>Mode du paiement</th>
    <th>Delai du Projet</th>
    <th>Penalite sur Projet</th>
    <th>Client envisagée</th>
    <th>Date Debut Projet</th>
    <th>Date fin Projet</th>
    <th>Action</th>
  </tr>
  <?php
$db = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $req='SELECT * FROM projet ';
    $reponse=$db->query($req);
    
    while ($donnees=$reponse->fetch()) {  
    $rep=$db->prepare('SELECT nom FROM client WHERE id = ?');
    $rep->execute(array($donnees['idClt']));                                        
?>
  <tr>
    <td><?php echo $donnees['nomProj']; ?></td>
      <?php 
      if ($donnees['Mnt_Proj']<0){
      ?> <td style="color: red">pas encore saisie</td>
      <?php
      }else{
      ?> 
      <td><?php  echo $donnees['Mnt_Proj']; ?></td> 
      <?php
      }
      ?>  
    <td><?php echo $donnees['Avance_Proj']; ?></td>
    <td><?php echo $donnees['RG_Proj']; ?></td>
    <td><?php echo $donnees['Mode_paie_Proj']; ?></td>
    <td><?php echo $donnees['delai_Proj']; ?></td>
    <td><?php echo $donnees['penalite_Proj']; ?></td>
    <?php while ($don=$rep->fetch()) { ?>
    <td><?php echo $don['nom']; ?></td>
    <?php } ?> 
    <?php 
    if ($donnees['date_Deb_Proj']==$donnees['date_fin_proj']){
    ?>
    <td style="color: red">pas encore saisie</td>
    <td style="color: red">pas encore saisie</td>
    <?php
    }else{
    ?>  
    <td><?php echo $donnees['date_Deb_Proj']; ?></td>
    <td><?php echo $donnees['date_fin_proj']; ?></td>
    <?php } ?>
    <td style="text-align: center;"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#example1ModalCenter<?php echo $donnees['idProj']; ?>"><i class="fa fa-lg fa-refresh" style=" padding-right: 5px;"></i></a>update</button>
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter<?php echo $donnees['idProj']; ?>"><i class="fa fa-lg fa-trash" style="padding-right: 5px;" ></i></a>delete</button></td>
  </tr>
  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $donnees['idProj']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment effacer le projet  <?php echo $donnees['nomProj']; ?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="../Controlleur/projectService.php?action=delete&id=<?php echo $donnees['idProj']; ?>"><button type="button" class="btn btn-primary">Delete</button></a>
      </div>
    </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="example1ModalCenter<?php echo $donnees['idProj']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal1CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/projectService.php" method="POST" style="margin-left: 15px;">
      		<h2>ID PROJECT :</h2>
          <input type="text" name="idProj" value="<?php echo $donnees['idProj']; ?>" hidden="true">
      		
    		<h3><?php echo $donnees['idProj']; ?></h3>
     		<h2>Nom du Projet:</h2>
    		<input type="text" name="nomProj" value="<?php echo $donnees['nomProj']; ?>" placeholder="Nom du Projet" required >
    		<h2>Montant du Projet:</h2>
    		<input type="number" step="any" name="Mnt_Proj" value="<?php echo $donnees['Mnt_Proj']; ?>" placeholder="Montant du Projet" required >
    		<h2>Avance du Projet:</h2>
    		<input type="number" step="any" name="Avance_Proj" value="<?php echo $donnees['Avance_Proj']; ?>" placeholder="Avance du Projet" required >
    		<h2>RG_Proj:</h2>
    		<input type="number" step="any" name="RG_Proj" value="<?php echo $donnees['RG_Proj']; ?>" placeholder="RG_Proj" required >
    		<h2>Mode du paiement:</h2>
    		<input type="text" name="Mode_paie_Proj" value="<?php echo $donnees['Mode_paie_Proj']; ?>" placeholder="Mode du paiement" required >
    		<h2>Delai du Projet:</h2>
    		<input type="number" name="delai_Proj" value="<?php echo $donnees['delai_Proj']; ?>" placeholder="Delai du Projet" required >
    		<h2>Penalite sur Projet:</h2>
    		<input type="number" step="any" name="penalite_Proj" value="<?php echo $donnees['penalite_Proj']; ?>" placeholder="Penalite sur Projet" required >
    		<h2>Client envisagée:</h2>
    		<select name="idClt" hidden="true" >
    			<?php
           		$req1='SELECT * FROM client';
           		$reponse1=$db->query($req1);
           		while ($tab=$reponse1->fetch()) {
           			if ($tab['id']==$donnees['idClt']){    		
                     	?>
                    <option selected="selected" value="<?php echo $tab['id']; ?>"><?php echo $tab['nom']; ?></option>
                  <?php }else{ ?>
                  	<option value="<?php echo $tab['id']; ?>"><?php echo $tab['nom']; ?></option><?php }}?>
            </select>
    		<h2>Date Debut Projet:</h2>
    		<input type="date" name="date_Deb_Proj" value="<?php echo $donnees['date_Deb_Proj']; ?>" placeholder="Client envisagée" required >
    		<h2>Date fin Projet:</h2>
    		<input type="date" name="date_fin_proj" value="<?php echo $donnees['date_fin_proj']; ?>" placeholder="Date Debut Projet" required >
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
      <form action="http://localhost/STAGE/Controlleur/projectService.php" method="POST" style="margin-left: 15px;">
     		<h2>Nom du Projet:</h2>
    		<input type="text" name="addnomProj"  placeholder="Nom du Projet" required >
    		<h2>Montant du Projet:</h2>
    		<input type="number" step="any" name="Mnt_Proj" placeholder="Montant du Projet" required >
    		<h2>Avance du Projet:</h2>
    		<input type="number" step="any" name="Avance_Proj"placeholder="Avance du Projet" required >
    		<h2>RG_Proj:</h2>
    		<input type="number" step="any" name="RG_Proj"placeholder="RG_Proj" required >
    		<h2>Mode du paiement:</h2>
    		<input type="text" name="Mode_paie_Proj" placeholder="Mode du paiement" required >
    		<h2>Delai du Projet:</h2>
    		<input type="number" name="delai_Proj" placeholder="Delai du Projet" required >
    		<h2>Penalite sur Projet:</h2>
    		<input type="number" step="any" name="penalite_Proj" placeholder="Penalite sur Projet" required >
    		<h2>Client envisagée:</h2>
    		<select name="idClt" hidden="true">
    		<?php
                   		$req1='SELECT * FROM client';
                   		$reponse1=$db->query($req1);
                   		while ($tab=$reponse1->fetch()) {		
                     	?>
                    <option value="<?php echo $tab['id']; ?>"><?php echo $tab['nom']; ?></option>
                  <?php }?>
            </select>
            <br><br>
    		<h2>Date Debut Projet:</h2>
    		<input type="date" name="date_Deb_Proj"  placeholder="Client envisagée" required >
    		<h2>Date fin Projet:</h2>
    		<input type="date" name="date_fin_proj"  placeholder="Date Debut Projet" required >

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