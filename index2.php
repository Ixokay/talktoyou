<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1"/>
        <link rel="stylesheet" href="css/index.css">
        <title>talk to you</title>
        <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline';" />
    </head>
    
    <body>
        <h1 class="titre">Bienvenue sur ce tchat</h1>
        <p class="paragraphe">
            Parle avec tes amis sur <b>Talk To You !</b>
        </p>
        <p class="paragraphe">
            C'est gratuit, <b>inscris toi</b> 
            dès maintenant pour parler sans limite 
            ou <b>connecte toi</b> si tu es déjâ inscris !
        </p>
        <!-- navigation entre connexion et inscription -->
        <nav class="menu-nav">
            <ul>
                <li class="btn">
                    <a class="autre" href="index.php">
                        Inscris toi
                    </a>
                </li>
                <li class="btn">
                    <a class="page" href="index2.php">
                        Connecte toi
                    </a>
                </li>
            </ul>
        </nav>
        
        <?php    
            // php connexion 
            include 'includes/connexion.php';
        ?>
    </body>
</html>