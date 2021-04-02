

<header>
    <div id="menu">
        <ul>
            <li class="menu-item">Accueil</li>
            <li class="menu-item">A propos</li>
            <li class="menu-item">Services</li>
            <li class="menu-item">Actualitées</li>
            <li class="menu-item">Contact</li>
            <?php
                if($connected){?>
                    <li class="menu-item"><a href="./utils/connectStatueCheck.php">Disconnect</a></li><?php
                }
                else{?>
                    <li class="menu-item"><a href="./utils/connectStatueCheck.php">Login</a></li><?php
                }
            ?>
        </ul>
    </div>
</header>
