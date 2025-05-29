<?php 
     include "../modele/fonction.php";
     include "../modele/estConnecte.php";
     obligatoire();
    $reqF = $conn->prepare("SELECT numFact,dateFact,heureFact,nom FROM facture,client WHERE facture.idCl=client.idCl ORDER BY dateFact,heureFact DESC");
	$reqF -> execute(array());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aziz Auto - Facture</title>
    <?php include('frame-style.php');?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!--------------------------------- PARTIE MENU ------------------------------------------------>
            <div class="col-md-2 bg-dark">
                <?php include('menu.php');?>
            </div>
            
            <!--------------------------------- PARTIE CONTENU ------------------------------------------------>
            <div class="col-md-10 container-fluid" style="margin:0px;padding:0px;">
                <div class="contenu">
                    <?php include('header.php');?>
                    <div class="sous-contenu container-fluid" style="z-index:1;background-color:rgba(0,0,0,0.055);height:90vh">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h6>Piéce > <span class="text-primary">Liste des piéces</span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 bg-white" id="divFacture" style="border-radius:5px;padding:20px;box-shadow:0px 0px 8px rgba(0,0,0,0.2);">
                               <table class="table table-striped" id="tableFacture">
                                    <thead>
                                        <tr>
                                            <th>N° Facture</th>
                                            <th>Nom client</th>
                                            <th>Date Facture</th>
                                            <th>Heure Facture</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($data = $reqF -> fetch()){?> 
                                        <tr>
                                            <td><?php echo $data["numFact"]?></td>
                                            <td><?php echo $data["nom"]?></td>
                                            <td><?php echo $data["dateFact"]?></td>
                                            <td><?php echo $data["heureFact"]?></td>
                                            <td><a class="btn btn-warning"  href="./facture_pdf.php?idFact=<?php echo $data["numFact"]; ?>"><i class="bx bx-printer"></i></a></td>
                                        </tr>
                                        <?php } ?> 
                                    </tbody>
                               </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/jquery.js"></script>
    <script src="./framework/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/DataTables/datatables.min.js"></script>
    <script src="../controller/facture.js"></script>
</body>
</html>
