<?php 
   
    include "../modele/estConnecte.php";
    include "../modele/fonction.php";
    obligatoire();

    $req2 = $conn->prepare("SELECT * FROM article ORDER BY `des` ASC");
	$req2 -> execute(array());

    $req1 = $conn->prepare("SELECT * FROM article ORDER BY `des` ASC");
	$req1 -> execute(array());

    $reqRecette = $conn->prepare("SELECT SUM(vente.qte * article.pu) as recette FROM vente,article WHERE vente.idArt=article.idArt AND vente.`date`= CURRENT_DATE()");
	$reqRecette -> execute(array());
    $recette = $reqRecette -> fetch();

    $reqListeVente = $conn->prepare("SELECT article.idArt AS idArt,des,vente.qte as qte, vente.qte*article.pu AS pu, heure FROM vente,article WHERE vente.idArt=article.idArt AND vente.`date` = CURRENT_DATE()");
	$reqListeVente -> execute(array());

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aziz Auto - Accueil</title>
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
<!----------------------------------- The Modal formulaire d'impression de liste de vente-------------------------------- -->
                    <div class="modal fade" id="modalImpStock" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">IMPRIMER LA LISTE DE STOCK DES PIECES</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <table class="table table-striped" id="listeStockPiece">
                                        <thead>
                                            <tr>
                                                <th>Désignation</th>
                                                <th>UTE</th>
                                                <th>Qté stock</th>
                                                <th>Prix</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($dataArt = $req1->fetch()) {?>
                                            <tr>
                                                <td><?php echo $dataArt['des'] ?></td>
                                                <td><?php echo $dataArt['UTE'] ?></td>
                                                <td><?php echo $dataArt['qteStock'] ?></td>
                                                <td><?php echo $dataArt['pu'] ?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  
<!----------------------------------- The Modal formulaire de la suppression de la vente-------------------------------- -->
                    <div class="modal fade" id="modalListeVente">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">LISTE DE VENTE AUJOURD'HUI</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Désignation</th>
                                                        <th>Qté</th>
                                                        <th>Prix</th>
                                                        <th>Heure</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($data=$reqListeVente -> fetch()){?>
                                                    <tr>
                                                        <td>P<?php echo $data["idArt"];?></td>
                                                        <td><?php echo $data["des"];?></td>
                                                        <td><?php echo $data["qte"];?></td>
                                                        <td><?php echo $data["pu"];?></td>
                                                        <td><?php echo $data["heure"];?></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

<!-------------------------------------------- The Modal d'etat de stock ---------------------------------------------- -->
                    <div class="modal fade" id="modalEtatStock">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">ETAT DE STOCK D'UNE PIECE ENTRE 2 DATES.</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="">
                                                        <div class="row">
                                                            <div class="form-group col-4">
                                                                <label for="" class="form-label">Pièce</label>
                                                                <select name="" id="idPiece" class="form-select">
                                                                <option value="">Quelle pièce !</option>
                                                                <?php 
                                                                  while($data = $req2->fetch()){
                                                                ?>
                                                                    <option value="<?php echo $data['idArt']; ?>"><?php echo $data['des']; ?></option>
                                                                <?php 
                                                                  }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="" class="form-label">Date de début</label>
                                                                <input type="date" class="form-control" id="dateDebEtat">
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label for="" class="form-label">Date de fin</label>
                                                                <input type="date" class="form-control" id="dateFinEtat">
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <label for="" class="form-label">.</label><br>
                                                                <button type="button" class="btn btn-primary btn-block" onclick="etatDeStockEntre2date()">Vérifier</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <h6 id="totalE">Total Entré :</h6>
                                                    <table class="table table-striped mt-2">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Date d'entré</th>
                                                                <th class="text-center">Qté entrée</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="listeEtatE">
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="row">
                                                        <div class="col-md-6"><h6 id="totalS">Total Sorti :</h6></div>
                                                        <div class="col-md-6"><h6 id="totalR">Total Reste :</h6></div>
                                                    </div>
                                                    
                                                    <table class="table table-striped mt-2">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Date de sortie</th>
                                                                <th class="text-center">Qté sortie</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="listeEtatS">
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="sous-contenu container-fluid" style="z-index:1;background-color:rgba(0,0,0,0.055);height:90vh">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h6>Accueil > <span class="text-primary">...</span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card" style="border-radius:15px">
                                    <div class="card-body shadow"  style="border-radius:15px" onclick="modalImpStock()">
                                        <div class="row d-flex align-items-center" style="height:10vh">
                                            <div class="col-md-8"><h6 class="text-center">Imprimer la liste de stock</h6></div>
                                            <div class="col-md-4"><i class="bx bx-cart bx-sm btn btn-edit" style="background-color:rgba(0,0,255,0.3); color:rgba(0,0,255,1)"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card" style="border-radius:15px">
                                    <div class="card-body shadow"  style="border-radius:15px" onclick="modalListeVente()">
                                        <div class="row d-flex align-items-center" style="height:10vh">
                                            <div class="col-md-8"><h6 class="text-center">Liste des ventes aujourd'hui</h6></div>
                                            <div class="col-md-4"><i class="bx bx-cart bx-sm btn btn-edit" style="background-color:rgba(100,255,0,0.3); color:rgba(100,255,0,1)"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card" style="border-radius:15px">
                                    <div class="card-body shadow"  style="border-radius:15px">
                                        <div class="row d-flex align-items-center" style="height:10vh">
                                            <div class="col-md-8"><h6 class="text-center">Recette d'aujourd'hui <br><span class="mt-1" style="font-size:1.2em;"><?php if($recette["recette"]!=NULL) echo $recette["recette"]; else echo '0'?> Ar</span></h6></div>
                                            <div class="col-md-4"><i class="bx bx-bitcoin bx-sm btn btn-edit" style="background-color:rgba(255,0,0,0.3); color:rgba(255,0,0,1)"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card" style="border-radius:15px">
                                    <div class="card-body shadow"  style="border-radius:15px" onclick="showModalEtat()">
                                        <div class="row d-flex align-items-center" style="height:10vh">
                                            <div class="col-md-8"><h6 class="text-center">Etat de stock d'une pièce</h6></div>
                                            <div class="col-md-4"><i class="bx bx-cart bx-sm btn btn-edit" style="background-color:rgba(255,150,0,0.3); color:rgba(255,150,0,1)"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow" style="border-radius:10px">
                                    <div class="card-body">
                                        <h5 class="text-center">Les stocks des pièces vont être épuisés</h5>
                                        <canvas id="line" width="400" height="115"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/jquery.js"></script>
    <script src="./framework/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/DataTables/datatables.min.js"></script>
    <script src="./assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="./js/chart.js"></script>
    <script src="../controller/accueil.js"></script>
</body>
</html>
