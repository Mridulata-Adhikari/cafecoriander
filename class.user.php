<?php


require_once 'db_config.php';

class USER
{

    private $conn; //create database connection

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function lasdID() //find the last id number to determine the current id number
    {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }

    public function register($uname,$email,$upass,$code) //preparing and inserting registration
    {
        try
        {
            $password = password_hash($upass, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode) 
                                                VALUES(:user_name, :user_mail, :user_pass, :active_code)");
            $stmt->bindparam(":user_name",$uname);
            $stmt->bindparam(":user_mail",$email);
            $stmt->bindparam(":user_pass",$password);
            $stmt->bindparam(":active_code",$code);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function login($email,$password) //the login 
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
            $stmt->execute(array(":email_id"=>$email));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() == 1)
            {
                if($userRow['userStatus']=="Y")
                {
                    if(password_verify($password, $userRow['userPass']))
                    {
                        $_SESSION['userSession'] = $userRow['userID'];
                        return true;
                    }
                    else
                    {
                        header("Location: index.php?error");
                        exit;
                    }
                }
                else
                {
                    header("Location: index.php?inactive");
                    exit;
                }
            }
            else
            {
                header("Location: index.php?error");
                exit;
            }
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }


    public function is_logged_in() //logged in
    {
        if(isset($_SESSION['userSession']))
        {
            return true;
        }
    }

    public function redirect($url) //redirection function used throughout app
    {
        header("Location: $url");
    }

    public function logout() //the logout
    {
        session_destroy();
        $_SESSION['userSession'] = false;
    }

    function send_mail($email,$message,$subject)  //all the mail settings for verification emails
    {
        require 'mailer/PHPMailerAutoload.php';
        $mail = new PHPMailer(); //create a new object
        $mail->IsSMTP(); //enable SMTP
        $mail->SMTPDebug  =1; //debugging: 1 errors and messages, 2 messages only. Made 0 for production
        $mail->SMTPAuth   = true; //authentication enabled
        $mail->SMTPSecure = "ssl"; //secure transfer enabled required for gmail
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465; //or try 587
        $mail->IsHTML(true);
        $mail->AddAddress($email);
        $mail->Username="lata6043@gmail.com";
        $mail->Password="RandomPassword12345";
        $mail->SetFrom('lata6043@gmail.com','Cafe Coriander');
        $mail->AddReplyTo("mridulataadhikari@gmail.com","Cafe Coriander");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();


    }
}