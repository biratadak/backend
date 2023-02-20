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
    $this->SetFillColor(193, 231, 255);
    $this->SetFont('Arial','',20);
    $this->SetTextColor(255, 121, 0);
    $this->Cell(95,20,'INNO',0,0,'R',TRUE);
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

function setDetails($name="N/A",$mailId="N/A",$marks=array(array("N/A",0)),$mobileNo="N/A"){
$this->name=$name;
$this->mailId=$mailId;
$this->marks=$marks;
$this->mobileNo=$mobileNo;
}

}

?> 