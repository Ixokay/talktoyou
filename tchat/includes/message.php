<?php
    if(isset($_POST['messagesend'])){
        extract($_POST);
        if(!empty($message)){
            if(strlen($message) < 221){
                
                $qpseudo = $db->prepare("SELECT * FROM op WHERE pseudo = :pseudo");
                $qpseudo->execute(['pseudo' => $_SESSION['pseudo']]);
                $resultop = $qpseudo->fetch();

                $qniveau1op = $db->prepare("SELECT * FROM niveau1op WHERE tchat = :tchat AND pseudo = :pseudo");
                $qniveau1op->execute([
                    'tchat' => $_GET['tchat'],
                    'pseudo' => $_SESSION['pseudo']
                ]);
                $resultniveau1op = $qniveau1op->fetch();
                
                if($message == '/clear' && $resultop == true) {
                    // $user_id = 0;
                    $req = $db->prepare("DELETE FROM chat WHERE tchat = :tchat");
                    $req->execute(['tchat' => $_GET['tchat']]);
                    
                    ?><script type="text/javascript">
                        self.location.href='tchat.php?tchat='$_GET['tchat']'';
                    </script><?php
                }else if($message == '/clear' && $resultniveau1op == true) {
                    // $user_id = 0;
                    $req = $db->prepare("DELETE FROM chat WHERE tchat = :tchat");
                    $req->execute(['tchat' => $_GET['tchat']]);
                    
                    ?><script type="text/javascript">
                        self.location.href='tchat.php?tchat='$_GET['tchat']'';
                    </script><?php
                }else if($message == '/leave') {
                    $q = $db->prepare("DELETE FROM connecter WHERE pseudo = :pseudo");
                    $q->execute([
                        'pseudo' => $_SESSION['pseudo']
                    ]);
                    session_reset();
                    session_destroy();
                    ?><script type="text/javascript">
                        self.location.href='../index2.php';
                    </script><?php
                }else if($message == '/+') {
                    echo 'Liste de tous les messages';?><br><?php
                    $allmsg = $db->prepare('SELECT * FROM chat WHERE tchat = :tchat ORDER BY id desc');
                    $allmsg->execute(['tchat' => $_GET['tchat']]);
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
                    ?><br><br><b>/- </b><?php
                    echo 'pour revenir à la normal';
                }else if($message == '/liste') {
                    echo 'Tous les utilisateurs';?><br><br><?php
                    $allusers = $db->query('SELECT * FROM users ORDER BY id asc');
                    while($list = $allusers->fetch()){
                        $opusers = $db->prepare('SELECT * FROM op WHERE pseudo = :pseudo');
                        $opusers->execute([
                            'pseudo' => $list['pseudo']
                        ]);
                        $op = $opusers->fetch();

                        $connecterusers = $db->prepare('SELECT * FROM connecter WHERE pseudo = :pseudo AND tchat = :tchat');
                        $connecterusers->execute([
                            'pseudo' => $list['pseudo'],
                            'tchat' => $_GET['tchat']
                        ]);
                        $connecter = $connecterusers->fetch();

                        $qniveau1op = $db->prepare("SELECT * FROM niveau1op WHERE tchat = :tchat AND pseudo = :pseudo");
                        $qniveau1op->execute([
                            'tchat' => $_GET['tchat'],
                            'pseudo' => $list['pseudo']
                        ]);
                        $resultniveau1op = $qniveau1op->fetch();

                        echo $list['id']; 
                        echo ' '; 
                        echo $list['pseudo']; 
                        echo ' '; 
                        if($op['pseudo']) {
                            echo '(op)';
                        }
                        echo ' ';
                        if($resultniveau1op['pseudo']) {
                            echo '(op de nv°1)';
                        }
                        if($connecter['pseudo']){
                            ?><img src="includes/pngegg.png" width="20"><?php
                        };?><br><?php
                    }
                    ?><br><?php
                    ?><b>/- </b><?php
                    echo 'pour revenir à la normal';
                }else if($message == '/-') {
                    // echo 'OK';
                }else {
                    $q = $db->prepare("INSERT INTO chat(tchat,pseudo,message) VALUES(:tchat,:pseudo,:message)");
                    $q->execute([
                        'tchat' => $_GET['tchat'],
                        'pseudo' => $_SESSION['pseudo'],
                        'message' => $message
                    ]);
                    ?><script type="text/javascript">
                        self.location.href='tchat.php?tchat=<?php echo $_GET['tchat']; ?>';
                    </script><?php
                }
            } else{
                echo "Message tros grand !";
                ?><br><?php
            }
        }
    }
    if(isset($_POST['messagesend'])){
        if(isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0) {
            $infosfichier = pathinfo($_FILES['monfichier']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'png');
            if (in_array($extension_upload, $extensions_autorisees)){
                move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads/' . basename($_FILES['avatar']['name']));
                echo "L'envoi a bien été effectué !";
            }
        }
    }
?>