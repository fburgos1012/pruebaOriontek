<!--- Home --->
<?php 
include_once('header/navbar.php');
include_once 'config/database.php';
include_once('class/address.php');
include_once('modals/modalAddress.php');
$database = new Database();
$db = $database->getConnection();

?>
<div class="content">

  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php include_once('modals/modalBussines.php'); ?>
          <div class="card-header card-header-warning">
            <h4 class="card-title "><?php echo base64_decode($_REQUEST['name']); ?>
               <button type="button" style="float: right;" class="btn btn-default" data-toggle="modal" data-target="#modalAddress">Nueva direccion</button>
            </h4>
            <p class="card-category"> Mis Direcciones</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="ReloadTable">
                <thead class=" text-primary">
                  <tr>
                    <td>Direccion</td>
                    <td>ZipCode</td>
                    <td>Ciudad</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   //echo $variable;
                   $items = new addressClass($db);
                   $items->id = base64_decode($_REQUEST['customer']);
                   $stmt = $items->getAddress();
                   $itemCount = $stmt->rowCount();

                   if($itemCount > 0){
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                  ?>
                  <tr>
                    <td><?php print($direccion); ?></td>
                    <td><?php print($zipcode); ?></td>
                    <td><?php print($ciudad); ?></td>
                    <td>
                      <button type="button" class="btn btn-danger" onclick="deleteAddress('<?php print($id); ?>')">
                        <span class="material-icons">delete</span>
                      </button>
                    </td>
                  </tr>
                  <?php } 
                    }else{
                      echo "<tr>";
                      echo "<td colspan='5' style='font-size:20px; font-weight: 400; height: 100px;' align='center'>No hay registros disponibles</td>";
                      echo "</tr>";
                    } ?>   
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/address.js"></script>
<?php 
include_once('header/footer.php');
?>