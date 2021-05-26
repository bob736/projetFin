<?php
if(isset($_POST["mail"], $_POST["pass"])){
    $mail = sanitize($_POST["mail"]);
    $pass = sanitize($_POST["pass"]);
}