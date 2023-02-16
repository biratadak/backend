<?php
class person
{
    private $fname, $lname;
    function __construct($fname = "noFirstName", $lname = "noLastName")
    {
        $this->fname = $fname;
        $this->lname = $lname;
    }
    // Names methods are here 
    function getFullName()
    {
        return $this->fname . " " . $this->lname;
    }
    function getFName()
    {
        return $this->fname;
    }
    function getLName()
    {
        return $this->lname;
    }

    public $marks;
    // Marks methods are here
    function setMarks($marks)
    {
        $this->marks = $marks;
    }
    function getMarks()
    {
        return $this->marks;
    }

} ?>