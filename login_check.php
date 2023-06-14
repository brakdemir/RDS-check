<?php
$host = 'your RDS endpoint';
$dbname = 'your db name';
$user = 'your db username';
$password = 'your db password';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $user_password = $_POST['pass'];

    try {
        $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM staff WHERE username = :username AND password = :password";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $user_password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "Login successful.";
        } else {
            echo "username or password is wrong.";
        }
    } catch (PDOException $e) {
        echo "Connection error" . $e->getMessage();
    }
}
?>
