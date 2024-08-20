<?php
session_start(); //resuming the session
session_destroy();//destroying the datas registered to a session
include('login.php'); // taking into the login page after destroying 
?>