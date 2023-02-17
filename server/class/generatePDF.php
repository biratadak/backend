<?php
require('fpdf/fpdf.php');
class PDF extends FPDF
{
   public $name;
   public $mailId;
   public $marks;
   public $mobileNo;
// Page header

function Header()
{
    // Logo
    // $this->Image('logo.png',10,6,30);
    // set  fill color to grey
    $this->SetFillColor(193, 231, 255);
    // $this->SetFillColor(0, 51, 82);
    $this->SetFont('Arial','',20);
    $this->SetTextColor(255, 121, 0);
    $this->Cell(95,20,'INNO',0,0,'R',TRUE);
    // $this->SetFillColor(255, 121, 0);
    $this->SetFont('Arial','B',20);
    $this->SetTextColor(0, 51, 82);
    $this->Cell(95,20,'RAFT',0,0,'L',TRUE);
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function setDetails($name="N/A",$mailId="N/A",$marks="N/A",$mobileNo="N/A"){
$this->name=$name;
$this->mailId=$mailId;
$this->marks=$marks;
$this->mobileNo=$mobileNo;
}

// function downloadPDF(){
//     $this->AliasNbPages();
//     $this->AddPage();
//     $this->Ln(10);
//     // $this->Image('logo.jpeg', 10, 40, 20);
//     $this->SetFont('Times','',12);
//     $this->Cell(40,10,'Name:'.$this->name,0,1,'R');
//     $this->Cell(44,10,'Mail ID: '.$this->mailId,0,1,'R');
//     $this->Cell(49,10,'Mobile No: '.$this->mobileNo,0,1,'R');
//     // $this->Cell(0,10,'Marks: '.$this->marks,0,1);
//     $this->Ln(10);
//     $this->SetFillColor(194, 330, 230);
    
//     $this->Cell(95,10,'Subject'.$this->marks,1,0,'C',TRUE);
//     $this->Cell(95,10,'Marks'.$this->marks,1,1,'C',TRUE);
//     // $this->Output('D',"dsa.pdf");
// }
}

// Instanciation of inherited class

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(10);
$pdf->Image('logo.jpeg', 10, 40, 20);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,10,'Name:'.$pdf->name,0,1,'R');
$pdf->Cell(44,10,'Mail ID: '.$pdf->mailId,0,1,'R');
$pdf->Cell(49,10,'Mobile No: '.$pdf->mobileNo,0,1,'R');
// $pdf->Cell(0,10,'Marks: '.$pdf->marks,0,1);
$pdf->Ln(10);
$pdf->SetFillColor(194, 330, 230);

$pdf->Cell(95,10,'Subject'.$pdf->marks,1,0,'C',TRUE);
$pdf->Cell(95,10,'Marks'.$pdf->marks,1,1,'C',TRUE);
$pdf->Output();

// To download pdf in server side
// $pdf->Output('../uploaded_PDFs/Marksheet.pdf','F');
// To download pdf in client side
// $pdf->Output('Marksheet.pdf','D');
?>