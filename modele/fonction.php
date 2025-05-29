<?php 
	include ('connexion.php');	
    
	function ajouter_client()
	{
		global $conn;
		$nom = strtoupper(securisation($_POST['nom']));
		$numStat = securisation($_POST['numStat']);
		$numNIF = securisation($_POST['numNIF']);
		$adresse = securisation($_POST['adresse']);
		$ville = securisation($_POST['ville']);
        $reqVerNom = $conn-> prepare("INSERT INTO client(nom,numSTAT,numNIF,adresse,ville) VALUES(?,?,?,?,?)");
        $reqVerNom -> execute(array($nom,$numStat,$numNIF,$adresse,$ville));
        echo json_encode(["res"=>1]);
	}

    function affiche_client()
	{
		global $conn;
		$req = $conn->prepare("SELECT * FROM client ORDER BY nom ASC");
		$req -> execute();
		$value ='<table id="tableClient" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>N° Stat</th>
                            <th>N° NIF</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>';
		while($data = $req->fetch())
		{
			$value.='<tr>
                        <td>CL'.$data["idCl"].'</td>
                        <td>'.$data["nom"].'</td>
                        <td>'.$data["numSTAT"].'</td>
                        <td>'.$data["numNIF"].'</td>
                        <td>'.$data["adresse"].'</td>
                        <td>'.$data["ville"].'</td>
                        <td>
                            <button class="btn btn-success btn-edit" onclick="ShowModalModClient('.$data["idCl"].')"><i class="bx bx-edit"></i></button>
                            <button class="btn btn-danger btn-delete" onclick="ShowModalSupClient('.$data["idCl"].')"><i class="bx bx-trash"></i></button>
                        </td>
                    </tr>';
		}
        $value .='</tbody>
                </table>';
		echo json_encode(['status'=>'success','html'=>$value]);
	}

    function obetenir_info_client()
	{
		global $conn;
		$id = securisation($_POST['id']);
		$req = $conn->prepare("SELECT * FROM client WHERE idCl=?");
		$req -> execute(array($id));
		$data = $req->fetch();
		$value = array($data["nom"],$data["numSTAT"],$data["numNIF"],$data["adresse"],$data["ville"],$data["idCl"]
    	);
		echo json_encode($value);
	}

    function modifierClient(){
		global $conn;
		$id = securisation($_POST['id']);
		$nom = securisation($_POST['nom']);
		$numSTAT = securisation($_POST['numSTAT']);
		$numNIF = securisation($_POST['numNIF']);
		$adresse = securisation($_POST['adresse']);
		$ville = securisation($_POST['ville']);
		$req = $conn->prepare("UPDATE client  SET nom=?,numSTAT=?,numNIF=?,adresse=?,ville=? WHERE idCl=?");
		$req -> execute(array($nom,$numSTAT,$numNIF,$adresse,$ville,$id));
        echo json_encode('success');
	}

    function supprimerClient()
	{
		global $conn;
		$id = securisation($_POST['id']);
		$req = $conn->prepare("DELETE FROM client WHERE idCl=?");
		$req -> execute(array($id));
        echo json_encode('success !');
	}
/* --------------------------------------partie piece---------------------------------------------------------*/

	function ajouterPiece()
	{
		global $conn;
		$des = securisation($_POST['des']);
		$UTE = securisation($_POST['UTE']);
		$pu = securisation($_POST['pu']);
        $reqInsPc = $conn-> prepare("INSERT INTO article(`des`,pu,UTE,qteStock) VALUES(?,?,?,?)");
        $reqInsPc -> execute(array($des,$pu,$UTE,0));
        echo json_encode(["res"=>1]);
	}

	function affichePiece()
	{
		global $conn;
		$req = $conn->prepare("SELECT * FROM article");
		$req -> execute();
		$value ='<table id="tablePiece" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Désignation</th>
                            <th>Prix</th>
                            <th>UTE</th>
                            <th>Qté Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>';
		while($data = $req->fetch())
		{	
			if($data["qteStock"] <= 2){
				$value.='<tr>
                        <td class="text-danger">P'.$data["idArt"].'</td>
                        <td class="text-danger">'.$data["des"].'</td>
                        <td class="text-danger">'.$data["pu"].'</td>
                        <td class="text-danger">'.$data["UTE"].'</td>
                        <td class="text-danger">'.$data["qteStock"].'</td>
                        <td>
                            <button class="btn btn-success btn-edit" onclick="ShowModalModPiece('.$data["idArt"].')"><i class="bx bx-edit"></i></button>
                            <button class="btn btn-danger btn-delete" onclick="ShowModalSupPiece('.$data["idArt"].')"><i class="bx bx-trash"></i></button>
                            <button class="btn btn-primary btn-stock" onclick="ajouterStock('.$data["idArt"].')"><i class="bx bx-plus"></i></button>
                        </td>
                    </tr>';
			}
			else 
			{
				$value.='<tr>
                        <td>P'.$data["idArt"].'</td>
                        <td>'.$data["des"].'</td>
                        <td>'.$data["pu"].'</td>
                        <td>'.$data["UTE"].'</td>
                        <td>'.$data["qteStock"].'</td>
                        <td>
                            <button class="btn btn-success btn-edit" onclick="ShowModalModPiece('.$data["idArt"].')"><i class="bx bx-edit"></i></button>
                            <button class="btn btn-danger btn-delete" onclick="ShowModalSupPiece('.$data["idArt"].')"><i class="bx bx-trash"></i></button>
                            <button class="btn btn-primary btn-stock" onclick="ajouterStock('.$data["idArt"].')"><i class="bx bx-plus"></i></button>
                        </td>
                    </tr>';
			}
		}
        $value .='</tbody>
                </table>';
		echo json_encode(['status'=>'success','html'=>$value]);
	}

	function obetenir_info_piece()
	{
		global $conn;
		$id = securisation($_POST['id']);
		$req = $conn->prepare("SELECT * FROM article WHERE idArt=?");
		$req -> execute(array($id));
		$data = $req->fetch();
		$value = array($data["des"],$data["UTE"],$data["idArt"],$data["pu"]);
		echo json_encode($value);
	}

	function modifierPiece(){
		global $conn;
		$id = securisation($_POST['idPc']);
		$des = securisation($_POST['des']);
		$UTE = securisation($_POST['UTE']);
		$pu = securisation($_POST['pu']);
		$req = $conn->prepare("UPDATE article  SET `des`=?,pu=?,UTE=? WHERE idArt=?");
		$req -> execute(array($des,$pu,$UTE, $id));
        echo json_encode('success');
	}

	function supprimerPiece()
	{
		global $conn;
		$id = securisation($_POST['id']);
		$req = $conn->prepare("DELETE FROM article WHERE idArt=?");
		$req -> execute(array($id));
        echo json_encode('success !');
	}

	function obtenirInfoStock()
	{
		global $conn;
		$id = securisation($_POST['id']);
		$req = $conn->prepare("SELECT `des` FROM article WHERE idArt=?");
		$req -> execute(array($id));
		$date = $req -> fetch();
        echo json_encode(["des" => $date['des']]);
	}
/* ------------------------------------------------partie vente ------------------------------------------------*/
	
	function verification_stock()
	{
		global $conn;
		$id = securisation($_POST['idArt']);
		$qte = securisation($_POST['qte']);
		$req = $conn->prepare("SELECT qteStock as stock ,`des`FROM article WHERE idArt=?");
		$req -> execute(array($id));
		$data = $req -> fetch();
	
		if($qte > $data["stock"]){
			echo json_encode(['etat'=> false, 'stock' => $data["stock"], 'des' => $data["des"]]);
		} else {
			echo json_encode(['etat'=> true]);
		}
	}

	function ajouterStock()
	{
		global $conn;
		$id = securisation($_POST['idArt']);
		$qteEnt = securisation($_POST['qteEnt']);
		$dateEnt = securisation($_POST['dateEnt']);
		$req = $conn->prepare("INSERT INTO stock(dateEnt, qteEnt, idArt) VALUES (?,?,?)");
		$req -> execute(array($dateEnt,$qteEnt,$id));
		
		$reqUp = $conn->prepare("UPDATE article SET qteStock=qteStock+? WHERE idArt=?");
		$reqUp -> execute(array($qteEnt,$id));
        echo json_encode("success");
	}

	function affiche_client_vente()
	{
		global $conn;
		$req = $conn->prepare("SELECT * FROM client ORDER BY idCl DESC");
		$req -> execute();
		$value ='<label for="idCl" class="form-label">Numéro client</label>
				<select name="" id="idCl" class="form-select">
					<option value="">Choisir un client !</option>
				';
		while($data = $req->fetch())
		{
			$value.='<option value="'.$data["idCl"].'">CL'.$data["idCl"].' - '.$data["nom"].'</option>';
		}
		$value .='</select>';
		echo json_encode(['status'=>'success','html'=>$value]);
	}


	function affichePieceVente()
	{
		global $conn;
		$req = $conn->prepare("SELECT * FROM article ORDER BY idArt ASC");
		$req -> execute();
		$value ='<label for="idArt" class="form-label">Désignation</label>
				<select name="" id="idArt" class="form-select">
					<option value="">Quelle pièce ! </option>';
		while($data = $req->fetch())
		{
			$value.='<option value="P'.$data["idArt"].'-'.$data["des"].'">P'.$data["idArt"].'-'.$data["des"].'</option>';
		}
        $value .='</select>';
		echo json_encode(['status'=>'success','html'=>$value]);
	}


	function ajouterVente()
	{
		global $conn;
		$idCl = securisation($_POST['idCl']);
		$date = securisation($_POST['date']);
		$heure = securisation($_POST['heure']);
		$liste = securisation($_POST['liste']);
		$jsonListe = json_decode($liste, true);
		$nb = count($jsonListe);
		$i = 0;
		while($i < $nb){
			$reqInsVente = $conn-> prepare("INSERT INTO vente(idCl,idArt,qte,`date`,heure) VALUES (?,?,?,?,?)");
        	$reqInsVente -> execute(array($idCl,$jsonListe[$i]['idArt'],$jsonListe[$i]['qte'],$date,$heure));

			$reqUpStock = $conn-> prepare("UPDATE article SET qteStock=qteStock-? WHERE idArt=?");
        	$reqUpStock -> execute(array($jsonListe[$i]['qte'],$jsonListe[$i]['idArt']));
			$i++;
		}

		$reqNumDate = $conn -> prepare("SELECT numFact,year(dateFact) as dateFact FROM facture WHERE id = (SELECT MAX(id) from facture)");
		$reqNumDate -> execute(array());
		$numFacture = "";
		$dateNow = "";
		while($dataNumDate = $reqNumDate->fetch()){
			$numFacture = $dataNumDate['numFact'];
			$dateNow =  $dataNumDate['dateFact'];
		}
		// echo $numFacture.'_'.$dateNow;
		if($numFacture == ""){
			$numFact = str_pad(1,3,'0',STR_PAD_LEFT).'/'.date('Y')[2].date('Y')[3];
			$reqFacture = $conn-> prepare("INSERT INTO facture(numFact,dateFact,heureFact,idCl) VALUES (?,?,?,?)");
        	$reqFacture -> execute(array($numFact,$date,$heure,$idCl));
		}
		elseif(number_format($dateNow) < number_format(date('Y'))){
			$numFact = str_pad(1,3,'0',STR_PAD_LEFT).'/'.date('Y')[2].date('Y')[3];
			$reqFacture = $conn-> prepare("INSERT INTO facture(numFact,dateFact,heureFact,idCl) VALUES (?,?,?,?)");
        	$reqFacture -> execute(array($numFact,$date,$heure,$idCl));
		}
		else{
			$numFact = $numFacture;
			$numFact = number_format($numFact[0].$numFact[1].$numFact[2])+1;
			$numFact = str_pad($numFact,3,'0',STR_PAD_LEFT).'/'.date('Y')[2].date('Y')[3];
			$reqFacture = $conn-> prepare("INSERT INTO facture(numFact,dateFact,heureFact,idCl) VALUES (?,?,?,?)");
        	$reqFacture -> execute(array($numFact,$date,$heure,$idCl));
		}
		echo 'success !';
	}
	
	function afficheVente()
	{
		global $conn;
		$req = $conn->prepare("SELECT client.idCl as idCl,nom,article.idArt as idArt,`des`,qte,`date`,heure FROM client,article,vente WHERE client.idCl=vente.idCl AND article.idArt=vente.idArt ORDER BY `date`,heure DESC");
		$req -> execute();
		$value ='<table id="tableVente" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Désignation</th>
                            <th>Qté</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>';
		while($data = $req->fetch())
		{
			$value.='<tr>
                        <td>'.$data["nom"].'</td>
                        <td>'.$data["des"].'</td>
                        <td>'.$data["qte"].'</td>
                        <td>'.$data["date"].'</td>
                        <td>'.$data["heure"].'</td>
                        <td>
                            <button class="btn btn-danger btn-delete" onclick="ShowModalSupVente('.$data["idCl"].','.$data["idArt"].','.$data["qte"].',\''.$data["date"].'\',\''.$data["heure"].'\')"><i class="bx bx-trash"></i></button>
                        </td>
                    </tr>';
		}
        $value .='</tbody>
                </table>';
		echo json_encode(['status'=>'success','html'=>$value]);
	}

	function supprimerVente()
	{
		global $conn;
		$idCl = securisation($_POST['idCl']);
		$idArt = securisation($_POST['idArt']);
		$qte = securisation($_POST['qte']);
		$date = securisation($_POST['date']);
		$heure = securisation($_POST['heure']);
		
		$reqUp = $conn->prepare("UPDATE article SET qteStock=qteStock+? WHERE idArt=?");
		$reqUp -> execute(array($qte,$idArt));

		$req = $conn->prepare("DELETE FROM vente WHERE idArt=? AND idCl=? AND `date`=? AND heure=?");
		$req -> execute(array($idArt,$idCl,$date,$heure));
        echo json_encode('success !');
	}
	/**********************************************partie accueil***************************************** */
	function chartLine()
	{
		global $conn;
		$req = $conn->prepare("SELECT `des`,qteStock FROM article ORDER BY qteStock ASC LIMIT 10");
		$req -> execute();
		$label = [];
		$dataDb = [];
		$i = 0;
		while($data = $req->fetch())
		{
			$label[$i] = $data["des"];
			$dataDb[$i]= $data["qteStock"];
			$i++;
		}
       
		echo json_encode(['label'=>$label,'dataDb'=>$dataDb]);
	}

	function etatDeStock()
	{
		global $conn;
		$idArt = securisation($_POST['idPiece']);
		$dateDeb = securisation($_POST['dateDeb']);
		$dateFin = securisation($_POST['dateFin']);
		
	
		/*------------------------ stocker entree -------------------------------*/
		$requete = $conn -> prepare("SELECT qteEnt,dateEnt FROM stock WHERE dateEnt BETWEEN ? AND ? AND idArt=?");
		$requete -> execute(array($dateDeb,$dateFin,$idArt));
		/* ---------------------------- stocker sorti ---------------------------------*/
		$requetetwo = $conn -> prepare("SELECT `date` AS dateSorti, qte AS qteSorti FROM vente WHERE `date` BETWEEN ? AND ? AND idArt=?");
		$requetetwo -> execute(array($dateDeb,$dateFin,$idArt));
		/************  nom de la voiture ************************************/

		$reqNom = $conn -> prepare("SELECT `des` FROM article WHERE idArt=?");
		$reqNom ->execute(array($idArt));
		$dataReqNom = $reqNom -> fetch();

		$valueE="";
		$valueS="";
		while(($data = $requete -> fetch()))
		{
			$valueE .='<tr>
							<td class="text-center">'.$data["dateEnt"].'</td>
							<td class="text-center">'.$data["qteEnt"].'</td>
					</tr>';		
		}
		while(($data1 = $requetetwo -> fetch()))
		{
			$valueS .='<tr>
							<td class="text-center">'.$data1["dateSorti"].'</td>
							<td class="text-center">'.$data1["qteSorti"].'</td>	
					</tr>';	
		}

		/*------------------------ stocker entree -------------------------------*/
		$requeteEntree = $conn -> prepare("SELECT SUM(qteEnt) AS totalEnt FROM stock WHERE dateEnt BETWEEN ? AND ? AND idArt=?");
		$requeteEntree -> execute(array($dateDeb,$dateFin,$idArt));
		/* ---------------------------- stocker sorti ---------------------------------*/
		$requeteSorti = $conn -> prepare("SELECT SUM(qte) AS totalSorti FROM vente WHERE `date` BETWEEN ? AND ? AND idArt=?");
		$requeteSorti -> execute(array($dateDeb,$dateFin,$idArt));

		$dataSorti = $requeteSorti -> fetch();
		$dataEntree = $requeteEntree -> fetch();

		echo json_encode(["htmlE"=>$valueE,"htmlS"=>$valueS,"nom"=>$dataReqNom['des'],"totalSorti"=>$dataSorti["totalSorti"],"totalEntree"=>$dataEntree["totalEnt"]]);
	}


	function creation_compte()
	{
		global $conn;
		$pseudo = securisation($_POST['pseudo']);

		$requete = $conn -> prepare("INSERT INTO user(pseudo,pwd,`admin`) VALUES (?,?,?)");
		$requete->execute(array($pseudo,password_hash("admin", PASSWORD_DEFAULT),0));
		echo 'reussi !';
	}
	
	function seConnecter()
	{
		global $conn;
		$pseudo = securisation($_POST['pseudo']);
		$pwd = securisation($_POST['pwd']);
		
		$requete = $conn -> prepare("SELECT * FROM user");
		$requete -> execute();
		$trouve = false;

		while(($data = $requete -> fetch()) && (!$trouve))
		{
			if($data['pseudo']==$pseudo && password_verify($pwd, $data['pwd']))
			{
				session_start();
				$_SESSION['connecte']=1;
				$_SESSION['id']=$data["id"];
				$_SESSION['admin']=$data["admin"];
				$trouve=true;
				$id=$data["id"];
			}
			else
				$trouve=false;
		}

		if($trouve)
		{

			echo json_encode([0,password_hash($id, PASSWORD_DEFAULT)]);
		}
		else
		{
			echo json_encode([1,"Mot de passe incorrect !"]);
		}
	}

	function modifierCompte()
	{
		global $conn;
		$pseudo = securisation($_POST['pseudo']);
		$idU = securisation($_POST['idU']);
		$requete = $conn -> prepare("UPDATE user SET pseudo=? WHERE id=?");
		$requete -> execute(array($pseudo,$idU));
		echo 'reussi ! ';
	}

	function changer_mot_passe()
	{
		global $conn;
		$pwd = securisation($_POST['pwd']);
		$n_pwd = securisation($_POST['n_pwd']);
		$id = securisation($_POST['idU']);

		$requete = $conn -> prepare("SELECT pwd FROM user WHERE id=?");
		$requete -> execute(array($id));
		$pwdSer=$requete->fetch();
		if(password_verify($pwd, $pwdSer["pwd"]))
		{
			$requete2 = $conn -> prepare("UPDATE user SET pwd=? WHERE id=?");
			$requete2-> execute(array(password_hash($n_pwd,PASSWORD_DEFAULT),$id));
			echo json_encode(['etat'=>0]);


		}
		else{
			echo json_encode(['etat'=>1]);
		}
	}
 ?>


	

