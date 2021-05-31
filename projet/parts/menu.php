<header>
    <div id="menu">
        <ul>
            <?php
                if($connected){?>
                    <li class="menu-item"><a href="" id="joinServer">Join a server</a></li>
                    <li class="menu-item"><a id="createProjet" href="">Create a Project</a></li>
                    <li class="menu-item"><a href="#" id="menuProfileLink" data-id="<?= $_SESSION["user1_id"] ?>" class="profileLink">Profile</a></li>
                    <li class="menu-item"><a href="./utils/connectStatueCheck.php">Disconnect</a></li>
                    <li class="menu-items"><a href="#" class="help"><i class="fas fa-info-circle"></i></a></li>
                    <script src="js/utils/createProject.js" type="module"></script>
                    <?php
                }
            ?>
        </ul>
    </div>
</header>