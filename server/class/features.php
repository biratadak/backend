<?php
class features
{
    // Checks if a string only contains alphabets and whitespaces

    //String methods here 
    function onlyAlpha($string)
    {
        if (preg_match("/^[a-zA-Z-' ]*$/", $string)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function onlyDigit($string)
    {
        if (preg_match("/^[1-9][0-9]{0,15}$/", $string))
            return TRUE;
        else
            return FALSE;
    }

    //Image methods here
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

    //Marks methods here

    //This section splits the $marks string and return array of different strings
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

    //Phone no validation
    function validPhoneNo($phoneNo)
    {
        if (preg_match("/^[+][9][1][6-9][0-9]{9}$/", $phoneNo))
            return TRUE;
        else
            return FALSE;
    }

    // E-Mail methods here

    //MailId validation
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

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=".$mailId,
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
        //checking format, mx, smtp, and deliverablity score for the mail
        if(json_decode($response)->format_valid==TRUE && json_decode($response)->mx_found==TRUE && json_decode($response)->smtp_check==TRUE ){
            echo "<br>(E-mail deliverablity score is: ".((json_decode($response)->score)*100)."% ).";
            return TRUE;
        }
        else{
        echo "<div class='error'>Error:";
        if(json_decode($response)->format_valid==FALSE){
        echo "E-mail format is not valid<br>";
        }
        if(json_decode($response)->mx_found==FALSE){
        echo "MX-Records not found<br>";
        }
        if(json_decode($response)->smtp_check==FALSE){
        echo "SMTP validation failed<br>";
        }
        echo "</div>";
        return false;
        }
    }
}

?>