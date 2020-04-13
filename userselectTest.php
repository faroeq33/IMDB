<!doctype html>
<html lang="en">
<body>
<form action="<? $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" placeholder="Username" name="user[username]">
    <input type="submit" value="Registreer">
</form>
</body>
</html>

<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "rootpassword";
$dbname = "imdb";


try {
    $dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $dbuser, $dbpassword);
    //echo "Connectie was succesvol";
} catch (PDOException $e) {
    echo "Connectie is niet gelukt: " . $e->getMessage();
}

try
{
    $user = $_POST['user'];
    $username = $user['username'];

    $stmt = $pdo->prepare("SELECT username FROM `User` WHERE (username = :username)");
    $stmt->bindParam(':username',$username);
    $stmt->execute();
    $data = $stmt->fetchAll();

    foreach ($data as $row) {
        echo var_dump( $row['username'] )."<br />\n";
    }
}
catch (PDOException $exception)
{
    echo "oh nee! je code is kaka.";
    echo $exception;
}


?>

