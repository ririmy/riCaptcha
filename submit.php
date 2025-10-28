<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['captcha']) && $_POST['captcha'] === $_SESSION['captcha']) {
        echo 'CAPTCHA pass!';

    } else {
        echo 'CAPTCHA fail!';
    }
}
?>
