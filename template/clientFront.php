
<?php 
session_start();
include ("header.php") ;
?>

<body>
  
<button type="button" class="btn btn-outline-secondary" style="margin-top: 50px; margin-bottom: 10px; left: 1200px;position: relative;" data-toggle="modal" data-target="#example2ModalCenter" ><i class="fa fa-lg fa-plus" style="padding-right: 5px;" aria-hidden="true"></i>add Client</button>
<table id="customers" style="width: 90%; margin: auto; ">
  <tr>
    <th>NOM</th>
    <th>Hexonore</th>
    <th>ACTION</th>
    
  </tr>
  <?php
$db = new PDO('mysql:host=localhost;dbname=tcb;charset=utf8', 'root', '');
    $req='SELECT * FROM client ';
    $reponse=$db->query($req);
    while ($donnees=$reponse->fetch()) {                                           
?>
  <tr>
    <td><?php echo $donnees['nom']; ?></td>
    <td><?php echo $donnees['Hexonore']; ?></td>
    <td style="text-align: center;"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#example1ModalCenter<?php echo $donnees['id']; ?>"><i class="fa fa-lg fa-refresh" style=" padding-right: 5px;"></i></a>update</button>
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter<?php echo $donnees['id']; ?>"><i class="fa fa-lg fa-trash" style="padding-right: 5px;" ></i></a>delete</button></td>
  </tr>
  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $donnees['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment effacer le client  <?php echo $donnees['nom']; ?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="../Controlleur/clientService.php?action=delete&id=<?php echo $donnees['id']; ?>"><button type="button" class="btn btn-primary">Delete</button></a>
      </div>
    </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="example1ModalCenter<?php echo $donnees['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal1CenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/clientService.php" method="POST" style="margin-left: 15px;">
      		<h2>id:</h2>
      		<input type="text" name="id" value="<?php echo $donnees['id'] ; ?> " hidden="true">
    		<h3><?php echo $donnees['id']; ?></h3>
     		<h2>nom:</h2>
    		<input type="text" name="name" value="<?php echo $donnees['nom']; ?>" placeholder="nom" required >
    		<h2 style="margin-top: 15px;">Hexonore:</h2>
        <select name="Hexonore" hidden="true">
            <option value="oui" <?php if ($donnees['Hexonore'] == 'oui'){echo "selected='selected' ";} ?> >Oui</option>
            <option value="non" <?php if ($donnees['Hexonore'] == 'non'){echo "selected='selected' ";} ?>>Non</option>
          </select>
           <br>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="http://localhost/STAGE/Controlleur/clientService.php" method="POST" style="margin-left: 15px;">
        <h2>Name :</h2>
        <input type="text" name="addClientName" required>
        <h2>Hexonore :</h2>
        <select name="addClientHexonore" hidden="true">
            <option value="oui">Oui</option>
            <option value="non">Non</option>
          </select>
           <br>
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