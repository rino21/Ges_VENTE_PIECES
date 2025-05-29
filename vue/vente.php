<?php 
    include "../modele/fonction.php";
    include "../modele/estConnecte.php";
    obligatoire();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aziz Auto - Vente</title>
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
<!----------------------------------- The Modal formulaire d'ajout du vente -------------------------------- -->
                    <div class="modal fade" id="modalEnrVente" data-bs-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">ENREGISTREMENT DE LA VENTE</h4>
                                <button type="button" class="btn-close" onclick="hideModalVente()"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" class="-was-validated" id="form-vente">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" id="select-client">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                        <div class="row mt-3" style="border-top:2px solid dodgerblue">
                                            <div class="col-md-5 mt-3">
                                                <div class="form-group" id="select-piece">

                                    
                                                </div>
                                              
                                            </div>
                                            <div class="col-md-5 mt-3">
                                                <div class="form-group">
                                                    <label for="qte" class="form-label">qte</label>
                                                    <input type="number" min="0" class="form-control" id="qte">
                                                    <div class="invalid-feedback">Veuillez ajouter un Quantité</div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-3">
                                                <br>
                                                <i class="bx bx-plus bx-sm btn btn-primary btn-block mt-2" onclick="ajouterVente()" style="width:100%"></i>
                                            </div>
                                        </div>
                                                                        
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">N° Pièce</th>
                                                        <th class="text-center">Désignation</th>
                                                        <th class="text-center">Quantité</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='liste_piece'>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="button" onclick="enregistrementVente()">Enregistrer</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
<!----------------------------------- The Modal formulaire de la suppression de la vente-------------------------------- -->
                    <div class="modal fade" id="modalSupVt" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">SUPPRESSION VENTE</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <h6 id="msg-vente">Voulez vous vraiment annuler ?</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" onclick="supprimerVente()">Oui</button>
                                    <button type="button" class="btn btn-primary" onclick="hideModalSupVente()" id="btn_nsup_pc">Non</button>
                                </div>
                            </div>
                        </div>
                    </div>  


                    <?php include('header.php');?>
                    <div class="sous-contenu container-fluid" style="z-index:1;background-color:rgba(0,0,0,0.055);height:90vh">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary" onclick="showModalVente()">Ajouter</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6>Piéce > <span class="text-primary">Liste des ventes</span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 bg-white" id="divVente" style="border-radius:5px;padding:20px;box-shadow:0px 0px 8px rgba(0,0,0,0.2);">
                               
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
    <script src="./assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../controller/vente.js"></script>
</body>
</html>
