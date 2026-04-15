<?php
// Jonathan Blackwood 
//HND Software Development 
// Classes page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser

class Staff { // Create class Staff 
    private $staffID;
    private $fname;
    private $lname;
    private $age;
    private $role;
    private $wage;
    private $startdate;
    private $user_id; // Declare private variables of class - staff information to be used

    public function getStaffID() { // Get staffID, no setter as primary
        return $this->staffID;
    }

    public function getFname() { // Get first name
        return $this->fname;
    }

    public function setFname($fname) { // Set first name
        $this->fname = $fname;
    }

    public function getLname() { // Get last name
        return $this->lname;
    }

    public function setLname($lname) { // Set last name
        $this->lname = $lname;
    }

    public function getAge() { // Get age
        return $this->age;
    }

    public function setAge($age) { // Set age
        $this->age = $age;
    }

    public function getRole() { // Get Role
        return $this->role;
    }

    public function setRole($role) { // Set role
        $this->role = $role;
    }

    public function getWage() { // Get wage
        return $this->wage;
    }

    public function setWage($wage) { // Set wage
        $this->wage = $wage;
    }

    public function getStartdate() { // Get start date
        return $this->startdate;
    }

    public function setStartdate($startdate) { // Set start date
        $this->startdate = $startdate;
    }

    public function getUserID() { // Get userID, no setter as primary key
        return $this->user_id;
    }

}

?>
