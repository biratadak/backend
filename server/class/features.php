<?php
require('generatePDF.php');

class features
{
    public $name,$mailId,$marks,$phoneNo,$imagePath;
    // Checks if a string only contains alphabets and whitespaces

    //String methods here 

    // Fucntion to check the string only has alphabets
    function onlyAlpha($string)
    {
        if (preg_match("/^[a-zA-Z-' ]*$/", $string)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // Fucntion to check the string only has digits
    function onlyDigit($string)
    {
        if (preg_match("/^[1-9][0-9]{0,15}$/", $string))
            return TRUE;
        else
            return FALSE;
    }

    // Image methods here
    function validImage($imageSize, $imageType)
    {
        if (($imageSize / 1000) <= 500 && ($imageType == 'image/jpg' || $imageType == 'image/png' || $imageType == 'image/jpeg')) {
            return TRUE;
        } else {
            if (($imageSize / 1000) > 500) {
                echo "<br>Image size should be less than 500KB (" . ($imageSize / 1000) . "KB given)";
            }
            if ($imageType != 'image/jpg' || $imageType != 'image/png' || $imageType != 'image/jpeg') {
                echo "<br>Only Jpeg, Jpg & Png are allowed (" . $imageType . " given)";
            }
            return FALSE;
        }

    }

    // Marks methods here

    // This section splits the $marks string and return array of different strings
    function splitMarks($marks)
    {
        $lines = array();
        $index = 1;
        foreach (explode("\n", $marks) as $line) {
            if (str_contains($line, '|'))
                $lines[] = array(explode("|", $line)[0], explode("|", $line)[1]);
            else
                echo "<br>wrong syntax in line " . $index . ".";
            $index++;
        }
        return $lines;
    }

    // Phone No methods here

    // Phone no validation
    function validPhoneNo($phoneNo)
    {
        if (preg_match("/^[+][9][1][6-9][0-9]{9}$/", $phoneNo))
            return TRUE;
        else
            return FALSE;
    }

    // E-Mail methods here

    // MailId validation with Regex
    function validMailId1($mailId)
    {
        if (preg_match("/^[a-z-.]{1,20}[@][a-z]{1,10}[.][c][o][m]$/", $mailId))
            return TRUE;
        else
            return FALSE;
    }

    function validMailBox($mailId)
    {
        $curl = curl_init();
        // Mailbox Layer API calling
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $mailId,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: text/plain",
                    "apikey: H2AIxxMvhiT1uUKhxs7TuSMJmysHASNI"
                ),
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => TRUE,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        // Checking format, mx, smtp, and deliverablity score for the mail
        if (json_decode($response)->format_valid == TRUE && json_decode($response)->mx_found == TRUE && json_decode($response)->smtp_check == TRUE) {
            echo "<br>(E-mail deliverablity score is: " . ((json_decode($response)->score) * 100) . "% ).";
            return TRUE;
        } else {
            echo "<div class='error'>Error:";
            if (json_decode($response)->format_valid == FALSE) {
                echo "E-mail format is not valid<br>";
            }
            if (json_decode($response)->mx_found == FALSE) {
                echo "MX-Records not found<br>";
            }
            if (json_decode($response)->smtp_check == FALSE) {
                echo "SMTP validation failed<br>";
            }
            echo "</div>";
            return false;
        }
    }


    // PDF section
    function setPDF($name="N/A", $mailId="N/A" , $marks=array(array("N/A","00")), $phoneNo="N/A" , $imagePath="logo.jpeg"){
        $this->name=$name;
        $this->mailId=$mailId;
        $this->marks=$marks;
        $this->phoneNo=$phoneNo;
        $this->imagePath=$imagePath;


    }
    function getPDF()
    {

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->setDetails($this->name, $this->mailId, $this->marks, $this->phoneNo);

        $pdf->Ln(10);
        $pdf->Image($this->imagePath, 165, 35, 30, 35);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(25, 10, 'Name:' . $pdf->name, 0, 1, '');
        $pdf->Cell(29, 10, 'Mail ID: ' . $pdf->mailId, 0, 1, '');
        $pdf->Cell(34, 10, 'Mobile No: ' . $pdf->mobileNo, 0, 1, '');
        $pdf->Ln(10);

        $pdf->SetFillColor(194, 330, 230);
        $pdf->Cell(95, 10, 'Subject', 1, 0, 'C', TRUE);
        $pdf->Cell(95, 10, 'Marks', 1, 1, 'C', TRUE);
        foreach($this->marks as $m){
            $pdf->Cell(95, 10, $m[0], 1, 0, 'C');
            $pdf->Cell(95, 10, $m[1], 1, 1, 'C');
      
        }
        // $pdf->Output();
        
        // To download pdf in server side
        $pdf->Output('../uploaded_PDFs/Marksheet.pdf','F');
        // To download pdf in client side
        $pdf->Output('Marksheet.pdf','D');

    }



}


?>