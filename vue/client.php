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
    <title>Aziz Auto - Client</title>
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
<!----------------------------------- The Modal formulaire d'ajout du client-------------------------------- -->
                    <div class="modal fade" id="myModal" data-bs-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">AJOUT CLIENT</h4>
                                <button type="button" class="btn-close" id="btn_najt_cl" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="/action_page.php" class="-was-validated" id="form-client">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-1">
                                                <label for="nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="nom" placeholder="Entrez le nom du client" name="nom" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Nom du client est  vide.</div>
                                            </div>
                                            <div classass="mb-3">
                                                <label for="numStat" class="form-label">N° Stat</label>
                                                <input type="text" class="form-control" id="numStat" placeholder="Entrez le N° Stat du client" name="numStat" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-1">
                                                <label for="numNIF" class="form-label">N° NIF</label>
                                                <input type="text" class="form-control" id="numNIF" placeholder="Entrez le N° NIF du client" name="numNIF" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="adresse" class="form-label">Adresse</label>
                                                        <input type="text" class="form-control" id="adresse" placeholder="Adresse du client" name="adresse" required>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">adresse client est vide</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                     <div class="mb-3">
                                                        <label for="ville" class="form-label">Ville</label>
                                                        <input type="text" class="form-control" id="ville" placeholder="Ville du client" name="ville" required>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">Ville client est vide</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="btn_ajt_cl">Ajouter</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
<!----------------------------------- The Modal formulaire de la modification du client-------------------------------- -->
                    <div class="modal fade" id="modalModCl" data-bs-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">MODIFICATION CLIENT</h4>
                                <button type="button" class="btn-close" id="btn_nmod_cl" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" class="-was-validated" id="form-mod-client">
                                    <input type="hidden" id="m_idCl">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-1">
                                                <label for="m_nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="m_nom" placeholder="Entrez le nom du client" name="m_nom" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Nom du client est  vide.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="m_numStat" class="form-label">N° Stat</label>
                                                <input type="text" class="form-control" id="m_numStat" placeholder="Entrez le N° Stat du client" name="m_numStat" required>
                                                <!--div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div-->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-1">
                                                <label for="m_numNIF" class="form-label">N° NIF</label>
                                                <input type="text" class="form-control" id="m_numNIF" placeholder="Entrez le N° NIF du client" name="m_numNIF" required>
                                                <!--div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="m_adresse" class="form-label">Adresse</label>
                                                        <input type="text" class="form-control" id="m_adresse" placeholder="Adresse du client" name="m_adresse" required>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">adresse client est vide</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                     <div class="mb-3">
                                                        <label for="m_ville" class="form-label">Ville</label>
                                                        <input type="text" class="form-control" id="m_ville" placeholder="Ville du client" name="m_ville" required>
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">Ville client est vide</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success" id="btn_mod_cl">Modifier</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>  
<!----------------------------------- The Modal formulaire de la suppression du client-------------------------------- -->
                    <div class="modal fade" id="modalSupCl" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">SUPPRESSION CLIENT</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <h6 id="msg-sup-cl"></h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" onclick="supprimerClient()">Oui</button>
                                    <button type="button" class="btn btn-primary" onclick="hideModalSupCl()" id="btn_nsup_cl">Non</button>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <?php include('header.php');?>
                    <div class="sous-contenu container-fluid" style="z-index:1;background-color:rgba(0,0,0,0.055);height:90vh">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary" id="ajtCl">Ajouter</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6>Client > <span class="text-primary">Liste des clients</span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 bg-white" id="divClient" style="border-radius:5px;padding:20px;box-shadow:0px 0px 8px rgba(0,0,0,0.2);">
                               
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
    <script src="../controller/controller.js"></script>
</body>
</html>
