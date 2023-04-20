<?php
include  "include/db.php";
session_start();
mysqli_query($conn,"UPDATE `files` SET     
    `store_prices`=Null,`store_prices_name`=Null,`store_prices_date`=Null,
	`store_ads`=Null,`store_ads_name`=Null,`store_ads_date`=Null,
	`weekly_ads`=Null,`weekly_ads_name`=Null,`weekly_ads_date`=Null,	`wholesale_price_books`=Null,`wholesale_price_books_name`=Null,`wholesale_price_books_date`=Null
	WHERE user_id = '".$_SESSION['id']."'");
session_destroy();
session_unset();
header("location:login.php");
exit;