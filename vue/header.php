<?php 
     $reqPs = $conn->prepare("SELECT pseudo FROM user WHERE id=?");
	 $reqPs -> execute(array(securisation($_SESSION['id'])));

    $dataPs = $reqPs -> fetch();
?>
<div class="header container-fluid" style="position:sticky;top:0px;z-index:2">
    <div class="row">
        <div class="col-md-10 mt-2">
            <h2 class="ml-5">GESTION DE STOCK</h2>
        </div>
        <div class="col-md-2 mt-3 d-flex align-items-center">
         <h5><i class="bx bx-user-circle bx-sm"></i></h5><h5> <?php echo ' '.$dataPs["pseudo"];?></h5>
        </div>
    </div>
</div>
