<?php
require('fpdf185/fpdf.php');
require('fpdf185/ChiffresEnLettres.php');
include 'modele/connexion.php';

$idF = $_GET["idFact"];
$facture = $conn->prepare("SELECT * FROM facture INNER JOIN client WHERE facture.idCl=client.idCl AND facture.numFact=?");
$facture->execute(array($idF));
$data = $facture->fetch();
$idCl = $data["idCl"];
$nom = $data["nom"];
$stat = $data["numSTAT"];
$nif = $data["numNIF"];
$adresse = $data["adresse"];
$ville= $data["ville"];
$date = $data["dateFact"];
$heure = $data["heureFact"];
$datFacture = new DateTime($date);

$vente = $conn->prepare("SELECT * FROM client INNER JOIN vente,article WHERE client.idCl=vente.idCl AND article.idArt=vente.idArt AND vente.idCl=? AND vente.date=? AND vente.heure=?");
$vente->execute(array($idCl,$date,$heure));

$pdf = new FPDF('P', 'mm', 'A5');
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Image('Logo/logo1.jpg',10,10,18,18);
$pdf->Image('Logo/croix.jpg',25,23,4,4);
$pdf->SetFont('Times','',5);
$pdf->Text(33,13,utf8_decode('Pièces détachées Auto-Camion'));
$pdf->Text(34,16,utf8_decode('Spécialité Piéces Japonaises'));
$pdf->Text(29,19,utf8_decode('LUBRIFIANTS-PNEUMATIQUE-BATTERIE-VULCA'));
$pdf->SetFont('Times','',4);
$pdf->Text(35,22,utf8_decode('Tél: 034 07 624 54 - 034 02 055 51'));
$pdf->Text(37,24,utf8_decode('E-mail: aziz.auto@outlook.com'));
$pdf->Text(33,26,utf8_decode('Sanfil en face de l\'hôtel SOAVADIA - BP 594'));
$pdf->Text(42,28,utf8_decode('TOLIARA'));
$pdf->SetFont('Times','',6);
$pdf->Ln(22);
$pdf->Cell(0,5,utf8_decode('STAT N° 45501-51-2000-0-00075'),0,0);
$pdf->Ln(5);
$pdf->Cell(0,5,utf8_decode('NIF N° 4000101895'),0,0);
$pdf->Ln(5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetFont('Times','B',18);
$pdf->Cell(130,10,utf8_decode('FACTURE N° 033/23'),0,1,'C',True);
$pdf->SetFont('Arial','U',10);
$pdf->Cell(60,10,utf8_decode("DOIT :"),0,0,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,10,utf8_decode($nom),0,1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(60,10,utf8_decode(""),0,0,'R');
$pdf->Cell(40,5,utf8_decode("STAT N° ".$stat),0,1);
$pdf->Cell(60,10,utf8_decode(""),0,0,'R');
$pdf->Cell(40,5,utf8_decode(" NIF N° ".$nif),0,1);
$pdf->Cell(60,8,utf8_decode($adresse.' - '),0,0,'R');
$pdf->Cell(40,8,utf8_decode($ville),0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(80,8,utf8_decode(""),0,0,'R');
$pdf->Cell(40,8,utf8_decode("DATE : ".$datFacture->format("d/m/Y")),0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,7,'DESIGNATION',1,0);
$pdf->Cell(15,7,'UTF',1,0);
$pdf->Cell(15,7,'QTE',1,0);
$pdf->Cell(25,7,'PRIX EN (AR)',1,0);
$pdf->Cell(32,7,'MONTANT EN (AR)',1,1);
$pdf->SetFont('Arial','',8);

$montant= 0;
$total =0;
while($prod = $vente->fetch()){
    $montant = $prod["pu"] * $prod["qte"];
    $total = $total + $montant;
    $pdf->Cell(40,7,$prod["des"],1,0);
    $pdf->Cell(15,7,$prod["UTE"],1,0);
    $pdf->Cell(15,7,$prod["qte"],1,0);
    $pdf->Cell(25,7,$prod["pu"],1,0);
    $pdf->Cell(32,7,$montant,1,1);
}
$tva = $total * 0.2;
$ttc = $tva+$total;

$pdf->Cell(40,7,'',0,0);
$pdf->Cell(55,7,'MONTANT H.T',1,0,'C');
$pdf->Cell(32,7,$total,1,1);

$pdf->Cell(40,7,'',0,0);
$pdf->Cell(55,7,'TVA 20%',1,0,'C');
$pdf->Cell(32,7,$tva,1,1);

$pdf->Cell(40,7,'',0,0);
$pdf->Cell(55,7,'MONTANT TTC',1,0,'C');
$pdf->Cell(32,7,$ttc,1,1);

$pdf->SetFont('Arial','',9);
$pdf -> Ln(5);
$lettre = new ChiffreEnLettre();
$res = strtoupper($lettre->Conversion($ttc));
$pdf->Cell(60,9,utf8_decode('Arrêtée la présente Facture à la somme de '),0,0,'L');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,9,utf8_decode(': '.$res.' Ariary'),0,1,'L');

$pdf->Cell(40,7,'',0,0);
$pdf->Cell(55,7,'',0,0,'');
$pdf->Cell(32,7,utf8_decode("Le fourniseur,"),0,1);
$pdf->Output();

?>