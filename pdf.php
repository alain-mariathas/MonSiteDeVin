
<?php
session_start();

// Sous WAMP (Windows)
include_once ("post_bdd_conn.php");
require('lib/fpdf181/fpdf.php');

class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('img/vin_card.jpg',8,2,40);
        $this->Ln(15);
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,'www.monSiteDeVin.fr',0,0,'C');
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Cell(30,2,'MonSiteDeVin.fr');
$pdf->Ln(20);
$pdf->Cell(0,10,utf8_decode($_POST['nom_vin']),0,0,'C');
$pdf->Ln(10);



$hauteur=75;
$pdf->SetFont('Times','B',12);
$marge=60;
$pdf->Text($marge,$hauteur,utf8_decode($_POST['nom_vin']));
$pdf->Text($marge,$hauteur+=12,utf8_decode($_POST['annee_vin']));
$pdf->Text($marge,$hauteur+=12,utf8_decode($_POST['couleur_vin']));
$pdf->Text($marge,$hauteur+=12,utf8_decode($_POST['region_vin']));
$pdf->Text($marge,$hauteur+=12,utf8_decode($_POST['domaine_vin']));
 $pdf->SetXY($marge,$hauteur+=12);
$pdf->MultiCell(100,5,utf8_decode($_POST['description_vin']),0,'J',0,8);


$position_entete = 58;

function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position_entete+12);
    $pdf->Cell(40,8,'Nom',1,0,'L',1);
    $pdf->SetY($position_entete+24);
    $pdf->Cell(40,8,'Annee',1,0,'L',1);
    $pdf->SetY($position_entete+36);
    $pdf->Cell(40,8,'Couleur',1,0,'L',1);
    $pdf->SetY($position_entete+48);
    $pdf->Cell(40,8,'Region',1,0,'L',1);
    $pdf->SetY($position_entete+60);
    $pdf->Cell(40,8,'Domaine',1,0,'L',1);
    $pdf->SetY($position_entete+72);
    $pdf->Cell(40,8,'Description',1,0,'L',1);
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);


$pdf->Output();
?>
