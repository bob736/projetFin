<?php
    include "./include/userRequire_once.php";

    use App\Manager\UserManager;

    $userManager = new UserManager();

    session_start();
    if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true){
        echo $_SESSION["user1_id"];
        $connected = true;
    }
    else{
        echo "not ok";
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
</head>
<body>

<?php include "./parts/menu.php" ?>
<ul id="cont">
    <li id="projet">
        <div class="projetCont">
            <h1>Projet Name</h1>
            <ul>
                <li><a href="">Lorem ipsum dolor sit ameezet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
            </ul>
        </div>
        <div class="projetCont">
            <h1>Projet Name</h1>
            <ul>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
            </ul>
        </div>
        <div class="projetCont">
            <h1>Projet Name</h1>
            <ul>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
            </ul>
        </div>
        <div class="projetCont">
            <h1>Projet Name</h1>
            <ul>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                <li><a href="">Lorem ipsum dolor sit amet</a></li>
            </ul>
        </div>
    </li>
    <li id="categories"></li>
    <li id="chat">
        <div id="showMessage"></div>
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
    </li>
    <li id="online">
        <ul>
            <?php require_once("./parts/connected.php") ?>
        </ul>
    </li>
</ul>
</body>
<script src="https://kit.fontawesome.com/78e483bd6f.js" crossorigin="anonymous"></script>
<script src="js/utils/infoClick.js"></script>
<script src="js/classes/Request.js" type="module"></script>
<script src="js/classes/PrivateMessageSingle.js" type="module"></script>
<script src="js/classes/PrivateMessageAll.js" type="module"></script>
<script src="js/utils/privateMessage.js" type="module"></script>
</html>