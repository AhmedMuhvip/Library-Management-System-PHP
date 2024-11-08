<?php

class signup_model
{
    protected Database $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function createUser($fname, $lname, $email, $password)
    {
// Generate a unique username
        $username = $this->generateUsername($fname, $lname);

// Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
        $stmt = $this->conn->db->prepare('
INSERT INTO users (fname, lname, username, password, email)
VALUES (:fname, :lname, :username, :password, :email)
');

// Execute with bound parameters
        $result = $stmt->execute([
                'fname'    => $fname,
                'lname'    => $lname,
                'username' => $username,
                'password' => $hashedPassword,
                'email'    => $email,
        ]);

        return $result;
    }


    public function generateUsername($fname, $lname)
    {
        do {
            $username = strtolower($fname.$lname.random_int(100, 999));

            $stmt = $this->conn->db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $count = $stmt->fetchColumn();
        } while ($count > 0);

        return $username;
    }

    public function get_email($value)
    {
//        $value=strtolower($value);
        $stmt = $this->conn->db->prepare("SELECT email FROM users WHERE email =:email;");
        $stmt->execute([
                'email' => $value,
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

}