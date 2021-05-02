<?php 
session_start();
include ("header.php") ;
?>
<button type="button" class="btn btn-outline-secondary" style="margin-top: 50px; margin-bottom: 10px; left: 1200px;position: relative;" data-toggle="modal" data-target="#example2ModalCenter" ><i class="fa fa-lg fa-plus" style="padding-right: 5px;" aria-hidden="true"></i>add Commercial</button>
<table id="customers"  >
  <tr>
    <th>Date publication</th>
    <th>Libelllé du projet</th>
    <th>Client commercial</th>
    <th>Hexonore commercial</th>
    <th>Mode du paiement</th>
    <th>Caution</th>
    <th>Visite</th>
    <th>Devis</th>
    <th>Avance</th>
    <th>Participant</th>
    <th>Montant proposé</th>
    <th>Type paiement</th>
    <th>Action</th>
  </tr>
  <?php
$db = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $req='SELECT * FROM commercial ';
    $reponse=$db->query($req); 
    while ($donnees=$reponse->fetch()) {                                      
?>
  <tr>
    <td><?php echo $donnees['date_pub']; ?></td>
    <td>
      <?php 
      echo $donnees['lib_proj'];
      if ($donnees['etat'] == 1){ ?>
      <i class="fa fa-lg fa-check" style="color: green" ></i>
      <?php  
      } 
      ?>
    </td>
    <td><?php echo $donnees['Clt_comm']; ?></td>
    <td><?php echo $donnees['Hexonore__comm']; ?></td>
    <td><?php echo $donnees['mode_paie']; ?></td>
    <td><?php echo $donnees['caution']; ?></td>
    <td><?php echo $donnees['visite']; ?></td>
    <td><?php echo $donnees['devis']; ?></td>
    <td><?php echo $donnees['Avance']; ?></td>
    <td><?php echo $donnees['participant']; ?></td>
    <td><?php echo $donnees['Mnt_prop']; ?></td>
    <td><?php echo $donnees['type_paie']; ?></td>
    <td style="text-align: center;">
      <?php if(($donnees['etat'] == 0) && (strtoupper($donnees['participant']) == 'TCB')){ ?>
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#example5ModalCenter<?php echo $donnees['idComm']; ?>"><i class="fa fa-lg fa-check" style="padding-right: 5px;" ></i></a>Check</button><br>
    <?php } ?>
      <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#example1ModalCenter<?php echo $donnees['idComm']; ?>"><i class="fa fa-lg fa-refresh" style=" padding-right: 5px;"></i></a>update</button>
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter<?php echo $donnees['idComm']; ?>"><i class="fa fa-lg fa-trash" style="padding-right: 5px;" ></i></a>delete</button>
  </td>
  </tr>
  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $donnees['idComm']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment effacer le Commercial ayant le libellé <?php echo $donnees['lib_proj']; ?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="../Controlleur/commercialService.php?action=delete&id=<?php echo $donnees['idComm']; ?>"><button type="button" class="btn btn-primary">Delete</button></a>
      </div>
    </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="example1ModalCenter<?php echo $donnees['idComm']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal1CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/commercialService.php" method="POST" style="margin-left: 15px;">
          <input type="text" name="idComm" value="<?php echo $donnees['idComm']; ?>" hidden="true">
          <h2>Date Publication:</h2>
          <input type="date" name="date_pub" value="<?php echo $donnees['date_pub']; ?>" placeholder="Date Publication ..." required >
          <h2>Librairie projet:</h2>
          <input type="text"  name="lib_proj" value="<?php echo $donnees['lib_proj']; ?>" placeholder="Librairie du Projet" required >
          <h2>Cllient Commercial:</h2>
          <input type="text"  name="Clt_comm" value="<?php echo $donnees['Clt_comm']; ?>" placeholder="Client Commercial ..." required >
          <h2>Hexonore commercial:</h2>
          <select name="Hexonore__comm" hidden="true">
            <option value="oui" <?php if ($donnees['Hexonore__comm'] == 'oui'){echo "selected='selected' ";} ?> >Oui</option>
            <option value="non" <?php if ($donnees['Hexonore__comm'] == 'non'){echo "selected='selected' ";} ?>>Non</option>
          </select>
          <h2>Mode du paiement:</h2>
          <input type="text" name="mode_paie" value="<?php echo $donnees['mode_paie']; ?>" placeholder="Mode du paiement ..." required >
          <h2>Caution:</h2>
          <select name="caution" hidden="true">
            <option value="oui" <?php if ($donnees['caution'] == 'oui'){echo "selected='selected' ";} ?>>Oui</option>
            <option value="non"<?php if ($donnees['caution'] == 'oui'){echo "selected='selected' ";} ?>>Non</option>
          </select>
          <h2>Visite:</h2>
          <select name="visite" hidden="true">
            <option value="oui" <?php if ($donnees['visite'] == 'oui'){echo "selected='selected' ";} ?>>Oui</option>
            <option value="non" <?php if ($donnees['visite'] == 'oui'){echo "selected='selected' ";} ?>>Non</option>
          </select>
          <h2>Devis:</h2>
          <input type="text" name="devis" value="<?php echo $donnees['devis']; ?>"  placeholder="Devis ..." required >
          <h2>Avance:</h2>
          <input type="text" name="Avance" value="<?php echo $donnees['Avance']; ?>" placeholder="Avance ..." required >
          <h2>Participant:</h2>
          <input type="text" name="participant" value="<?php echo $donnees['participant']; ?>" placeholder="Participant ..." required >
          <h2>Montant proprietaire:</h2>
          <input type="number" step="any" name="Mnt_prop" value="<?php echo $donnees['Mnt_prop']; ?>" placeholder="Montant proprietaire ..." required >
          <h2>Type paiement:</h2>
          <select name="type_paie" hidden="true">
            <option value="Cheque" <?php if ($donnees['type_paie'] == 'Cheque'){echo "selected='selected' ";} ?> >Chèque</option>
            <option value="Especes" <?php if ($donnees['type_paie'] == 'Especes'){echo "selected='selected' ";} ?> >Espèces</option>
        </select>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Update" class="btn btn-primary"> 
      </div>
      </form>
    </div>
  </div>
</div>
 <!-- Modal -->
<div class="modal fade" id="example5ModalCenter<?php echo $donnees['idComm']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal1CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/commercialService.php" method="POST" style="margin-left: 15px;">
          <input type="number"  name="idComm" value="<?php echo $donnees['idComm']; ?>"  hidden="true"  >
          <input type="text"  name="lib_proj" value="<?php echo $donnees['lib_proj']; ?>"  hidden="true"  >
          <input type="text"  name="Clt_comm" value="<?php echo $donnees['Clt_comm']; ?>"  hidden="true" >
          <input type="text"  name="Hexonore__comm" value="<?php echo $donnees['Hexonore__comm']; ?>"  hidden="true" >
          <input type="text" name="mode_paie" value="<?php echo $donnees['mode_paie']; ?>" hidden="true" >
          <h2>Avance du Projet:</h2>
          <input type="number" step="any" name="Validate_Avance_Proj" placeholder="Avance du Projet ..." required >
          <h2>RG_Proj:</h2>
          <input type="number" step="any" name="RG_Proj" placeholder="RG_Proj ..." required >
          <h2>Delai du Projet:</h2>
          <input type="number" name="delai_Proj" placeholder="Delai du Projet ..." required >
          <h2>Penalite sur Projet:</h2>
          <input type="number" step="any" name="penalite_Proj" placeholder="Penalite sur Projet ..." required >
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Validate" class="btn btn-primary"> 
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
      <form action="http://localhost/STAGE/Controlleur/commercialService.php" method="POST" style="margin-left: 15px;">
     		<h2>Date Publication:</h2>
    		<input type="date" name="Adddate_pub"  placeholder="Date Publication ..." required >
    		<h2>Librairie projet:</h2>
    		<input type="text"  name="lib_proj" placeholder="Librairie du Projet" required >
    		<h2>Cllient Commercial:</h2>
    		<input type="text"  name="Clt_comm"placeholder="Client Commercial ..." required >
    		<h2>Hexonore commercial:</h2>
        <select name="Hexonore__comm" hidden="true">
          <option value="oui">Oui</option>
          <option value="non">Non</option>
        </select>
    	   <br> <br>
    		<h2>Mode du paiement:</h2>
    		<input type="text" name="mode_paie" placeholder="Mode du paiement ..." required >
    		<h2>Caution:</h2>
        <select name="caution" hidden="true">
          <option value="oui">Oui</option>
          <option value="non">Non</option>
        </select>
         <br> <br>
    		<h2>Visite:</h2>
        <select name="visite" hidden="true">
          <option value="oui">Oui</option>
          <option value="non">Non</option>
        </select>
         <br> <br>
    		<h2>Devis:</h2>
    		<input type="text" name="devis"  placeholder="Devis ..." required >
    		<h2>Avance:</h2>
    		<input type="text" name="Avance"  placeholder="Avance ..." required >
        <h2>Participant:</h2>
        <input type="text" name="participant"  placeholder="Participant ..." required >
        <h2>Montant proprietaire:</h2>
        <input type="number" step="any" name="Mnt_prop"  placeholder="Montant proprietaire ..." required >
        <h2>Type paiement:</h2>
        <select name="type_paie" hidden="true">
          <option value="Cheque">Chèque</option>
          <option value="Especes">Espèces</option>
        </select>
         <br> <br>

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