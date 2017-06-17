
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
        // Saut de ligne
        $this->Ln(20);
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
$pdf->Cell(40,10,'VINS DE l\'ASSOCIATION : ');



$reponse=$bdd->query('SELECT * FROM vins;');

$hauteur=75;
$pdf->SetFont('Times','B',12);
while($donnee = $reponse->fetch())
     {

$pdf->Text(30,$hauteur,utf8_decode($donnee['vin_nom']));
$pdf->Text(100,$hauteur,utf8_decode($donnee['vin_annee']));
$pdf->Text(132,$hauteur,utf8_decode($donnee['vin_couleur']));
         $hauteur+=8;
     }

$position_entete = 58;

function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position_entete);
    $pdf->SetX(28);
    $pdf->Cell(68,8,'Nom',1,0,'L',1);
    $pdf->SetX(98);
    $pdf->Cell(30,8,'Annee',1,0,'L',1);
    $pdf->SetX(130); // 8 + 96
    $pdf->Cell(30,8,'Couleur',1,0,'C',1);
    $pdf->SetX(68); // 8 + 96
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);


$pdf->Output();
?>
