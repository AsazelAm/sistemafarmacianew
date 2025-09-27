<?php
session_start();//para acceder a las variables de star
session_destroy();//destruimos las sesiones para q me redirija al index
header('Location:../index.php');
?>