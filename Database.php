<?php
class Database
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "root"; // Fixed typo
    protected $dbname = "LibraryManagementSystem";
    public $db;
    public $stmt;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die("Database connection failed");
        }
    }

    // Function to generate a unique username
    private function generateUsername($fname, $lname)
    {
        do {
            // Create a username by concatenating fname, lname, and a random number
            $username = strtolower($fname . $lname . rand(100, 999));

            // Check if the username exists in the database
            $this->stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $this->stmt->execute(['username' => $username]);
            $count = $this->stmt->fetchColumn();

            // If count is 0, the username is unique; otherwise, regenerate
        } while ($count > 0);

        return $username;
    }

    public function create($fname, $lname, $email, $password)
    {
        try {
            // Generate a unique username
            $username = $this->generateUsername($fname, $lname);

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $this->stmt = $this->db->prepare('
                INSERT INTO users (fname, lname, username, password, email)
                VALUES (:fname, :lname, :username, :password, :email)
            ');

            // Execute with bound parameters
            $result = $this->stmt->execute([
                    'fname' => $fname,
                    'lname' => $lname,
                    'username' => $username,
                    'password' => $hashedPassword,
                    'email' => $email
            ]);

            // Return success or failure response
            return $result ? "User successfully created with username: $username" : "Failed to create user";

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
