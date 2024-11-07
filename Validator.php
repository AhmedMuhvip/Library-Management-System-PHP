<?php
require_once 'Database.php';
class Validator
{
    // Validate a string input, returning sanitized string or false if invalid
    public static function input_empty($fname,$lanme,$email,$password)
    {
    if(empty($fname)||empty($lanme)||empty($email)||empty($password)){
        return true;
    }
    else{
        return false;
    }
    }

   public static function is_email_invalid(string $email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }


    public static function string($value)
    {
        $value = trim($value);
        $value = stripslashes($value);

        $value=htmlspecialchars($value);
        return $value;

    }
public static function  email_registered($value)
{
//    $value=strtolower($value);
$db=new Database();
$stmt=$db->db->prepare("SELECT email FROM users WHERE email =:email;");
$stmt->execute([
        'email'=>$value
]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

return $result;
}

}


