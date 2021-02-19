<!-- connexion à la database -->
<?php
    define('HOST', 'localhost');
    define('DB_NAME', 'application');
    define('USER', 'root');
    define('PASS', '');

    try{
        $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // si problème ajouté ligne si dessous
        // echo "Connect > OK !";
    }catch(PDOException $e){
        echo $e;
    }
?>
