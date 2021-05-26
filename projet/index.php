<?php
    include "./include/userRequire_once.php";

    use App\Manager\UserManager;

    $userManager = new UserManager();

    session_start();
    if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true){
        $connected = true;
    }
    else{
        $connected = false;
    }
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include "./include/cssGlobal.php" ?>
    <link rel="stylesheet" href="./css/projet.css">
    <link rel="stylesheet" href="./css/categories.css">
    <link rel="stylesheet" href="./css/chat.css">
    <link rel="stylesheet" href="./css/online.css">
    <link rel="stylesheet" href="./css/projectChannel.css">
    <link rel="stylesheet" href="./css/connection.css">
</head>
<body>

<?php include "./parts/menu.php" ?>
<ul id="cont">
    <?php require_once("./parts/projets.php") ?>
    <li id="channels"></li>
    <li id="data">
        <div id="chat">
            <div id="showMessage"><?php
                if(!$connected){?>
                <div id="form">
                    <div class="formContent">
                        <form action="./utils/connectFormCheck.php" method="post">
                            <div>
                                <input type="email" placeholder="email" name="mail">
                            </div>
                            <div>
                                <input type="password" placeholder="pass" name="pass">
                            </div>
                            <div>
                                <input class="buttonForm" type="submit" value="Connexion">
                            </div>
                        </form>
                    </div>
                    <div class="formContent">
                        <form action="./utils/inscription.php" method="post">
                            <div>
                                <input type="text" placeholder="name" name="name">
                            </div>
                            <div>
                                <input type="email" placeholder="email" name="mail">
                            </div>
                            <div>
                                <input type="password" placeholder="pass" name="pass">
                            </div>
                            <div>
                                <input class="buttonForm" type="submit" value="Inscription">
                            </div>
                        </form>
                    </div>
                </div>
                    <?php
                }
                ?>

            </div>
            <div id="sendMessage">
                <div id="sendMessageBox">
                    <div id="sendMessageForm">
                        <form>
                            <?php if($connected){?>
                                <input type="text" placeholder="Envoyer un message sur le channel #......">
                                <input type="submit"><?php
                            }else{?>
                                <input disabled="disabled" type="text" placeholder="Vous devez etre connecté pour envoyer un message"><?php
                            }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li id="online">
        <ul><?php if($connected){?>
            <h1 class="usersTitle">Followed users</h1>
            <?php require_once("./parts/connected.php");
            }?>
        </ul>
    </li>
</ul>
</body>
<script src="https://kit.fontawesome.com/78e483bd6f.js" crossorigin="anonymous"></script>
<script src="js/utils/fonctionUtils.js" type="module"></script>
<script src="js/utils/infoClick.js"></script>
<script src="js/classes/Profile.js" type="module"></script>
<script src="js/utils/profileClick.js" type="module"></script>
<script src="js/classes/Request.js" type="module"></script>
<script src="js/classes/sendMessage.js" type="module"></script>
<script src="js/utils/sendMessageFunc.js" type="module"></script>
<script src="js/classes/MessageSingle.js" type="module"></script>
<script src="js/classes/MessageAll.js" type="module"></script>
<script src="js/utils/privateMessage.js" type="module"></script>
<script src="js/utils/joinServer.js" type="module"></script>
<script src="js/classes/ChannelSingle.js" type="module"></script>
<script src="js/classes/ChannelAll.js" type="module"></script>
<script src="js/utils/showChannel.js" type="module"></script>
<script src="js/utils/fixButtonPosition.js"></script>
</html>
