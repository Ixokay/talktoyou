<!-- formulaire inscription -->
<div class="center">
    <div class="inscription-connection">
        <h2 class="titre">Inscris toi !</h2>
        <form method="post">
            <label>Pseudo: <abbr title="Ce champ est obligatoire"></abbr><input type="text" id="pseudo" name="pseudo" required
                minlength="4" maxlength="14" size="47"/></label><br/>
            <label>Mot de passe: <abbr title="Ce champ est obligatoire"></abbr><input type="password" name="passe" id="passe" required
                minlength="8" size="47"/></label><br/>
            <label>Confirmation du mot de passe: <abbr title="Ce champ est obligatoire"></abbr><input type="password" id="newpasse" name="newpasse" required
                minlength="8" size="47"/></label><br/>
            <label>Adresse e-mail: <abbr title="Ce champ est obligatoire"></abbr><input type="text" id="email" name="email" required
                minlength="4" size="47"/></label><br/>
            <input class="bouton" type="submit" id="formsend" name="formsend" value="M'inscrire"/>
        </form>
    </div>
</div>
<?php
    include 'database.php';
    global $db;
    if(isset($_POST['formsend'])){

        extract($_POST);
        // php inscription 
        if(!empty($pseudo) && !empty($passe) && !empty($newpasse) && !empty($email)){
            if($passe == $newpasse){
                // cryptage du mot de passe
                $options = [
                    'cost' => 12,
                ];
                $hachpasse = password_hash($passe, PASSWORD_BCRYPT, $options);

                $cemail = $db->prepare("SELECT email FROM users WHERE email = :email");
                $cemail->execute([
                    'email' => $email
                ]);
                $resultemail = $cemail->rowCount();

                $cpseudo = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
                $cpseudo->execute([
                    'pseudo' => $pseudo
                ]);
                $resultpseudo = $cpseudo->rowCount();

                if ($resultemail == 0){
                    if ($resultpseudo == 0){
                        $q = $db->prepare("INSERT INTO users(pseudo,email,passe) VALUES(:pseudo,:email,:passe)");
                        $q->execute([
                            'pseudo' => $pseudo,
                            'email' => $email,
                            'passe' => $hachpasse
                        ]);
                        $_SESSION['pseudo'] = $result['pseudo'];
                        $_SESSION['connect'] = true;
                        ?><script type="text/javascript">
                            self.location.href='nav.php';
                        </script><?php
                        ?> <h2 class="titre">Le compte a été créée !<br>Connecte-toi maintenant</h2> <?php
                    } else{
                        ?> <h2 class="titre">Ce pseudo est déja utilisé !</h2> <?php
                    }
                } else{
                    ?> <h2 class="titre">Cette Email est déja utilisé !</h2> <?php
                }
            } else{
                ?> <h2 class="titre">Les mots de passe ne correspondent pas !</h2> <?php
            } 
        } else{
            ?> <h2 class="titre">Tous les champs ne sont pas remplis !</h2> <?php
        }        
    }
?>