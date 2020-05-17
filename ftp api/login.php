<?
require_once('connection.php');
?>

<?php
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    try
    {
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $statement = $conn->prepare($query);
        $statement->execute(array($email, $password));
                $count = $statement->rowCount();
                if($count > 0)
                {
                    $_SESSION["email"] = $_POST["email"];
                    echo 'a';
                    header("location:login_success.php");
                }
                else
                {
                    $message = '<label>Wrong Data</label>';
                }
            }
    catch(PDOException $error)
    {
        $message = $error->getMessage();
    }
}
?>
