<?php
$allmsg = $db->prepare('SELECT * FROM chat WHERE tchat = :tchat ORDER BY id desc');
$allmsg->execute([
    'tchat' => $_GET['tchat']
])
while($msg = $allmsg->fetch()){
    if($msg['pseudo'] == $_SESSION['pseudo']) {
        ?><br><?php
        echo $msg['date'];
        echo ' ';
        ?><div class="textcouleur2"><?php
            ?> <b> <?php 
            echo $msg['pseudo']; ?></b><?php 
            echo ' : ';
            echo $msg['message']; ?><br><?php
        ?></div><?php
    }else {
        ?><br><?php
        echo $msg['date'];
        echo ' ';
        ?><div class="textcouleur1"><?php
            ?> <b> <?php 
            echo $msg['pseudo']; ?></b><?php 
            echo ' : ';
            echo $msg['message']; ?><br><?php
        ?></div><?php
    }
}
?>