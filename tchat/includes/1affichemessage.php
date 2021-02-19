<?php
$qconnecter = $db->prepare("SELECT * FROM connecter WHERE pseudo = :pseudo");
$qconnecter->execute(['pseudo' => $_SESSION['pseudo']]);
$resultconnecter = $qconnecter->fetch();
if($resultconnecter['pseudo'] != true) {
    $_SESSION['connect'] = true;
    ?>
    <script type="text/javascript">
        self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
    </script>
    <?php
}

$allmsg = $db->prepare('SELECT * FROM chat WHERE tchat = :tchat ORDER BY id desc LIMIT 14');
$allmsg->execute([
    'tchat' => $_GET['tchat']
]);
?><div class="listetchat"><?php
    ?><h3 class="titre">Message</h3><br><?php
    ?><div class="scroll"><?php
        while($msg = $allmsg->fetch()){
            if($msg['pseudo'] == $_SESSION['pseudo']) {
                ?><br><?php
                ?><div class="floatright"><?php
                    ?><div class="textcouleur2"><?php
                        ?><b><?php 
                        echo $msg['pseudo']; 
                        ?></b><?php 
                        echo ' : ';
                        echo $msg['message']; ?><?php
                    ?></div><?php
                    ?><img src="flechedediscution.png" width="20"><?php
                ?></div><?php
                ?><br><?php
            }else {
                ?><br><?php
                ?><div class="floatleft"><?php
                ?><img src="flechedediscution2.png" width="20"><?php
                    ?><div class="textcouleur1"><?php
                        ?><b><?php 
                        echo $msg['pseudo']; 
                        ?></b><?php 
                        echo ' : ';
                        echo $msg['message']; ?><?php
                    ?></div><?php
                ?></div><?php
                ?><?php
            }
        }
    ?></div><?php
    ?><br><?php
?></div><?php

?><div class="listeUtilisateur"><?php
    ?><h3 class="titre">Tous les utilisateurs</h3><br><?php
    $allusers = $db->query('SELECT * FROM users ORDER BY id asc');
    ?><br><?php
    while($list = $allusers->fetch()){
        $opusers = $db->prepare('SELECT * FROM op WHERE pseudo = :pseudo');
        $opusers->execute(['pseudo' => $list['pseudo']]);
        $op = $opusers->fetch();

        $connecterusers = $db->prepare('SELECT * FROM connecter WHERE pseudo = :pseudo');
        $connecterusers->execute(['pseudo' => $list['pseudo']]);
        $connecter = $connecterusers->fetch();

        $qniveau1op = $db->prepare("SELECT * FROM niveau1op WHERE tchat = :tchat AND pseudo = :pseudo");
        $qniveau1op->execute([
            'tchat' => $_GET['tchat'],
            'pseudo' => $list['pseudo']
        ]);
        $resultniveau1op = $qniveau1op->fetch();

        if($connecter['pseudo']){ 
            if($connecter['tchat'] == $_GET['tchat']) {
                ?><div class="usersconnecter"><?php
                    echo $list['pseudo']; 
                    echo ' '; 
                    if($op['pseudo']) {
                        echo '(op)';
                    }else if($resultniveau1op['pseudo']) {
                        echo '(op de nv°1)';
                    } 
                    if($connecter['pseudo']){
                        ?><img src="includes/pngegg.png" width="20"><?php
                    };?><br><?php
                ?><div><?php
            }
        }
    }
?></div><?php