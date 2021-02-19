<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1"/>
        <link rel="stylesheet" href="css/nav.css">
        <title>talk to you</title>
        <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline';" />
    </head>
    
    <body>
        <?php 
        session_start();
        include 'includes/database.php';
        global $db;
        
        if(isset($_SESSION['pseudo'])){
        ?>
            <button onclick="Compte()">Compte</button>
            <div id="hautDePage" style="display:none;" class="compteDeconnexion">
                <?php include 'includes/boutonnav.php'; ?>
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

            <div id="basDePage" style="display:block;">
                <h1 class="titre">Bienvenue sur ce tchat</h1>
                <p class="paragraphe">
                    Parle avec tes amis sur <b>Talk To You !</b>
                </p>
                <p class="paragraphe">
                    C'est gratuit, <b>inscrit toi</b> 
                    dès maintenant pour parler sans limite 
                    ou <b>connecte toi</b> si tu es déjâ inscrit !
                </p>
                
                <h2 class="titre">Choisis ton tchat</h2>
                <nav class="menu-nav">
                    <ul>
                        <li class="btn">
                            <a class="page" href="tchat/tchat.php?tchat=0">
                                <?php
                                $qnom = $db->prepare('SELECT * FROM nomchat WHERE tchat = :tchat ORDER BY id desc LIMIT 1');
                                $qnom->execute(['tchat' => '0']);
                                $nom = $qnom->fetch();
                                $name = $nom['name'];
                                echo $name;
                                ?>
                            </a>
                        </li>
                        <li class="btn">
                            <a class="page" href="tchat/tchat.php?tchat=1">
                                <?php
                                $qnom = $db->prepare('SELECT * FROM nomchat WHERE tchat = :tchat ORDER BY id desc LIMIT 1');
                                $qnom->execute(['tchat' => '1']);
                                $nom = $qnom->fetch();
                                $name = $nom['name'];
                                echo $name;
                                ?>
                            </a>
                        </li>
                    </ul>
                </nav>

                <h2 class="titre">Rejoint un tchat</h2>
                <nav class="menu-nav">
                    <ul>
                        <li class="btn">
                            <form method="post" action="">
                                <label><input type="number" id="idtchat" name="idtchat" placeholder="12345678" min="100000" max="99999999"></label>
                                <input type="submit" id="idtchatsend" name="idtchatsend" value="Envoyer"/>
                            </form>
                            <?php
                            if(isset($_POST['idtchatsend'])){
                                if(!empty($_POST['idtchat'])){
                                    ?><script type="text/javascript">
                                        self.location.href='tchat/tchat.php?tchat=<?php echo $_POST['idtchat']; ?>';
                                    </script><?php
                                }
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
                
                <h2 class="titre">Créer un tchat</h2>
                <nav class="menu-nav">
                    <ul>
                        <li class="btn">
                            <a class="page" href="tchat/tchat.php?tchat=<?php echo rand(100000, 99999999); ?>">
                                Créer
                            </a>
                        </li>
                    </ul>
                </nav>

                <h2 class="titre">Mes tchats</h2>
                <nav class="menu-nav">
                    <ul>
                        <li class="btn">
                            <?php
                            $alltchat = $db->prepare('SELECT * FROM niveau1op WHERE pseudo = :pseudo ORDER BY id asc');
                            $alltchat->execute(['pseudo' => $_SESSION['pseudo']]);
                            while($list = $alltchat->fetch()){
                                $allnomtchat = $db->prepare('SELECT * FROM nomchat WHERE tchat = :tchat ORDER BY id desc LIMIT 1');
                                $allnomtchat->execute([
                                    'tchat' => $list['tchat']
                                ]);
                                $nomtchat = $allnomtchat->fetch()
                                ?><a class="page" href="tchat/tchat.php?tchat=<?php echo $list['tchat']; ?>">
                                    <?php
                                    echo $nomtchat['name'];
                                    echo ' : ';
                                    echo $list['tchat'];
                                ?></a><br><br><?php
                                echo '  ';
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
                
            </div>

        <?php
        } else{
        ?>
            <script type="text/javascript">
                self.location.href='index2.php';
            </script>
        <?php
        }
        ?>
    </body>
</html>