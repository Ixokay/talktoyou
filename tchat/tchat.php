<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1"/>
        <link rel="stylesheet" href="css/tchat.css">
        <link rel="stylesheet" href="css/tchatmobile.css">
        <title>talk to you</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <?php 
        include 'includes/database.php';
        global $db;
        session_start();
        $qpseudo = $db->prepare("SELECT * FROM ban WHERE pseudo = :pseudo AND tchat = :tchat");
        $qpseudo->execute([
            'pseudo' => $_SESSION['pseudo'],
            'tchat' => $_GET['tchat']
        ]);
        $result = $qpseudo->fetch();

        $banpseudo = $db->prepare("SELECT * FROM ban Where pseudo = :pseudo AND tchat = :tchat");
        $banpseudo->execute([
            'pseudo' => $_SESSION['pseudo'],
            'tchat' => 749027364
        ]);
        $banresult = $banpseudo->fetch();

        if(isset($_SESSION['pseudo'])) {
            if($result == false) {
                if($banresult == false) {
                    if($_SESSION['connect'] == true) {
                        $q = $db->prepare("INSERT INTO connecter(pseudo,tchat) VALUES(:pseudo,:tchat)");
                        $q->execute([
                            'pseudo' => $_SESSION['pseudo'],
                            'tchat' => $_GET['tchat']
                        ]);
                        $_SESSION['connect'] = false;
                    }
                    $qniveau1op = $db->prepare("SELECT * FROM niveau1op WHERE tchat = :tchat");
                    $qniveau1op->execute([
                        'tchat' => $_GET['tchat']
                    ]);
                    $resultniveau1op = $qniveau1op->fetch();

                    if($resultniveau1op == true){

                    }else {
                        $q = $db->prepare("INSERT INTO niveau1op(tchat,pseudo) VALUES(:tchat,:pseudo)");
                        $q->execute([
                            'tchat' => $_GET['tchat'],
                            'pseudo' => $_SESSION['pseudo']
                        ]); 
                    }
                    ?>
                    
                    <button onclick="Compte()">Compte</button>

                    <div id="hautDePage" style="display:none;" class="compteDeconnexion">
                        <?php include 'includes/boutontchat.php'; ?>
                    </div>

                    <script>
                        function Compte() {
                            var compteBoutton = document.getElementById("hautDePage");
                            var message = document.getElementById("basDePage");
                            if (compteBoutton.style.display === "none") {
                                compteBoutton.style.display = "block";
                                message.style.display = "none";
                            } else if (compteBoutton.style.display === "block") {
                                compteBoutton.style.display = "none";
                                message.style.display = "block";
                            }
                        }
                    </script>

                    <?php
                    $qnom = $db->prepare('SELECT * FROM nomchat WHERE tchat = :tchat ORDER BY id desc LIMIT 1');
                    $qnom->execute(['tchat' => $_GET['tchat']]);
                    $nom = $qnom->fetch();
                    $name = $nom['name'];
                    ?>
                
                    <div id="basDePage" style="display:block;">
                        <h1 class="titre"><?php echo $name ?></h1>

                        <form method="post" action="" class="messageenter">
                            <label><input class="message" type="text" id="message" name="message" maxlength="220" size="30" placeholder=" Message"/></label>
                            <input class="boutonenvoi" type="submit" id="messagesend" name="messagesend" value="Envoyer"/>
                            <!-- <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg, image/jpg">
                            <input class="boutonenvoi" type="submit" id="filesend" name="filesend" value="Envoyer"/> -->
                        </form>
                        <div id="emojis">
                        </div>
                        <?php
                        include "includes/message.php";
                        ?>

                        <div class="zonemessage" id="messages">
                            <?php
                            $_SESSION['tchat'] = $_GET['tchat'];
                            include 'includes/1affichemessage.php';
                            ?>
                        </div>

                    </div>
                <?php
                }else {
                    ?>
                        <script type="text/javascript">
                            window.alert('Tu es ban de ce site !');
                            self.location.href='../nav.php';
                        </script>
                    <?php
                }
            } else {
            ?>
                <script type="text/javascript">
                    window.alert('Tu es ban de ce tchat !');
                    self.location.href='../nav.php';
                </script>
            <?php
            }       
        } else{
        ?>
            <script type="text/javascript">
                window.alert("Tu n'es pas connecté");
                self.location.href='../index2.php';
            </script>
        <?php
        }
        ?>
        <script>
            setInterval('load_messages()', 2000);
            function load_messages() {
                $('#messages').load('affichemessage.php?tchat=<?php echo $_GET['tchat']; ?>');
            }
        </script>
    </body>
</html>