<?php
class Account
{
    private $con;
    private $error;
    public function __construct($con)
    {
        $this->error = array();
        $this->con = $con;
    }
    public function login($u, $p)
    {
        $p = md5($p);
        $login = mysqli_query($this->con, "SELECT * FROM users WHERE username='$u' AND password='$p'");
        if (mysqli_num_rows($login) == 1) {
            return true;
        } else {
            array_push($this->error, "Username or password do not match");
        }
    }

    private function setUserData($u, $f, $l, $e, $p)
    {
        $encryptP = md5($p);
        $profilePic = "assets\images\profilePic\head_emerald.png";
        $date = date("Y-m-d");
        $register = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$u', '$f', '$l', '$e', '$encryptP', '$date', '$profilePic')");
        return $register;
    }
    public function register($u, $f, $l, $e, $p, $p2)
    {
        $this->validateUsername($u);
        $this->validateFirst($f);
        $this->validateLast($l);
        $this->validateEmail($e);
        $this->validatePassword($p, $p2);
        if (empty($this->error) == true) {
            $result = $this->setUserData($u, $f, $l, $e, $p);
            if ($result == true) {
                $_SESSION["userLoggedIn"] = $u;

                header("Location:index.php");
            }
        } else
            return false;
    }

    public function getError($e)
    {
        if (!in_array($e, $this->error)) {
            $e = "";
        }
        return "<span class='errorMessage'>$e</span>";
    }
    private function validateUsername($u)
    {
        if (strlen($u) > 20 || strlen($u) < 5) {
            array_push($this->error, "Username must be between 5 to 20 characters");
            return;
        }
        $usernameQ = mysqli_query($this->con, "SELECT username FROM users WHERE username = '$u'");
        if (mysqli_num_rows($usernameQ) != 0) {
            array_push($this->error, "Username already taken");
            return;
        }
    }
    private function validateFirst($f)
    {
        if (strlen($f) > 20 || strlen($f) < 2) {
            array_push($this->error, "First name must be between 2 to 20 characters");
            return;
        }
    }
    private function validateLast($l)
    {
        if (strlen($l) > 20 || strlen($l) < 2) {
            array_push($this->error, "Last name must be between 2 to 20 characters");
            return;
        }
    }
    private function validateEmail($e)
    {
        if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            array_push($this->error, "Invalid Email Address");
            return;
        }
        $emailQ = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$e'");
        if (mysqli_num_rows($emailQ) != 0) {
            array_push($this->error, "Email is already in use by another user");
            return;
        }
    }
    private function validatePassword($p, $p2)
    {
        if ($p != $p2) {
            array_push($this->error, "Passwords do not match");
            return;
        }
        if (preg_match('/[^A-Za-z0-9]/', $p)) {
            array_push($this->error, "Passwords must only contain characters and numbers");
            return;
        }
        if (strlen($p) > 20 || strlen($p) < 5) {
            array_push($this->error, "Password must be between 5 to 20 characters");
            return;
        }
    }
}
