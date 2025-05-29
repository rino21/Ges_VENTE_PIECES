<?php 
    
    include "../modele/estConnecte.php";
    include "../modele/fonction.php";
    obligatoire();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aziz Auto - Pièce</title>
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
<!----------------------------------- The Modal formulaire d'ajout du piece-------------------------------- -->
                    <div class="modal fade" id="modalAjtPc" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">AJOUT PIECE</h4>
                                <button type="button" class="btn-close" id="btn_najt_pc" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" class="-was-validated" id="form-piece">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3 mt-1">
                                                <label for="des" class="form-label">Désignation</label>
                                                <input type="text" class="form-control" id="des" placeholder="Nom du piéce" name="des" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ Désignation</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="UTE" class="form-label">UTE</label>
                                                <input type="text" class="form-control" id="UTE" placeholder="Entrez l'UTE" name="UTE" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ UTE.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pu" class="form-label">Prix</label>
                                                <input type="number" class="form-control" id="pu" placeholder="Entrez le prix" name="pu" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ Prix.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="btn_ajt_pc">Ajouter</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

<!----------------------------------- The Modal formulaire d'ajout du piece-------------------------------- -->
                        <div class="modal fade" id="modalModPc" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">MODIFICATION PIECE</h4>
                                <button type="button" class="btn-close" id="btn_nmod_pc" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" class="-was-validated" id="form-mod-piece">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3 mt-1">
                                                <label for="m_des" class="form-label">Désignation</label>
                                                <input type="hidden" class="form-control" id="idPc">
                                                <input type="text" class="form-control" id="m_des" placeholder="Nom du piéce" name="m_des" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ Désignation.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="m_UTE" class="form-label">UTE</label>
                                                <input type="text" class="form-control" id="m_UTE" placeholder="Entrez l'UTE" name="m_UTE" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ UTE..</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="m_pu" class="form-label">Prix</label>
                                                <input type="number" class="form-control" id="m_pu" placeholder="Entrez le prix" name="m_pu" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ Prix.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="btn_mod_pc">Modifier</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
<!----------------------------------- The Modal formulaire de la suppression du piece-------------------------------- -->
                    <div class="modal fade" id="modalSupPc" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">SUPPRESSION PIECE</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <h6 id="msg-sup-pc"></h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" onclick="supprimerPiece()">Oui</button>
                                    <button type="button" class="btn btn-primary" onclick="hideModalSupPiece()" id="btn_nsup_pc">Non</button>
                                </div>
                            </div>
                        </div>
                    </div>  
<!----------------------------------- The Modal formulaire d'ajout stocker-------------------------------- -->
<div class="modal fade" id="modalStock" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">AJOUT STOCK</h4>
                                <button type="button" class="btn-close" onclick="hideModalStock()" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" class="-was-validated" id="form-stock">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Désignation</label>
                                                <input type="text" readonly class="form-control" id="s_des" placeholder="Entrez l'UTE" name="s_des" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ Désignation.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="qteEnt" class="form-label">Qté Entrée</label>
                                                <input type="number" class="form-control" id="qteEnt" placeholder="Entrez l'UTE" name="qteEnt" required>
                                                <input type="hidden" id="idArt">
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Veuillez remplir le champ Quantité du  stock.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dateEnt" class="form-label">Date Entrée</label>
                                                <input type="date" class="form-control" id="dateEnt" placeholder="Entrez l'UTE" name="dateEnt" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Entrez le date </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="btn_stock" onclick="ajoutStockerEnt()">Ajouter</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                    <?php include('header.php');?>
                    <div class="sous-contenu container-fluid" style="z-index:1;background-color:rgba(0,0,0,0.055);height:90vh">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary" id="ajtPc">Ajouter</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6>Pièce > <span class="text-primary">Liste des pièces</span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 bg-white" id="divPiece" style="border-radius:5px;padding:20px;box-shadow:0px 0px 8px rgba(0,0,0,0.2);">
                               
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
    <script src="../controller/piece.js"></script>
</body>
</html>
