<?php

class login_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }


    public function check_data($email, $password)
    {
        $stmt = $this->conn->db->prepare("SELECT email,password FROM users WHERE email=:email;");
        $stmt->execute([
                'email' => $email,

        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            return true;
        }

        return false;
    }

    public function get_username($email)
    {
        $stmt = $this->conn->db->prepare("SELECT fname,lname FROM users WHERE email=:email");
        $stmt->execute([
                'email' => $email,

        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

//if ($result && password_verify($password, $result['password'])) {
//header("Location: ../views/sucess.php");
//exit();
//}
}