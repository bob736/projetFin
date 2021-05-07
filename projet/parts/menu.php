<header>
    <div id="menu">
        <ul>
            <?php
                if($connected){?>
                    <li class="menu-item"><a href="">Message</a></li>
                    <li class="menu-item"><a href="#" id="menuProfileLink" data-id="<?= $_SESSION["user1_id"] ?>" class="profileLink">Profile</a></li>
                    <li class="menu-item"><a href="./utils/connectStatueCheck.php">Disconnect</a></li><?php
                }
                else{?>
                    <li class="menu-item"><a href="./utils/connectStatueCheck.php">Login</a></li><?php
                }
            ?>
        </ul>
    </div>
</header>
