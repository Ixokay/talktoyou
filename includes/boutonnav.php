<!-- connecter en tant que ... -->
<p class="paragraphe">Connecter en tant que : <?php echo $_SESSION['pseudo']?></p>
<form method="post">
    <!-- bouton connexion -->
    <input class="bouton" type="submit" id="disconnection" name="disconnection" value="déconnexion"/>
</form>
<?php    
    $qpseudo = $db->prepare("SELECT * FROM op WHERE pseudo = :pseudo");
    $qpseudo->execute(['pseudo' => $_SESSION['pseudo']]);
    $result = $qpseudo->fetch();
    // option pour les opérateurs
    if($result == true) {
        ?>
        <!-- formulaire pour suprimer un tchat -->
        <form method="post" action="">
            <label><p class="textenter">delete un tchat</p><input type="text" id="deletetchat" name="deletetchat" required size="30"/></label>
            <input type="submit" id="deletetchatsend" name="deletetchatsend" value="Envoyer"/>
        </form>
        <!-- formulaire pour se renommer ou renommer quelqu'un -->
        <form method="post" action="">
            <label><p class="textenter">Nom d'utilisateur</p><input type="text" id="opnameuser" name="opnameuser" required size="30"/></label>
            <label><p class="textenter">Nouveau nom d'utilisateur</p><input type="text" id="opnewnameuser" name="opnewnameuser" required size="30"/></label>
            <input type="submit" id="opnameusersend" name="opnameusersend" value="Envoyer"/>
        </form>
        <?php
    // option pour les non opérateurs
    } else{
        ?>
        <!-- formulaire pour se renommer -->
        <form method="post" action="">
            <label><p class="textenter">Nouveau nom d'utilisateur</p><input type="text" id="newnameuser" name="newnameuser" required size="30"/></label>
            <input type="submit" id="nameusersend" name="nameusersend" value="Envoyer"/>
        </form>
        <?php
    }

    // bouton déconnexion
    if(isset($_POST['disconnection'])){
        session_reset();
        session_destroy();
        ?><script type="text/javascript">
            self.location.href='index2.php';
        </script><?php
    }
    // suprimmer un tchat
    if(isset($_POST['deletetchatsend'])){
        $qchat = $db->prepare("DELETE FROM chat WHERE tchat = :tchat");
        $qchat->execute([
            'tchat' => $_POST['deletetchat']
        ]);
        $qchat = $db->prepare("DELETE FROM niveau1op WHERE tchat = :tchat");
        $qchat->execute([
            'tchat' => $_POST['deletetchat']
        ]);
        $qchat = $db->prepare("DELETE FROM nomchat WHERE tchat = :tchat");
        $qchat->execute([
            'tchat' => $_POST['deletetchat']
        ]);
    }
    // option renommer pour opérateur
    if(isset($_POST['opnameusersend'])){
        $q = $db->prepare("UPDATE users SET pseudo = :pseudo WHERE pseudo = :newpseudo");
        $q->execute([
            'pseudo' => $_POST['opnewnameuser'],
            'newpseudo' => $_POST['opnameuser']
        ]);
    }
    // option renommer pour non opérateur
    if(isset($_POST['nameusersend'])){
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
            self.location.href='nav.php';
        </script><?php
    }
?>