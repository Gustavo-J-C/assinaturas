<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: form");
    exit;
} else {
    header("Location: login");
    exit;
}
?>
