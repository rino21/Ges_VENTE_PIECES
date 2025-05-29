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
    <title>Aziz Auto - Paramétre</title>
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
                                <div class="row">
                                    <?php if($_SESSION['admin']==1){?>
                                    <div class="col-md-6">
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <h6>Paramétre > <span class="text-primary" data-bs-toggle="collapse" data-bs-target="#demo">Créer un compte d'utilisateur</span></h6>
                                            </div>
                                        </div>
                                        <div id="demo" class="collapse">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="" id="form-creer-compte" class="-was-validated">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="mb-3 mt-3">
                                                                            <label for="pseudo" class="form-label">Pseudo</label>
                                                                            <input type="text" class="form-control" id="pseudo" placeholder="Pseudo d'utilisateur" name="pseudo" required>
                                                                            <div class="valid-feedback">Valid.</div>
                                                                            <div class="invalid-feedback">Veuillez remplir le champ  pseudo .</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="" class="form-label mt-3">.</label><br>
                                                                        <button type="button" class="btn btn-primary btn-block" onclick="creerCompte()">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="col-md-6">
                                        <div class="card mt-2"><div class="card-body">
                                            <h6>Paramétre > <span class="text-primary" data-bs-toggle="collapse" data-bs-target="#demo1">Modifier mon pseudo</span></h6>
                                        </div></div>
                                        <div id="demo1" class="collapse">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="" class="-was-validated" id="form-modifier-compte">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="mb-3 mt-3">
                                                                            <label for="m_pseudo" class="form-label">Pseudo</label>
                                                                            <input type="text" class="form-control" id="m_pseudo" placeholder="Pseudo d'utilisateur" name="m_pseudo" required>
                                                                            <div class="valid-feedback">Valid.</div>
                                                                            <div class="invalid-feedback">Veuillez remplir le champs de pseudo.</div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" id="idU" value="<?php echo $_SESSION['id']; ?>">
                                                                    <div class="col-md-4">
                                                                        <label for="" class="form-label mt-3">.</label><br>
                                                                        <button type="button" class="btn btn-primary btn-block" onclick="modifierCompte()">Modififer</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                                                
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h6>Paramétre > <span class="text-primary" data-bs-toggle="collapse" data-bs-target="#demo2">Changer mon mot de passe</span></h6>
                                    </div>
                                </div>
                                <div id="demo2" class="collapse">
                                    <div class="row mt-3">
                                        <div class="col-10">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="" class="-was-validated" id="form-change-pwd">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="mb-3 mt-3">
                                                                    <label for="pwd" class="form-label">Ancien mot de passe</label>
                                                                    <input type="password" class="form-control" id="pwd" placeholder="" name="pwd" required>
                                                                    <div class="valid-feedback">Valid.</div>
                                                                    <div class="invalid-feedback">Veuillez entrez l'ancien mot de passe.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="mb-3 mt-3">
                                                                    <label for="n_pwd" class="form-label">Nouveau mot de passe</label>
                                                                    <input type="password" class="form-control" id="n_pwd" placeholder="" name="n_pwd" required>
                                                                    <div class="valid-feedback">Valid.</div>
                                                                    <div class="invalid-feedback">Veuillez entrez le nouveau mot de passe.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="" class="form-label mt-3">.</label><br>
                                                                <button type="button" class="btn btn-primary" onclick="changePwd()">Changer</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="./js/chart.js"></script>
    <script src="../controller/parametre.js"></script>
</body>
</html>
