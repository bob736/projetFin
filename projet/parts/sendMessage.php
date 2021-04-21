<div class="messageForm">
    <form action="../utils/sendMessageFunction.php?user=<?php echo $_GET["user"] ?>" method="post">
        <div>
            <input type="text" placeholder="message" name="message" required>
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</div>