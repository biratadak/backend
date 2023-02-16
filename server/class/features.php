<?php
class features
{
    // Checks if a string only contains alphabets and whitespaces

    //String methods here 
    function onlyAlpha($string)
    {
        if (preg_match("/^[a-zA-Z-' ]*$/", $string)) {
            return true;
        } else {
            return false;
        }
    }

    function onlyDigit($string)
    {
        if (preg_match("/^[0-9]*$/", $string))
            return true;
        else
            return false;
    }

    //Image methods here
    function validImage($imageSize, $imageType)
    {
        if (($imageSize / 1000) <= 500 && ($imageType == 'image/jpg' || $imageType == 'image/png' || $imageType == 'image/jpeg')) {
            return true;
        } else {
            if (($imageSize / 1000) > 500) {
                echo "<br>Image size should be less than 500KB (" . ($imageSize / 1000) . "KB given)";
            }
            if ($imageType != 'image/jpg' || $imageType != 'image/png' || $imageType != 'image/jpeg') {
                echo "<br>Only Jpeg, Jpg & Png are allowed (" . $imageType . " given)";
            }
            return false;
        }

    }

    //Marks methods here

    //This section splits the $marks string and return array of different strings
    function splitMarks($marks)
    {
        $lines = array();
        foreach (explode("\n", $marks) as $line) {
            $lines[] = array(explode("|", $line)[0], explode("|", $line)[1]);
        }
        return $lines;
    }


}

?>