<!--- Home --->
<?php 
include_once('header/navbar.php');
include_once 'config/database.php';
include_once('class/bussines.php');
include_once('modals/modalBussines.php');
$database = new Database();
$db = $database->getConnection();
?>
<div class="content">

  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php include_once('modals/modalBussines.php'); ?>
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Empresas
               <button type="button" style="float: right;" class="btn btn-default" data-toggle="modal" data-target="#modalBussines">Nueva empresa</button>
            </h4>
            <p class="card-category"> Listado de empresas registradas</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="ReloadTable">
                <thead class=" text-primary">
                  <tr>
                    <td>Nombre</td>
                    <td>Telefono</td>
                    <td>RNC</td>
                    <td>Direccion</td>
                    <td>Fecha</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $items = new bussinesClass($db);
                   $stmt = $items->getBussines();
                   $itemCount = $stmt->rowCount();

                   if($itemCount > 0){
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                  ?>
                  <tr>
                    <td><?php print($name); ?></td>
                    <td><?php print($phone); ?></td>
                    <td><?php print($rnc); ?></td>
                    <td><?php print($address); ?></td>
                    <td><?php print($created); ?></td>
                    <td>
                      <!--<button type="button" class="btn btn-primary" onclick="ViewCustomer('<?php print($id); ?>')">Ver clientes</button>-->
                      <a class="btn btn-primary" href="customer?id=<?php echo base64_encode($id)?>">Ver clientes</a> 
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
<script type="text/javascript" src="js/bussines.js"></script>
<?php 
include_once('header/footer.php');
?>