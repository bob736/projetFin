<?php function info($user){?>
    <div class="infoClick">
        <a class="chatLink" data-id="<? echo $user->getId() ?>" href="#"><i class="far fa-comments"></i></a>
        <a class="profileLink" data-id="<? echo $user->getId() ?>" href="#"><i class="far fa-user"></i></a>
    </div><?php
} ?>
