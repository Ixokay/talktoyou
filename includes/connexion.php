<div class="center">
    <div class="inscription-connection">
        <h2 class="titre">Connecte toi !</h2>
        <form method="post">
            <label>E-mail: <abbr title="Ce champ est obligatoire">
                <input type="text" id="email" name="email" required minlength="4" size="47"/>
            </label><br/>
            <label>Mot de passe: <abbr title="Ce champ est obligatoire">
                <input type="password" id="passe" name="passe" required minlength="4" size="47"/>
            </label><br/>
            <input class="bouton" type="submit" id="formsend" name="formsend" value="Me connecter"/>
        </form>
    </div>
</div>
<?php
    include 'database.php';
    global $db;        
    if(isset($_POST['formsend'])){
        extract($_POST);    
        
        if(!empty($email) && !empty($passe)){

            $qemail = $db->prepare("SELECT * FROM users WHERE email = :email");
            $qemail->execute(['email' => $email]);
            $result = $qemail->fetch();

            if($result == true){
                $qpseudo = $db->prepare("SELECT * FROM users WHERE email = :email");
                $qpseudo->execute(['email' => $email]);
                $resultpseudo = $qpseudo->fetch();
                if(password_verify($passe, $result['passe'])){
                    ?> <h2 class="titre">Le mot de passe est correct !</h2> <?php
                    $_SESSION['pseudo'] = $resultpseudo['pseudo'];
                    $_SESSION['connect'] = true;
                    ?><script type="text/javascript">
                        self.location.href='nav.php';
                    </script><?php
                } else{
                    ?> <h2 class="titre">Le mot de passe n'est pas correct !</h2> <?php
                }
            } else{
                ?> <h2 class="titre">Le compte <?php echo $pseudo ?> n'existe pas !</h2> <?php
            }
        } else{
            ?> <h2 class="titre">Tous les champs ne sont pas remplis !</h2> <?php
        };
    };
?>