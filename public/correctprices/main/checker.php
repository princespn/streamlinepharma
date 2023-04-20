<?php

if (strlen(session_id()) === 0) {
    session_start();
}

if ($_SESSION['prog']=="100") {
    echo $_SESSION['prog'];
   // $_SESSION['prog']="0";
} else {
    echo '0';
}