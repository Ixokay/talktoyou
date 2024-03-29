<!-- connecter en tant que ... -->
<p class="paragraphe">Connecter en tant que : <?php echo $_SESSION['pseudo']?></p>
<!-- bouton redirection pour choisir un tchat -->
<form method="post">
    <input class="bouton" type="submit" id="notchat" name="notchat" value="Choisir un tchat"/>
</form>
<!-- bouton déconnexion -->
<form method="post">
    <input class="bouton" type="submit" id="disconnection" name="disconnection" value="déconnexion"/>
</form>
<!-- bouton supprimer son dernier message -->
<form method="post">
    <input class="bouton" type="submit" id="supprimer" name="supprimer" value="Supprimer le dernier message."/>
</form>
<?php
    $qpseudo = $db->prepare("SELECT * FROM op WHERE pseudo = :pseudo");
    $qpseudo->execute(['pseudo' => $_SESSION['pseudo']]);
    $resultop = $qpseudo->fetch();

    $qniveau1op = $db->prepare("SELECT * FROM niveau1op WHERE tchat = :tchat AND pseudo = :pseudo");
    $qniveau1op->execute([
        'tchat' => $_GET['tchat'],
        'pseudo' => $_SESSION['pseudo']
    ]);
    $resultniveau1op = $qniveau1op->fetch();

    // option pour les créateur du tchat = niveau1op
    if($resultniveau1op == true) {
        if($resultop == true){
            // si le créateur est opérateur = ne fais rien
        }else {
            ?>
            <!-- bouton déconnecter tous le monde -->
            <form method="post">
                <input class="bouton" type="submit" id="videconnecter" name="videconnecter" value="Vider la table de connexion."/>
            </form>
            <!-- formulaire renommer le tchat -->
            <form method="post" action="">
                <label><p class="textenter">Nom du tchat</p><input type="text" id="nametchat" name="nametchat" required size="30"/></label>
                <input type="submit" id="nametchatsend" name="nametchatsend" value="Envoyer"/>
            </form>
            <!-- formulaire bannir des utilisateurs de ce tchat -->
            <form method="post" action="">
                <label><p class="textenter">ban utilisateur</p><input type="text" id="bantchat" name="bantchat" required size="30"/></label>
                <input type="submit" id="bansend" name="bansend" value="Envoyer"/>
            </form>
            <!-- formulaire débannir des utilisateurs de ce tchat -->
            <form method="post" action="">
                <label><p class="textenter">unban utilisateur</p><input type="text" id="unbantchat" name="unbantchat" required size="30"/></label>
                <input type="submit" id="unbansend" name="unbansend" value="Envoyer"/>
            </form>
            <?php
        }
    }
    // option pour les opérateurs
    if($resultop == true) {
        ?>
        <!-- bouton déconnecter tous le monde -->
        <form method="post">
            <input class="bouton" type="submit" id="videconnecter" name="videconnecter" value="Vider la table de connexion."/>
        </form>
        <!-- formulaire pour se renommer ou renommer quelqu'un -->
        <form method="post" action="">
            <label><p class="textenter">Nom de l'utilisateur</p><input type="text" id="opnameuser" name="opnameuser" required size="30"/></label>
            <label><p class="textenter">Nouveau nom de l'utilisateur</p><input type="text" id="opnewnameuser" name="opnewnameuser" required size="30"/></label>
            <input type="submit" id="opnameusersend" name="opnameusersend" value="Envoyer"/>
        </form>
        <!-- formulaire renommer le tchat -->
        <form method="post" action="">
            <label><p class="textenter">Nom du tchat</p><input type="text" id="nametchat" name="nametchat" required size="30"/></label>
            <input type="submit" id="nametchatsend" name="nametchatsend" value="Envoyer"/>
        </form>
        <!-- formulaire mettre opérateur -->
        <form method="post" action="">
            <label><p class="textenter">op utilisateur</p><input type="text" id="optchat" name="optchat" required size="30"/></label>
            <input type="submit" id="opsend" name="opsend" value="Envoyer"/>
        </form>
        <!-- formulaire enlever opérateur -->
        <form method="post" action="">
            <label><p class="textenter">deop utilisateur</p><input type="text" id="deoptchat" name="deoptchat" required size="30"/></label>
            <input type="submit" id="deopsend" name="deopsend" value="Envoyer"/>
        </form>
        <!-- formulaire mettre opérateur de niveau 1 -->
        <form method="post" action="">
            <label><p class="textenter">niveau 1 op utilisateur</p><input type="text" id="niveau1optchat" name="niveau1optchat" required size="30"/></label>
            <input type="submit" id="niveau1opsend" name="niveau1opsend" value="Envoyer"/>
        </form>
        <!-- formulaire enlever opérateur de niveau 1 -->
        <form method="post" action="">
            <label><p class="textenter">niveau 1 deop utilisateur</p><input type="text" id="niveau1deoptchat" name="niveau1deoptchat" required size="30"/></label>
            <input type="submit" id="niveau1deopsend" name="niveau1deopsend" value="Envoyer"/>
        </form>
        <!-- formulaire bannir des utilisateurs de ce tchat -->
        <form method="post" action="">
            <label><p class="textenter">ban utilisateur</p><input type="text" id="bantchat" name="bantchat" required size="30"/></label>
            <input type="submit" id="bansend" name="bansend" value="Envoyer"/>
        </form>
        <!-- formulaire débannir des utilisateurs de ce tchat -->
        <form method="post" action="">
            <label><p class="textenter">unban utilisateur</p><input type="text" id="unbantchat" name="unbantchat" required size="30"/></label>
            <input type="submit" id="unbansend" name="unbansend" value="Envoyer"/>
        </form>
        <?php
    // option pour les utilisateurs
    }else {
        ?>
        <!-- formulaire pour se renommer -->
        <form method="post" action="">
            <label><p class="textenter">Nouveau nom d'utilisateur</p><input type="text" id="newnameuser" name="newnameuser" required size="30"/></label>
            <input type="submit" id="nameusersend" name="nameusersend" value="Envoyer"/>
        </form>
        <?php
    }
    


    if(isset($_POST['notchat'])){
        // bouton redirection pour choisir un tchat
        $q = $db->prepare("DELETE FROM connecter WHERE pseudo = :pseudo");
        $q->execute([
            'pseudo' => $_SESSION['pseudo']
        ]);
        $_SESSION['connect'] = true;
        ?><script type="text/javascript">
            self.location.href='../nav.php';
        </script><?php
    }
    if(isset($_POST['disconnection'])){
        // bouton déconnexion
        $q = $db->prepare("DELETE FROM connecter WHERE pseudo = :pseudo");
        $q->execute([
            'pseudo' => $_SESSION['pseudo']
        ]);
        session_reset();
        session_destroy();
        ?><script type="text/javascript">
            self.location.href='../index2.php';
        </script><?php
    }
    if(isset($_POST['supprimer'])){
        // bouton supprimer le dernier message
        $qsuppr = $db->prepare("DELETE FROM chat WHERE pseudo = :pseudo AND tchat = :tchat ORDER BY id desc LIMIT 1");
        $qsuppr->execute([
            'pseudo' => $_SESSION['pseudo'],
            'tchat' => $_GET['tchat']
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
    if(isset($_POST['videconnecter'])){
        // bouton déconnecter tous le monde
        $q = $db->prepare("TRUNCATE TABLE connecter");
        $q->execute();
    }
    if(isset($_POST['opnameusersend'])){
        // pour les opérateurs
        // formulaire pour se renommer ou renommer quelqu'un
        $qpseudo = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
        $qpseudo->execute(['pseudo' => $_POST['newnameuser']]);
        $resuluser = $qpseudo->fetch();
        // vérifie que le nom existe ou pas
        if($resuluser == true){
            ?>
                <script type="text/javascript">
                    window.alert("Ce nom d'utilisateur existe déjà");
                </script>
            <?php
        }else {
            $q = $db->prepare("UPDATE users SET pseudo = :pseudo WHERE pseudo = :newpseudo");
            $q->execute([
                'pseudo' => $_POST['opnewnameuser'],
                'newpseudo' => $_POST['opnameuser']
            ]);
            ?><script type="text/javascript">
                self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
            </script><?php
        }
    }
    if(isset($_POST['nametchatsend'])){
        // renommer le tchat
        $q = $db->prepare("INSERT INTO nomchat(name,tchat) VALUES(:name,:tchat)");
        $q->execute([
            'name' => $_POST['nametchat'],
            'tchat' => $_GET['tchat']
        ]);
        $q = $db->prepare("INSERT INTO chat(tchat,pseudo,message) VALUES(:tchat,:pseudo,:message)");
        $q->execute([
            'tchat' => $_GET['tchat'],
            'pseudo' => 'CONSOLE : Nom du tchat = ',
            'message' => $_POST['nametchat']
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
    if(isset($_POST['opsend'])){
        // mettre opérateur
        $q = $db->prepare("INSERT INTO op(pseudo) VALUES(:pseudo)");
        $q->execute([
            'pseudo' => $_POST['optchat']
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
    if(isset($_POST['deopsend'])){
        // enlever opérateur
        $deopname = $_POST['deoptchat'];
        $q = $db->prepare("DELETE FROM op WHERE pseudo = :pseudo");
        $q->execute([
            'pseudo' => $deopname
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
    if(isset($_POST['niveau1opsend'])){
        // mettre niveau 1 op
        $q = $db->prepare("INSERT INTO niveau1op(tchat, pseudo) VALUES(:tchat, :pseudo)");
        $q->execute([
            'tchat' => $_GET['tchat'],
            'pseudo' => $_POST['niveau1optchat']
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
    if(isset($_POST['niveau1deopsend'])){
        // enlever niveau 1 op
        $q = $db->prepare("DELETE FROM niveau1op WHERE tchat = :tchat AND pseudo = :pseudo");
        $q->execute([
            'tchat' => $_GET['tchat'],
            'pseudo' => $_POST['niveau1deoptchat']
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
    if(isset($_POST['nameusersend'])){
        // pour les utilisateurs
        // se renommer
        $qpseudo = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
        $qpseudo->execute(['pseudo' => $_POST['newnameuser']]);
        $resuluser = $qpseudo->fetch();
        // verifie si le pseudo est déjà pris
        if($resuluser == true){
            ?>
                <script type="text/javascript">
                    window.alert("Ce nom d'utilisateur existe déjà");
                </script>
            <?php
        }else {
            $q = $db->prepare("UPDATE users SET pseudo = :newpseudo WHERE pseudo = :pseudo");
            $q->execute([
                'pseudo' => $_SESSION['pseudo'],
                'newpseudo' => $_POST['newnameuser']
            ]);
            $qpseudo = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
            $qpseudo->execute(['pseudo' => $_POST['newnameuser']]);
            $result = $qpseudo->fetch();
            $_SESSION['pseudo'] = $result['pseudo'];
            ?><script type="text/javascript">
                self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
            </script><?php
        }
    }
    if(isset($_POST['bansend'])){
        // bannir utilisateurs
        $qpseudo = $db->prepare("SELECT * FROM op WHERE pseudo = :pseudo");
        $qpseudo->execute(['pseudo' => $_POST['bantchat']]);
        $resultop = $qpseudo->fetch();
        // si l'utilisateur est opérateur = ne fais rien
        if($resultop == true){
            ?>
                <script type="text/javascript">
                    window.alert('Cette utilisateur est op vous ne pouvez le ban');
                </script>
            <?php
        }else {
            $q = $db->prepare("INSERT INTO ban(pseudo,tchat) VALUES(:pseudo,:tchat)");
            $q->execute([
                'pseudo' => $_POST['bantchat'],
                'tchat' => $_GET['tchat']
            ]);
            ?><script type="text/javascript">
                self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
            </script><?php
        }
    }
    if(isset($_POST['unbansend'])){
        // débannir utilisateur
        $unbanname = $_POST['unbantchat'];
        $q = $db->prepare("DELETE FROM ban WHERE pseudo = :pseudo");
        $q->execute([
            'pseudo' => $unbanname
        ]);
        ?><script type="text/javascript">
            self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
        </script><?php
    }
?>