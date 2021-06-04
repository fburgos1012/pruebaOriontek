<!--- Home --->
<?php 
include_once('header/navbar.php');
include_once 'config/database.php';
include_once('class/customer.php');
include_once('modals/modalCustomer.php');
$database = new Database();
$db = $database->getConnection();

?>
<div class="content">

  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php include_once('modals/modalBussines.php'); ?>
          <div class="card-header card-header-danger">
            <h4 class="card-title ">Clientes
               <button type="button" style="float: right;" class="btn btn-default" data-toggle="modal" data-target="#modalCustomer">Nuevo cliente</button>
            </h4>
            <p class="card-category"> Listado de clientes registrados</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="ReloadTable">
                <thead class=" text-primary">
                  <tr>
                    <td>Nombre</td>
                    <td>Telefono</td>
                    <td>Empresa</td>
                    <td>Direccion</td>
                    <td>Correo</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   //echo $variable;
                   $items = new customerClass($db);
                   $items->id = base64_decode($_REQUEST['id']);
                   $stmt = $items->getCustomer();
                   $itemCount = $stmt->rowCount();

                   if($itemCount > 0){
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                  ?>
                  <tr>
                    <td><?php print($name.' '.$apellido); ?></td>
                    <td><?php print($phone); ?></td>
                    <td><?php print($company); ?></td>
                    <td><?php print($address); ?></td>
                    <td><?php print($email); ?></td>
                    <td>
                      <a class="btn btn-warning" href="detail-customer?customer=<?php echo base64_encode($id)?>&name=<?php echo base64_encode($name.' '.$apellido)?>">
                        <span class="material-icons">place</span>
                      </a>
                      <button type="button" class="btn btn-danger" onclick="deleteCustomer('<?php print($id); ?>')">
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
<script type="text/javascript" src="js/customer.js"></script>
<?php 
include_once('header/footer.php');
?>