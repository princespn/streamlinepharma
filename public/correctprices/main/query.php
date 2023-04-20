<?php
include "include/db.php";
session_start();
//phpinfo();
if ($_REQUEST['type'] == 'google_login' || $_REQUEST['type'] == 'facebook_login') {
    $check = mysqli_num_rows(mysqli_query($conn, "select * from users where social_id = '" . $_POST['id'] . "'"));
    if ($check) {
        mysqli_query($conn, "UPDATE `users` SET `name`='" . $_POST['name'] . "',`email`='" . $_POST['email'] . "',`profile`='" . $_POST['profile'] . "' WHERE social_id = '" . $_POST['id'] . "'");
    } else {
        mysqli_query($conn, "INSERT INTO `users`(`social_id`, `login_type`, `name`, `email`, `profile`) VALUES ('" . $_POST['id'] . "','" . $_POST['login_type'] . "','" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['profile'] . "')");
    }
    $data = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where social_id = '" . $_POST['id'] . "'"));
    $_SESSION['id'] = $data['id'];
    $_SESSION['login_type'] = $_POST['login_type'];
    $_SESSION['name'] = $_POST['name'];
    mysqli_query($conn, "UPDATE `files` SET `store_prices`=Null,`store_prices_name`=Null,`store_prices_date`=Null,
	`store_ads`=Null,`store_ads_name`=Null,`store_ads_date`=Null,
	`weekly_ads`=Null,`weekly_ads_name`=Null,`weekly_ads_date`=Null,	`wholesale_price_books`=Null,`wholesale_price_books_name`=Null,`wholesale_price_books_date`=Null
	WHERE user_id = '" . $_SESSION['id'] . "'");
	mysqli_query($conn, "update users set analyzed = 0 where id = '" . $_SESSION['id'] . "'");
}
if ($_REQUEST['type'] == 'registration') {
    $check = mysqli_num_rows(mysqli_query($conn, "select * from users where email = '" . $_POST['email'] . "'"));
	if ($_POST['password'] !== $_POST['passwordconf']) {
		echo "Password and Confirm Password must match!";
		exit;
	} else {
		if ($check) {
			echo "Email already exists!";
			exit;
		} else {
			mysqli_query($conn, "INSERT INTO `users`(`login_type`, `name`, `email`, `profile`,`password`) VALUES ('" . $_POST['login_type'] . "','" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['profile'] . "','" . $_POST['password'] . "')");
			$check = mysqli_num_rows(mysqli_query($conn, "select * from users where email = '" . $_POST['email'] . "' and password = '" . $_POST['password'] . "'"));
		if ($check) {
			$data = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where email = '" . $_POST['email'] . "' and password = '" . $_POST['password'] . "'"));
			$_SESSION['id'] = $data['id'];
			$_SESSION['login_type'] = $data['login_type'];
			$_SESSION['name'] = $data['name'];
			mysqli_query($conn, "UPDATE `files` SET `store_prices`=Null,`store_prices_name`=Null,`store_prices_date`=Null,
		`store_ads`=Null,`store_ads_name`=Null,`store_ads_date`=Null,
		`weekly_ads`=Null,`weekly_ads_name`=Null,`weekly_ads_date`=Null,	`wholesale_price_books`=Null,`wholesale_price_books_name`=Null,`wholesale_price_books_date`=Null
		WHERE user_id = '" . $_SESSION['id'] . "'");
			mysqli_query($conn, "update users set analyzed = 0 where id = '" . $_SESSION['id'] . "'");
			echo "User registered successfully.";
				} else {
			echo "Incorrect email or password.";
			exit;
		}
			exit;
		}
	}
}
if ($_REQUEST['type'] == 'login') {
    $check = mysqli_num_rows(mysqli_query($conn, "select * from users where email = '" . $_POST['email'] . "' and password = '" . $_POST['password'] . "'"));
    if ($check) {
        $data = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where email = '" . $_POST['email'] . "' and password = '" . $_POST['password'] . "'"));
        $_SESSION['id'] = $data['id'];
        $_SESSION['login_type'] = $data['login_type'];
        $_SESSION['name'] = $data['name'];
        mysqli_query($conn, "UPDATE `files` SET `store_prices`=Null,`store_prices_name`=Null,`store_prices_date`=Null,
	`store_ads`=Null,`store_ads_name`=Null,`store_ads_date`=Null,
	`weekly_ads`=Null,`weekly_ads_name`=Null,`weekly_ads_date`=Null,	`wholesale_price_books`=Null,`wholesale_price_books_name`=Null,`wholesale_price_books_date`=Null
	WHERE user_id = '" . $_SESSION['id'] . "'");
		mysqli_query($conn, "update users set analyzed = 0 where id = '" . $_SESSION['id'] . "'");
        echo "Logged In!";
        exit;
    } else {
        echo "Incorrect email or password.";
        exit;
    }
}
if (!isset($_SESSION['id'])) {
    header("location:login.php");
    exit;
}
if ($_REQUEST['type'] == 'ajax_file_upload') {
	$analyze = false;
    /**************extension**************/
    $path = $_FILES[$_REQUEST['file_type']]['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    /*************************************/
    $new_name = $_REQUEST['file_type'] . '_' . $_SESSION['id'] . '_' . time() . '.' . $ext;
    $dir = "uploads/";
    $resultado = @move_uploaded_file($_FILES[$_REQUEST['file_type']]['tmp_name'], $dir . $new_name);
    if ($resultado == 1) {
        if ($_REQUEST['file_type'] == 'wholesale_price_books') {
            require_once "PHPExcel/Classes/PHPExcel.php";
            $tmpfname = 'uploads/' . $new_name;
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
            $excelObj = $excelReader->load($tmpfname);
            $worksheet = $excelObj->getSheetNames();
            $worksheet = array_map('strtolower', $worksheet);
            if (!in_array("price book", $worksheet)) {
                echo json_encode(array('error' => true, 'message' => 'Upload error: The wholesale file must contain a "PRICE BOOK" worksheet.'));
                exit;
            }
        }

		if ($_REQUEST['file_type'] == 'store_prices' || $_REQUEST['file_type'] == 'store_ads' || $_REQUEST['file_type'] == 'weekly_ads') {
            require_once "PHPExcel/Classes/PHPExcel.php";
            $tmpfname = 'uploads/' . $new_name;
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
            $excelObj = $excelReader->load($tmpfname);
            $worksheet = $excelObj->setActiveSheetIndex(0);
			$upcCnt = 0;
			for ($column = 0; $column <= 3; $column++) {
				$worksheet = $excelObj->getActiveSheet()->getCellByColumnAndRow($column, 1)->getValue();
				if($worksheet == "UPC" || $worksheet == "Product Code"){
					$upcCnt++;
				}
			}
			if ($upcCnt==0) {
                echo json_encode(array('error' => true, 'message' => 'Upload error: Incorrect file uploaded. Check to make sure you are uploading the correct file.'));
                exit;
            }
        }
		
        $check_user = mysqli_num_rows(mysqli_query($conn, "select * from files where user_id = '" . $_SESSION['id'] . "'"));
        if (!$check_user) {
            mysqli_query($conn, "INSERT INTO `files`(`user_id`) VALUES ('" . $_SESSION['id'] . "')");
        }
        $date = date('Y-m-d H:i:s');
        mysqli_query($conn, "UPDATE `files` SET `" . $_REQUEST['file_type'] . "` = '" . $_FILES[$_REQUEST['file_type']]['name'] . "' , `" . $_REQUEST['file_type'] . "_date` = '" . $date . "', `" . $_REQUEST['file_type'] . '_name' . "` = '" . $new_name . "' where user_id = '" . $_SESSION['id'] . "'");
        $date = date('m-d-Y H:i:s', strtotime($date));
        $file = mysqli_query($conn, "select * from files where user_id = '" . $_SESSION['id'] . "' 
													and store_prices          is not Null
													and store_ads             is not Null
													and weekly_ads            is not Null
													and exceptions            is not Null
													and department_lists      is not Null
													and wholesale_price_books is not Null
													");
        if (mysqli_num_rows($file)) {
            $analyze = true;
        }
        echo json_encode(array('error' => false, 'message' => $date, 'analyze' => $analyze));
        exit;
    } else {
        echo json_encode(array('error' => true, 'message' => 'Something Went Wrong'));
        exit;
    }
}
/*if($_REQUEST['type']=='ajax_file_upload'){
	$analyze = false;
		$path = $_FILES[$_REQUEST['file_type']]['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
	$new_name = $_REQUEST['file_type'].'_'.$_SESSION['id'].'_'.time().'.'.$ext;
	$dir = "/home/admin/web/retailbazzar.com/public_html/public/test/uploads/";
	if(@move_uploaded_file($_FILES[$_REQUEST['file_type']]['tmp_name'], $dir.$new_name)) {
		if($_REQUEST['file_type']=='wholesale_price_books'){
			require_once "PHPExcel/Classes/PHPExcel.php";
			$tmpfname = 'uploads/'.$new_name;
			$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
			$excelObj = $excelReader->load($tmpfname);
			$worksheet = $excelObj->getSheetNames();
			$worksheet = array_map('strtolower',$worksheet);
			if (!in_array("price book", $worksheet)){
				echo json_encode(array('error'=>true,'message'=>'Upload error: The wholesale file must contain a "PRICE BOOK" worksheet.'));
				exit;
			}
		}
		
		
		$check_user = mysqli_num_rows(mysqli_query($conn,"select * from files where user_id = '".$_SESSION['id']."'"));
		if(!$check_user){
			mysqli_query($conn,"INSERT INTO `files`(`user_id`) VALUES ('".$_SESSION['id']."')");
		}
		$date = date('Y-m-d H:i:s');
		mysqli_query($conn,"UPDATE `files` SET `".$_REQUEST['file_type']."` = '".$_FILES[$_REQUEST['file_type']]['name']."' , `".$_REQUEST['file_type']."_date` = '".$date."', `".$_REQUEST['file_type'].'_name'."` = '".$new_name."' where user_id = '".$_SESSION['id']."'");
		$date = date('d-m-Y H:i:s',strtotime($date));
		$file =mysqli_query($conn,"select * from files where user_id = '".$_SESSION['id']."' 
													and store_prices          is not Null
													and store_ads             is not Null
													and weekly_ads            is not Null
													and exceptions            is not Null
													and department_lists      is not Null
													and wholesale_price_books is not Null
													");
		if(mysqli_num_rows($file)){
			$analyze = true;
		}
		echo json_encode(array('error'=>false,'message'=>$date,'analyze'=>$analyze));
		exit;
	}else{
		echo json_encode(array('error'=>true,'message'=>'Something Went Wrong'));
		exit;
	}
}*/
if ($_REQUEST['type'] == 'excel_upload') {

    $dir = "uploads/";
    $time = date('Y-m-d H:i:s');
    move_uploaded_file($_FILES['store_prices']['tmp_name'], $dir . $_FILES['store_prices']['name']);
    move_uploaded_file($_FILES['store_ads']['tmp_name'], $dir . $_FILES['store_ads']['name']);
    move_uploaded_file($_FILES['weekly_ads']['tmp_name'], $dir . $_FILES['weekly_ads']['name']);
    move_uploaded_file($_FILES['exceptions']['tmp_name'], $dir . $_FILES['exceptions']['name']);
    move_uploaded_file($_FILES['department_lists']['tmp_name'], $dir . $_FILES['department_lists']['name']);
    move_uploaded_file($_FILES['wholesale_price_books']['tmp_name'], $dir . $_FILES['wholesale_price_books']['name']);

    mysqli_query($conn, "INSERT INTO `files`(`user_id`, `store_prices`, `store_ads`, `weekly_ads`, `exceptions`, `department_lists`, `wholesale_price_books`, `created_at`) VALUES ('" . $_SESSION['id'] . "','" . $_FILES['store_prices']['name'] . "','" . $_FILES['store_ads']['name'] . "','" . $_FILES['weekly_ads']['name'] . "','" . $_FILES['exceptions']['name'] . "','" . $_FILES['department_lists']['name'] . "','" . $_FILES['wholesale_price_books']['name'] . "','" . $time . "')");
    $_SESSION['msg'] = 'Files Uploaded Successfully.';
    header("location:dashboard.php");
}
echo json_encode("data");
if ($_REQUEST['type'] == 'download_file') {
    $sql = "DROP TABLE IF EXISTS ErrorCount" . $_SESSION['id'] . ", ErrorCount2" . $_SESSION['id'] . ", Mismatches4_" . $_SESSION['id'] . ", Mismatches5_" . $_SESSION['id'] . ", Mismatches6_" . $_SESSION['id'] . ", Mismatches7_" . $_SESSION['id'] . ", Store_Prices_Errors" . $_SESSION['id'] . ", store_prices" . $_SESSION['id'] . ", wholesale_price_books" . $_SESSION['id'] . ", store_ads" . $_SESSION['id'] . ", weekly_ads" . $_SESSION['id'] . ", sa_mm" . $_SESSION['id'] . ", wa_mm" . $_SESSION['id'] . ", ex_mm" . $_SESSION['id'] . ", wh_mm" . $_SESSION['id'] . ", mmupcs" . $_SESSION['id'] . ", Duplicate_Store_Prices1_" . $_SESSION['id'] . ", Duplicate_Store_Prices" . $_SESSION['id'] . ", Store_Prices_Errors2_" . $_SESSION['id'] . ", Store_Prices_Errors3_" . $_SESSION['id'] . ", wholesale_price_books3_" . $_SESSION['id'] . ", store_ads3_" . $_SESSION['id'] . ", weekly_ads3_" . $_SESSION['id'] . ", PriceTags" . $_SESSION['id'] . ";
	
	ALTER TABLE store_prices2_" . $_SESSION['id'] . " CHANGE `Dept._Code` Dp INT;
	ALTER TABLE store_prices2_" . $_SESSION['id'] . " CHANGE `Product_Code` UPC VARCHAR(255);
	ALTER TABLE store_prices2_" . $_SESSION['id'] . " CHANGE `Item_Description` Description VARCHAR(255);
	ALTER TABLE store_prices2_" . $_SESSION['id'] . " ADD COLUMN Quantity INT DEFAULT 1;
	ALTER TABLE store_prices2_" . $_SESSION['id'] . " ADD COLUMN Sell_Price VARCHAR(255);
	
	ALTER TABLE exceptions" . $_SESSION['id'] . " CHANGE `Entire Department (Dept Code)` Dept INT;
	ALTER TABLE exceptions" . $_SESSION['id'] . " CHANGE `Single Item (UPC)` UPC VARCHAR(255);
	ALTER exceptions" . $_SESSION['id'] . " MODIFY UPC varchar(255) null;
	ALTER exceptions" . $_SESSION['id'] . " MODIFY Dept INT null;
	
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " CHANGE `Product Code` UPC VARCHAR(255);
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " ADD COLUMN UPrice VARCHAR(255);
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " ADD COLUMN `Split Price` VARCHAR(255) DEFAULT '0/$0.00';
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " ADD COLUMN LPrice VARCHAR(255);
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " ADD COLUMN Fs VARCHAR(255);
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " ADD COLUMN `Start Date` VARCHAR(255) null;
	ALTER TABLE store_ads2_" . $_SESSION['id'] . " ADD COLUMN `End Date` VARCHAR(255) null;
	
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " CHANGE `Product Code` UPC VARCHAR(255);
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " ADD COLUMN UPrice VARCHAR(255);
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " ADD COLUMN `Split Price` VARCHAR(255) DEFAULT '0/$0.00';
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " ADD COLUMN LPrice VARCHAR(255);
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " ADD COLUMN Fs VARCHAR(255);
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " ADD COLUMN `Start Date` VARCHAR(255) null;
	ALTER TABLE weekly_ads2_" . $_SESSION['id'] . " ADD COLUMN `End Date` VARCHAR(255) null;
	
	UPDATE store_prices2_" . $_SESSION['id'] . "
	SET Sell_Price = ROUND(((Price+.0005)/`Price_Multiple`),2)
	WHERE UPC NOT RLIKE '^[A-Z]';
	
	UPDATE store_ads2_" . $_SESSION['id'] . "
	SET Quantity = '1'
	WHERE UPC NOT RLIKE '^[A-Z]' AND Quantity IS NULL;
	
	UPDATE store_ads2_" . $_SESSION['id'] . "
	SET UPrice = ROUND(((`Retail Price`+.0005)/`Price Multiple`),2)
	WHERE UPC NOT RLIKE '^[A-Z]';
	
	UPDATE weekly_ads2_" . $_SESSION['id'] . "
	SET UPrice = ROUND(((`Retail Price`+.0005)/`Price Multiple`),2)
	WHERE UPC NOT RLIKE '^[A-Z]';
	
	CREATE TABLE `store_prices" . $_SESSION['id'] . "` (INDEX `sp_upc` (`UPC`(20)))
	AS SELECT Dp, UPC, Description, Quantity, Sell_Price 
	FROM store_prices2_" . $_SESSION['id'] . ";
	
	CREATE TABLE `store_ads" . $_SESSION['id'] . "`
	AS SELECT UPC, UPrice, `Split Price`, LPrice, Fs, STR_TO_DATE(`Start Date`,'%m/%d/%Y') as `Start Date`, STR_TO_DATE(`End Date`,'%m/%d/%Y') as `End Date`
	FROM store_ads2_" . $_SESSION['id'] . ";
	
	CREATE INDEX `sa_upc` ON `store_ads" . $_SESSION['id'] . "`(`UPC`(20), `Start Date`(11), `End Date`(11));
	
	CREATE TABLE `weekly_ads" . $_SESSION['id'] . "`
	AS SELECT UPC, UPrice, `Split Price`, LPrice, Fs, STR_TO_DATE(`Start Date`,'%m/%d/%Y') as `Start Date`, STR_TO_DATE(`End Date`,'%m/%d/%Y') as `End Date`
	FROM weekly_ads2_" . $_SESSION['id'] . ";
	
	CREATE INDEX `wa_upc` ON `weekly_ads" . $_SESSION['id'] . "`(`UPC`(20), `Start Date`(11), `End Date`(11));
	
	CREATE INDEX `exc_upc` ON `exceptions" . $_SESSION['id'] . "`(`UPC`(20), `Dept`(4));
	
	CREATE TABLE `wholesale_price_books" . $_SESSION['id'] . "` (INDEX `wh_upc` (`UPC`(20)))
	AS SELECT UPC, `BASE RETAIL MULTIPLE`, `BASE RETAIL`, `BASE GP%` AS `BASE_GP%`, `C&S ITEM CODE`, `VENDOR`, `CUST CODE`, `BASE UNIT COST`
	FROM wholesale_price_books2_" . $_SESSION['id'] . ";
	
	UPDATE store_prices" . $_SESSION['id'] . " SET `Sell_Price`=REPLACE(`Sell_Price`,'$','');
	UPDATE store_prices" . $_SESSION['id'] . " SET Quantity=REPLACE(Quantity,',','');

	UPDATE store_ads" . $_SESSION['id'] . " SET `UPrice`=REPLACE(`UPrice`,'$','');
	
	UPDATE weekly_ads" . $_SESSION['id'] . " SET `UPrice`=REPLACE(`UPrice`,'$','');
	
	DELETE FROM `department_lists" . $_SESSION['id'] . "` WHERE `department_lists" . $_SESSION['id'] . "`.`DP` = 'DP';
	DELETE FROM `exceptions" . $_SESSION['id'] . "` WHERE `exceptions" . $_SESSION['id'] . "`.`UPC` = 'Single Item (UPC)';
	ALTER TABLE department_lists" . $_SESSION['id'] . " DROP COLUMN id;	
	
	ALTER TABLE exceptions" . $_SESSION['id'] . " DROP COLUMN id;
	UPDATE exceptions" . $_SESSION['id'] . " SET `Store Price`=REPLACE(`Store Price`,'$','');

	UPDATE wholesale_price_books" . $_SESSION['id'] . "
	SET UPC = LPAD(UPC,20,0)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL;

	UPDATE exceptions" . $_SESSION['id'] . "
	SET UPC = LPAD(UPC,20,0)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL;

	UPDATE store_prices" . $_SESSION['id'] . "
	SET UPC = LPAD(UPC,20,0)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL;

	UPDATE store_ads" . $_SESSION['id'] . "
	SET UPC = LPAD(UPC,20,0)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL;

	UPDATE weekly_ads" . $_SESSION['id'] . "
	SET UPC = LPAD(UPC,20,0)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL;

	UPDATE store_ads" . $_SESSION['id'] . "
	SET LPrice = Right(`Split Price`, LENGTH(`Split Price`) - LOCATE('/$',`Split Price`) - 1), 
	Fs = Left(`Split Price`, LOCATE('/$',`Split Price`) - 1)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL AND `Split Price`<>'0/$0.00';

	UPDATE weekly_ads" . $_SESSION['id'] . "
	SET LPrice = Right(`Split Price`, LENGTH(`Split Price`) - LOCATE('/$',`Split Price`) - 1), 
	Fs = Left(`Split Price`, LOCATE('/$',`Split Price`) - 1)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL AND `Split Price`<>'0/$0.00';
	
	UPDATE store_ads" . $_SESSION['id'] . "
	SET UPrice = ROUND(((LPrice+.0005)/Fs),2)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL AND `Split Price`<>'0/$0.00';

	UPDATE weekly_ads" . $_SESSION['id'] . "
	SET UPrice = ROUND(((LPrice+.0005)/Fs),2)
	WHERE UPC NOT RLIKE '^[A-Z]' AND UPC IS NOT NULL AND `Split Price`<>'0/$0.00';
	
	ALTER TABLE wholesale_price_books" . $_SESSION['id'] . " MODIFY `BASE_GP%` varchar(255) null;

	UPDATE wholesale_price_books" . $_SESSION['id'] . " 
	SET `BASE_GP%` = CASE 
		WHEN `BASE RETAIL` RLIKE '^[0-9]' THEN REPLACE(`BASE_GP%`,'$','')  
		ELSE NULL 
	END;
	
	UPDATE wholesale_price_books" . $_SESSION['id'] . "
	SET `BASE_GP%` = `BASE RETAIL`/`BASE RETAIL MULTIPLE`
	WHERE `BASE RETAIL` IS NOT NULL AND `BASE RETAIL` NOT RLIKE '^[A-Z]';
	
	CREATE TABLE `wholesale_price_books3_" . $_SESSION['id'] . "` (INDEX `wh3_upc` (`UPC`(20)))
	AS SELECT UPC, `BASE_GP%`, `C&S ITEM CODE`, `VENDOR`, `CUST CODE`, `BASE UNIT COST` as `Unit Cost`
	FROM wholesale_price_books" . $_SESSION['id'] . ";
	
	CREATE TABLE `store_ads3_" . $_SESSION['id'] . "` (INDEX `sa3_upc` (`UPC`(20)))
	AS SELECT UPC, UPrice, `Start Date`, `End Date`
	FROM store_ads" . $_SESSION['id'] . "
	WHERE (`Start Date` IS NULL OR `Start Date`<=curdate()) AND (`End Date` IS NULL OR `End Date`>=curdate());
	
	CREATE TABLE `weekly_ads3_" . $_SESSION['id'] . "` (INDEX `wa3_upc` (`UPC`(20)))
	AS SELECT UPC, UPrice, `Start Date`, `End Date`
	FROM weekly_ads" . $_SESSION['id'] . "
	WHERE (`Start Date` IS NULL OR `Start Date`<=curdate()) AND (`End Date` IS NULL OR `End Date`>=curdate());

	CREATE TABLE `Mismatches4_" . $_SESSION['id'] . "` (INDEX `m4_prices` (`UPC`(20), `Store Price`(10), `Store Ad`(10), `Weekly Ad`(10), `Exceptions`(10), `Wholesale`(10), `Dp`(4)))
	AS SELECT `store_prices" . $_SESSION['id'] . "`.`Dp`, `department_lists" . $_SESSION['id'] . "`.`Description` AS `Department`, `store_prices" . $_SESSION['id'] . "`.`UPC`, `store_prices" . $_SESSION['id'] . "`.`Description`, `store_prices" . $_SESSION['id'] . "`.`Quantity`, `store_prices" . $_SESSION['id'] . "`.`Sell_Price` AS `Store Price`, `store_ads3_" . $_SESSION['id'] . "`.`UPrice` AS `Store Ad`, `weekly_ads3_" . $_SESSION['id'] . "`.`UPrice` AS `Weekly Ad`, `exceptions" . $_SESSION['id'] . "`.`Store Price` AS `Exceptions`, `wholesale_price_books3_" . $_SESSION['id'] . "`.`BASE_GP%` AS `Wholesale`, `wholesale_price_books3_" . $_SESSION['id'] . "`.`C&S ITEM CODE`, `wholesale_price_books3_" . $_SESSION['id'] . "`.`VENDOR`, `wholesale_price_books3_" . $_SESSION['id'] . "`.`CUST CODE`, `wholesale_price_books3_" . $_SESSION['id'] . "`.`Unit Cost`
	FROM `store_prices" . $_SESSION['id'] . "`
	LEFT JOIN `department_lists" . $_SESSION['id'] . "`
	ON `store_prices" . $_SESSION['id'] . "`.`Dp` = `department_lists" . $_SESSION['id'] . "`.`DP`
	LEFT JOIN `store_ads3_" . $_SESSION['id'] . "`
	ON `store_prices" . $_SESSION['id'] . "`.`UPC` = `store_ads3_" . $_SESSION['id'] . "`.`UPC`
	LEFT JOIN `weekly_ads3_" . $_SESSION['id'] . "`
	ON `store_prices" . $_SESSION['id'] . "`.`UPC` = `weekly_ads3_" . $_SESSION['id'] . "`.`UPC`
	LEFT JOIN `exceptions" . $_SESSION['id'] . "`
	ON `store_prices" . $_SESSION['id'] . "`.`UPC` = `exceptions" . $_SESSION['id'] . "`.`UPC`
	LEFT JOIN `wholesale_price_books3_" . $_SESSION['id'] . "`
	ON `store_prices" . $_SESSION['id'] . "`.`UPC` = `wholesale_price_books3_" . $_SESSION['id'] . "`.`UPC`
	WHERE `store_prices" . $_SESSION['id'] . "`.`UPC` <> '00000000000000000000' AND `store_prices" . $_SESSION['id'] . "`.`UPC` IS NOT NULL;".
	
	/*CREATE TABLE `Mismatches7_" . $_SESSION['id'] . "` (INDEX `m7_prices` (`DP`(4), `UPC`(20)))
	AS SELECT `Mismatches4_" . $_SESSION['id'] . "`.*
	FROM `Mismatches4_" . $_SESSION['id'] . "`
	LEFT JOIN `exceptions" . $_SESSION['id'] . "`
	ON `Mismatches4_" . $_SESSION['id'] . "`.`DP` = `exceptions" . $_SESSION['id'] . "`.`Dp`
	WHERE `exceptions" . $_SESSION['id'] . "`.`Dp` IS NULL;*/
		
	"DELETE `Mismatches4_" . $_SESSION['id'] . "`
	FROM `Mismatches4_" . $_SESSION['id'] . "`
	INNER JOIN `exceptions" . $_SESSION['id'] . "` ON `Mismatches4_" . $_SESSION['id'] . "`.`DP` = `exceptions" . $_SESSION['id'] . "`.`Dept`
	WHERE `exceptions" . $_SESSION['id'] . "`.`Dept`<>0 AND `exceptions" . $_SESSION['id'] . "`.`Dept` IS NOT NULL;
	
	CREATE TABLE sa_mm" . $_SESSION['id'] . "
	AS SELECT `UPC`
	FROM Mismatches4_" . $_SESSION['id'] . "
	WHERE `Store Ad` IS NOT NULL AND round(`Store Ad`,2) <> round(`Store Price`,2);
	
	CREATE TABLE wa_mm" . $_SESSION['id'] . "
	AS SELECT `UPC`
	FROM Mismatches4_" . $_SESSION['id'] . "
	WHERE `Store Ad` IS NULL AND `Weekly Ad` IS NOT NULL AND round(`Weekly Ad`,2) <> round(`Store Price`,2);
	
	CREATE TABLE ex_mm" . $_SESSION['id'] . "
	AS SELECT `UPC`
	FROM Mismatches4_" . $_SESSION['id'] . "
	WHERE `Store Ad` IS NULL AND `Weekly Ad` IS NULL AND `Exceptions` IS NOT NULL AND round(`Exceptions`,2) <> round(`Store Price`,2);
	
	CREATE TABLE wh_mm" . $_SESSION['id'] . "
	AS SELECT `UPC`
	FROM Mismatches4_" . $_SESSION['id'] . "
	WHERE `Store Ad` IS NULL AND `Weekly Ad` IS NULL AND `Exceptions` IS NULL AND `Wholesale` IS NOT NULL AND round(`Wholesale`,2) <> round(`Store Price`,2);
	
	CREATE TABLE `mmupcs" . $_SESSION['id'] . "` (INDEX `mmu3_upc` (`UPC`(20)))
	AS SELECT *
        FROM sa_mm" . $_SESSION['id'] . "
        UNION DISTINCT
        SELECT *
        FROM wa_mm" . $_SESSION['id'] . "
        UNION DISTINCT
        SELECT *
        FROM ex_mm" . $_SESSION['id'] . "
		UNION DISTINCT
		SELECT *
        FROM wh_mm" . $_SESSION['id'] . ";
	
	CREATE TABLE `Mismatches5_" . $_SESSION['id'] . "` 
	AS SELECT `Department`, `mmupcs" . $_SESSION['id'] . "`.`UPC`, `Description`, TRIM(`C&S ITEM CODE`) AS `C&S ITEM CODE`, `VENDOR` AS ` VENDOR`, TRIM(`CUST CODE`) AS `CUST CODE`, `Quantity`, `Unit Cost`, `Store Price`, `Store Ad`, `Weekly Ad`, `Exceptions`, `Wholesale`
	FROM `Mismatches4_" . $_SESSION['id'] . "`
	RIGHT JOIN `mmupcs" . $_SESSION['id'] . "`
	ON `Mismatches4_" . $_SESSION['id'] . "`.`UPC` = `mmupcs" . $_SESSION['id'] . "`.`UPC`;	
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	ADD COLUMN `Error Type` VARCHAR(255) FIRST;
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	ADD COLUMN `Price Diff` VARCHAR(255) Null;
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	ADD COLUMN SorterWS INT(10) Null;
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	ADD COLUMN SorterSP INT(10) Null;
	
	UPDATE `Mismatches5_" . $_SESSION['id'] . "` 
	SET `Error Type` = CASE 
		WHEN `Store Ad` IS NOT NULL THEN '1-Store Ad' 
		WHEN `Weekly Ad` IS NOT NULL THEN '2-Weekly Ad'
		WHEN `Exceptions` IS NOT NULL THEN '3-Exceptions'
		WHEN `Wholesale` IS NOT NULL AND `UPC` IN (SELECT `UPC` FROM (SELECT * FROM `Mismatches5_" . $_SESSION['id'] . "` WHERE round(`Wholesale`,2) = round(`Store Price`,2))tbltmp) THEN '5-Wholesale Mixed Results' 
		ELSE '4-Wholesale Mismatch' 
	END;
	
	UPDATE `Mismatches5_" . $_SESSION['id'] . "`
	SET `Price Diff` = ROUND((`Store Price`-`Wholesale`),2)
	WHERE `Error Type` = '4-Wholesale Mismatch' OR `Error Type` = '5-Wholesale Mixed Results';
	
	UPDATE `Mismatches5_" . $_SESSION['id'] . "`
	SET `SorterWS` = ROUND(`Wholesale`,2)*100
	WHERE `Error Type` = '4-Wholesale Mismatch' OR `Error Type` = '5-Wholesale Mixed Results';
	
	UPDATE `Mismatches5_" . $_SESSION['id'] . "`
	SET `SorterSP` = ROUND(`Store Price`,2)*100
	WHERE `Error Type` = '4-Wholesale Mismatch' OR `Error Type` = '5-Wholesale Mixed Results';
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	ORDER BY `Error Type` ASC, `Department` ASC, `UPC` ASC, SorterWS ASC;
	
	CREATE TABLE `Mismatches6_" . $_SESSION['id'] . "`
	AS SELECT *, MIN(SorterWS) AS SorterWhS
	FROM `Mismatches5_" . $_SESSION['id'] . "`
	GROUP BY UPC;
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "` 
	MODIFY `Store Price` DECIMAL(10,2),
	MODIFY `Store Ad` DECIMAL(10,2),
	MODIFY `Weekly Ad` DECIMAL(10,2),
	MODIFY `Exceptions` DECIMAL(10,2),
	MODIFY `Wholesale` DECIMAL(10,2);
	
	CREATE TABLE PriceTags" . $_SESSION['id'] . "
	AS SELECT `Department`, `UPC`, `Description`, `C&S ITEM CODE`, `VENDOR` AS ` VENDOR`, `Wholesale`, `Price Diff`
	FROM Mismatches5_" . $_SESSION['id'] . "
	WHERE `Error Type` = '4-Wholesale Mismatch' OR `Error Type` = '5-Wholesale Mixed Results'
	ORDER BY `Department` ASC, `UPC` ASC;

	CREATE TABLE ErrorCount" . $_SESSION['id'] . "
	AS SELECT `Error Type`, COUNT(`Error Type`) AS Number
	FROM Mismatches6_" . $_SESSION['id'] . "
	GROUP BY `Error Type`;
	
	ALTER TABLE ErrorCount" . $_SESSION['id'] . " MODIFY Number VARCHAR(255) NULL;
	
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) Values (NULL, NULL);
	ORDER BY `Error Type` ASC;
	
	
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) 
	SELECT 
	   'Total Wholesale Items', COUNT(DISTINCT UPC)
	FROM 
	   store_prices" . $_SESSION['id'] . "
	INNER JOIN wholesale_price_books3_" . $_SESSION['id'] . " USING(UPC);
	
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) 
	SELECT 
	   '% Mispriced', FORMAT(x.num / y.num * 100,1)
	FROM 
	(
	  SELECT SUM(Number) as num     
	  FROM ErrorCount" . $_SESSION['id'] . "    
	  WHERE (`Error Type` = '4-Wholesale Mismatch' OR `Error Type` = '5-Wholesale Mixed Results')      
	) x
	join 
	(
	  SELECT Number as num     
	  FROM ErrorCount" . $_SESSION['id'] . "     
	  WHERE `Error Type` = 'Total Wholesale Items'     
	) y on 1=1;
	
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) Values (NULL, NULL);
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) 
	SELECT 
	   'Losses', CONCAT('$', FORMAT(SUM(Quantity*(`SorterSP`-SorterWhS))/100, 2))
	FROM 
	   Mismatches6_" . $_SESSION['id'] . "
	WHERE
	   `SorterSP`<SorterWhS;
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) 
	SELECT 
	   'Gains', CONCAT('$', FORMAT(SUM(Quantity*(`SorterSP`-SorterWhS))/100, 2))
	FROM 
	   Mismatches6_" . $_SESSION['id'] . "
	WHERE
	   `SorterSP`>SorterWhS;
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) 
	SELECT 
	   'Sum Total', CONCAT('$', FORMAT(SUM(Quantity*(`SorterSP`-SorterWhS))/100, 2))
	FROM 
	   Mismatches6_" . $_SESSION['id'] . ";
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) Values (NULL, NULL);
	INSERT INTO ErrorCount" . $_SESSION['id'] . "(`Error Type`, Number) Values ('*For duplicate mispriced item entries, only the best case entry for the store <max gain or min loss per item> is included in the totals', NULL);

	CREATE TABLE `Duplicate_Store_Prices1_" . $_SESSION['id'] . "`
	AS SELECT `UPC`
	FROM `store_prices" . $_SESSION['id'] . "`
	GROUP BY `UPC`
	HAVING COUNT(`UPC`)>1 AND (COUNT(DISTINCT `Sell_Price`) > 1 OR COUNT(`UPC`) > COUNT(`Sell_Price`));
	
	CREATE TABLE `Duplicate_Store_Prices" . $_SESSION['id'] . "`
	AS SELECT `store_prices" . $_SESSION['id'] . "`.`UPC`, `Description`, `Dp` AS `Dept Code`, `Sell_Price` AS `Store Price`, `Quantity`
	FROM `store_prices" . $_SESSION['id'] . "`
	RIGHT JOIN `Duplicate_Store_Prices1_" . $_SESSION['id'] . "`
	ON `store_prices" . $_SESSION['id'] . "`.`UPC`=`Duplicate_Store_Prices1_" . $_SESSION['id'] . "`.`UPC`
	WHERE `store_prices" . $_SESSION['id'] . "`.`UPC` NOT RLIKE '^[A-Z]';
	
	ALTER TABLE `Duplicate_Store_Prices" . $_SESSION['id'] . "` 
	MODIFY `Store Price` DECIMAL(10,2);
		
	CREATE TABLE `Store_Prices_Errors2_" . $_SESSION['id'] . "`
	AS SELECT `UPC`, `Description`, `Dp`, `Sell_Price`, `Quantity`
	FROM `store_prices" . $_SESSION['id'] . "`
	WHERE `UPC` NOT RLIKE '^[A-Z]' AND `UPC` <> '00000000000000000000' AND (`Sell_Price` IS NULL OR `Sell_Price` < 0.01);
	
	CREATE TABLE `Store_Prices_Errors3_" . $_SESSION['id'] . "`
	AS SELECT `Store_Prices_Errors2_" . $_SESSION['id'] . "`.`UPC`, `Store_Prices_Errors2_" . $_SESSION['id'] . "`.`Description`, `Store_Prices_Errors2_" . $_SESSION['id'] . "`.`Dp`, `Sell_Price` AS `Store Price`, `Quantity`, `exceptions" . $_SESSION['id'] . "`.`Store Price` AS `Exc`
	FROM `Store_Prices_Errors2_" . $_SESSION['id'] . "`
	LEFT JOIN `exceptions" . $_SESSION['id'] . "`
	ON `Store_Prices_Errors2_" . $_SESSION['id'] . "`.`UPC`=`exceptions" . $_SESSION['id'] . "`.`UPC`;
	
	CREATE TABLE `Store_Prices_Errors" . $_SESSION['id'] . "`
	AS SELECT `UPC`, `Description`, `Store_Prices_Errors3_" . $_SESSION['id'] . "`.`Dp` AS `Dept Code`, `Store Price`, `Quantity`
	FROM `Store_Prices_Errors3_" . $_SESSION['id'] . "`
	WHERE `Exc` IS NULL OR `Store Price`<>`Exc`;
		
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	DROP COLUMN SorterWS;	
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	DROP COLUMN SorterWhS;
	
	ALTER TABLE `Mismatches5_" . $_SESSION['id'] . "`
	DROP COLUMN SorterSP;
	
	ALTER TABLE `Store_Prices_Errors" . $_SESSION['id'] . "` 
	MODIFY `Store Price` DECIMAL(10,2)";

	foreach (explode(';', $sql) as $query){
        /**echo '<pre>'; print_r($query); echo '</pre>'; THESE COST US 5 MINUTES OF RUNTIME!!  AND 3 WEEKS OF OPTIMIZATION TO AVOID THE SERVER TIMING OUT!!**/
        $StorePrices = mysqli_query($conn, $query);
		/*if (isset($_SESSION['prog'])) {
            session_start(); //IMPORTANT!
        }
        $percent=intval($download_pb++/$total*100);
        $_SESSION['prog'] = $percent;
        session_write_close(); //IMPORTANT!
        sleep(1); //IMPORTANT!*/
		//echo $percent;
		//file_put_contents("tmp/" . session_id() . ".txt", json_encode($percent));
        /**sleep ( 1);**/
	}

	$StoreErrors = mysqli_query($conn, 'SELECT * FROM Store_Prices_Errors' . $_SESSION['id'] );
    $Mismatches = mysqli_query($conn, 'SELECT * FROM Mismatches5_' . $_SESSION['id'] );
	$StoreDuplicates = mysqli_query($conn, 'SELECT * FROM Duplicate_Store_Prices' . $_SESSION['id'] );
	$ErrorCount = mysqli_query($conn, 'SELECT * FROM ErrorCount' . $_SESSION['id'] );
	$PriceTags = mysqli_query($conn, 'SELECT * FROM PriceTags' . $_SESSION['id'] );
	$Exc = mysqli_query($conn, 'SELECT * FROM exceptions' . $_SESSION['id'] );
	$Exct = mysqli_query($conn, 'SELECT * FROM exceptions' );
	$Dpt = mysqli_query($conn, 'SELECT * FROM department_lists' . $_SESSION['id'] );
	$Dptt = mysqli_query($conn, 'SELECT * FROM department_lists' );
	
    if (isset($_REQUEST['sub_type'])) {
        echo json_encode(array('error' => false));
        exit;
    }
   	$array_StoreErrors = mysqli_fetch_all($StoreErrors, MYSQLI_ASSOC);
    $array_Mismatches = mysqli_fetch_all($Mismatches, MYSQLI_ASSOC);
	$array_StoreDuplicates = mysqli_fetch_all($StoreDuplicates, MYSQLI_ASSOC);
	$array_ErrorCount = mysqli_fetch_all($ErrorCount, MYSQLI_ASSOC);
	$array_PriceTags = mysqli_fetch_all($PriceTags, MYSQLI_ASSOC);
	$array_Exc = mysqli_fetch_all($Exc, MYSQLI_ASSOC);
	$array_Exct = mysqli_fetch_all($Exct, MYSQLI_ASSOC);	
	$array_Dpt = mysqli_fetch_all($Dpt, MYSQLI_ASSOC);
	$array_Dptt = mysqli_fetch_all($Dptt, MYSQLI_ASSOC);
	
	$SEcnt = mysqli_num_rows($StoreErrors)+1;
	$MMcnt = mysqli_num_rows($Mismatches)+1;
	$SDcnt = mysqli_num_rows($StoreDuplicates)+1;
	$ECcnt = mysqli_num_rows($ErrorCount)+1;
	$PTcnt = mysqli_num_rows($PriceTags)+1;
	$EXCcnt = mysqli_num_rows($Exc)+1;
	$EXCTcnt = mysqli_num_rows($Exct)+1;
	$DPTcnt = mysqli_num_rows($Dpt)+1;
	$DPTTcnt = mysqli_num_rows($Dptt)+1;

    require_once "PHPExcel/Classes/PHPExcel.php";
    $objPHPExcel = new PHPExcel();

	if ($_REQUEST['file_type'] == 'store_prices') {
	
	//Error_Counts sheet
    $objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
    $objWorkSheet->setTitle("Error_Counts");
	$q = mysqli_query($conn, 'SHOW COLUMNS FROM ErrorCount' . $_SESSION['id'] );
	$rowcount=1;
	$col='A';
	if (mysqli_num_rows($q) > 0) {
		while ($row_q = mysqli_fetch_assoc($q)) {
			$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
			$col++;
		}
	}
    $objWorkSheet->fromArray($array_ErrorCount, NULL, 'A2');
	$objPHPExcel->getActiveSheet()->getStyle('B2:B'.$ECcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
	//Mismatches sheet
    $objWorkSheet1 = $objPHPExcel->createSheet(1);
    $objWorkSheet1 = $objPHPExcel->setActiveSheetIndex(1);
    $objWorkSheet1->setTitle("Price_Mismatches");
	$q = mysqli_query($conn, 'SHOW COLUMNS FROM Mismatches5_' . $_SESSION['id'] );
	$rowcount=1;
	$col='A';
	if (mysqli_num_rows($q) > 0) {
		while ($row_q = mysqli_fetch_assoc($q)) {
			$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
			$col++;
		}
	}
    $objWorkSheet1->fromArray($array_Mismatches, NULL, 'A2');
	foreach(range('A','N') as $columnID2) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID2)
        ->setAutoSize(true);
}
	$objPHPExcel->getActiveSheet()->getStyle('A1:D'.$MMcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('E1:O'.$MMcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
	$objPHPExcel->getActiveSheet()
    ->getStyle('I2:O'.$MMcnt)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
	$objPHPExcel->getActiveSheet()
    ->getStyle('J1:N'.$MMcnt)
    ->getFont()->getColor()->setRGB('8B0000');
	//Free_and_Unpriced_Items sheet
    $objWorkSheet2 = $objPHPExcel->createSheet(2);
    $objWorkSheet2 = $objPHPExcel->setActiveSheetIndex(2);
    $objWorkSheet2->setTitle("Free_and_Unpriced_Items");
	$q = mysqli_query($conn, 'SHOW COLUMNS FROM Store_Prices_Errors' . $_SESSION['id'] );
	$rowcount=1;
	$col='A';
	if (mysqli_num_rows($q) > 0) {
		while ($row_q = mysqli_fetch_assoc($q)) {
			$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
			$col++;
		}
	}
    $objWorkSheet2->fromArray($array_StoreErrors, NULL, 'A2');
	foreach(range('A','E') as $columnID3) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID3)
        ->setAutoSize(true);
	}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:B'.$SEcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
	$objPHPExcel->getActiveSheet()->getStyle('c1:e'.$SEcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
	$objPHPExcel->getActiveSheet()
    ->getStyle('D2:D'.$SEcnt)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
	$objPHPExcel->getActiveSheet()
    ->getStyle('D1:D'.$SEcnt)
    ->getFont()->getColor()->setRGB('8B0000');
	//Duplicate_Items sheet
    $objWorkSheet3 = $objPHPExcel->createSheet(3);
    $objWorkSheet3 = $objPHPExcel->setActiveSheetIndex(3);
    $objWorkSheet3->setTitle("Duplicate_Items");
	$q = mysqli_query($conn, 'SHOW COLUMNS FROM Duplicate_Store_Prices' . $_SESSION['id'] );
	$rowcount=1;
	$col='A';
	if (mysqli_num_rows($q) > 0) {
		while ($row_q = mysqli_fetch_assoc($q)) {
			$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
			$col++;
		}
	}
    $objWorkSheet3->fromArray($array_StoreDuplicates, NULL, 'A2');
	foreach(range('A','E') as $columnID4) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID4)
        ->setAutoSize(true);
}
	$objPHPExcel->getActiveSheet()->getStyle('A1:B'.$SDcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('c1:e'.$SDcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
	$objPHPExcel->getActiveSheet()
    ->getStyle('D2:D'.$SDcnt)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
	$objPHPExcel->getActiveSheet()
    ->getStyle('D1:D'.$SDcnt)
    ->getFont()->getColor()->setRGB('8B0000');
	}
	
	if ($_REQUEST['file_type'] == 'price_tags') {
		$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
		$objWorkSheet->setTitle("Price_Tags");
		$q = mysqli_query($conn, 'SHOW COLUMNS FROM PriceTags' . $_SESSION['id'] );
		$rowcount=1;
		$col='A';
		if (mysqli_num_rows($q) > 0) {
			while ($row_q = mysqli_fetch_assoc($q)) {
				$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
				$col++;
			}
		}
		$objWorkSheet->fromArray($array_PriceTags, NULL, 'A2');
		$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
		
		foreach(range('A','G') as $columnID2) {
   			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID2)
        	->setAutoSize(true);
		}
	$objPHPExcel->getActiveSheet()->getStyle('A1:C'.$PTcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('D1:G'.$PTcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()
    ->getStyle('F2:G'.$PTcnt)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
	}

	if ($_REQUEST['file_type'] == 'Exceptions') {
		$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
		$objWorkSheet->setTitle("Exceptions");
		$q = mysqli_query($conn, 'SHOW COLUMNS FROM exceptions' . $_SESSION['id'] );
		$rowcount=1;
		$col='A';
		if (mysqli_num_rows($q) > 0) {
			while ($row_q = mysqli_fetch_assoc($q)) {
				$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
				$col++;
			}
		}
		$objWorkSheet->fromArray($array_Exc, NULL, 'A2');
		$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );

		foreach(range('A','D') as $columnID2) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID2)
				->setAutoSize(true);
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:C'.$EXCcnt)
			->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('D1:D'.$EXCcnt)
			->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	}
						 
	if ($_REQUEST['file_type'] == 'ExcTemplate') {
		$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
		$objWorkSheet->setTitle("ExceptionsTemplate");
		$q = mysqli_query($conn, 'SHOW COLUMNS FROM exceptions' );
		$rowcount=1;
		$col='A';
		if (mysqli_num_rows($q) > 0) {
			while ($row_q = mysqli_fetch_assoc($q)) {
				$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
				$col++;
			}
		}
		$objWorkSheet->fromArray($array_Exct, NULL, 'A2');
		$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
		
		foreach(range('A','D') as $columnID2) {
   			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID2)
        	->setAutoSize(true);
		}
	$objPHPExcel->getActiveSheet()->getStyle('A1:C'.$EXCTcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('D1:D'.$EXCTcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	}					 
	
	if ($_REQUEST['file_type'] == 'DeptList') {
		$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
		$objWorkSheet->setTitle("Dept List");
		$q = mysqli_query($conn, 'SHOW COLUMNS FROM department_lists' . $_SESSION['id'] );
		$rowcount=1;
		$col='A';
		if (mysqli_num_rows($q) > 0) {
			while ($row_q = mysqli_fetch_assoc($q)) {
				$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
				$col++;
			}
		}
		$objWorkSheet->fromArray($array_Dpt, NULL, 'A2');
		$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
		
		foreach(range('A','B') as $columnID2) {
   			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID2)
        	->setAutoSize(true);
		}
	$objPHPExcel->getActiveSheet()->getStyle('A1:B'.$DPTcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	}
						 
	if ($_REQUEST['file_type'] == 'DeptTemplate') {
		$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
		$objWorkSheet->setTitle("DeptTemplate");
		$q = mysqli_query($conn, 'SHOW COLUMNS FROM department_lists' );
		$rowcount=1;
		$col='A';
		if (mysqli_num_rows($q) > 0) {
			while ($row_q = mysqli_fetch_assoc($q)) {
				$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowcount, $row_q['Field']);
				$col++;
			}
		}
		$objWorkSheet->fromArray($array_Dptt, NULL, 'A2');
		$objPHPExcel->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold( true );
		
		foreach(range('A','B') as $columnID2) {
   			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID2)
        	->setAutoSize(true);
		}
	$objPHPExcel->getActiveSheet()->getStyle('A1:B'.$DPTTcnt)
->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	}					 					 
		
	//$_SESSION['prog']="100";
	//session_write_close(); //IMPORTANT!
    //sleep(1); //IMPORTANT!
	//session_start();
	
	$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);
	
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
	
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $_REQUEST['file_type'] . ' - ' . date('m-d-Y His') . '.xlsx"'); //tell browser what's the file name
    
	$objWriter->save('php://output');
}

if ($_REQUEST['type'] == 'analyze') {
    $file = mysqli_query($conn, "select * from files where user_id = '" . $_SESSION['id'] . "' 
												and store_prices          is not Null
												and store_ads             is not Null
												and weekly_ads            is not Null
												and exceptions            is not Null
												and department_lists      is not Null
												and wholesale_price_books is not Null
												");
    if (!mysqli_num_rows($file)) {
        echo "An error has occurred. Please upload all files then click Initialize the Analysis";
        exit;
    }
    /***********checking if row found in table***********/
    $check = mysqli_query($conn, "select * from analyzed_files where user_id = '" . $_SESSION['id'] . "'");
    if (!mysqli_num_rows($check)) {
        mysqli_query($conn, "INSERT INTO `analyzed_files`(`user_id`) VALUES ('" . $_SESSION['id'] . "')");
    }
    $file = mysqli_fetch_assoc(mysqli_query($conn, "select * from files where user_id = '" . $_SESSION['id'] . "'"));
    require_once "PHPExcel/Classes/PHPExcel.php";
    /**********************For store_prices**************************/
    $inputFileName = "uploads/" . $file['store_prices_name'];
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $store_prices = $objPHPExcel->getActiveSheet()->toArray();
    mysqli_query($conn, "DROP TABLE IF EXISTS store_prices2_" . $_SESSION['id']);
    $sql = "CREATE TABLE store_prices2_" . $_SESSION['id'] . " (
				id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $end_key = '';
    $row_query = '';
    $table_col = array();
    foreach ($store_prices[0] as $key => $row) {
        if ($row == Null) {
            break;
        }
        array_push($table_col, '`' . str_replace(' ', '_', $row) . '`');
        $sql .= '`' . str_replace(' ', '_', $row) . '`' . "  VARCHAR(255) NOT NULL,";
        $end_key = $key;
    }
    foreach ($store_prices as $key => $row) {
        $tmp_row = array_slice($row, 0, ($end_key + 1));
        array_walk($tmp_row, function (&$a) use ($conn) {
            $a = mysqli_real_escape_string($conn, $a);
        });
        $row_query .= "('" . implode("','", $tmp_row) . "'),";
    }
    $sql = substr($sql, 0, -1) . "  ) ";
    $insert_query = "INSERT INTO store_prices2_" . $_SESSION['id'] . " (" . implode(',', $table_col) . ") VALUES " . substr($row_query, 0, -1);
    mysqli_query($conn, $sql);
    mysqli_query($conn, $insert_query);
    /**********************For store_ads_name**************************/
    $inputFileName = "uploads/" . $file['store_ads_name'];
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $store_ads = $objPHPExcel->getActiveSheet()->toArray();
    mysqli_query($conn, "DROP TABLE IF EXISTS store_ads2_" . $_SESSION['id']);
    $sql = "CREATE TABLE store_ads2_" . $_SESSION['id'] . " (
				id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $end_key = '';
    $row_query = '';
    $table_col = array();
    foreach ($store_ads[0] as $key => $row) {
        if ($row == Null) {
            break;
        }
        array_push($table_col, '`' . $row . '`');
        $sql .= '`' . $row . '`' . "  VARCHAR(255) NOT NULL,";
        $end_key = $key;
    }
    foreach ($store_ads as $key => $row) {
        $tmp_row = array_slice($row, 0, ($end_key + 1));
        array_walk($tmp_row, function (&$a) use ($conn) {
            $a = mysqli_real_escape_string($conn, $a);
        });
        $row_query .= "('" . implode("','", $tmp_row) . "'),";
    }
    $sql = substr($sql, 0, -1) . "  ) ";
    $insert_query = "INSERT INTO store_ads2_" . $_SESSION['id'] . " (" . implode(',', $table_col) . ") VALUES " . substr($row_query, 0, -1);
    mysqli_query($conn, $sql);
    mysqli_query($conn, $insert_query);
    /**********************For weekly_ads_name**************************/
    $inputFileName = "uploads/" . $file['weekly_ads_name'];
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $weekly_ads = $objPHPExcel->getActiveSheet()->toArray();
    mysqli_query($conn, "DROP TABLE IF EXISTS weekly_ads2_" . $_SESSION['id']);
    $sql = "CREATE TABLE weekly_ads2_" . $_SESSION['id'] . " (
				id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $end_key = '';
    $row_query = '';
    $table_col = array();
    foreach ($weekly_ads[0] as $key => $row) {
        if ($row == Null) {
            break;
        }
        array_push($table_col, '`' . $row . '`');
        $sql .= '`' . $row . '`' . "  VARCHAR(255) NOT NULL,";
        $end_key = $key;
    }
    foreach ($weekly_ads as $key => $row) {
        $tmp_row = array_slice($row, 0, ($end_key + 1));
        array_walk($tmp_row, function (&$a) use ($conn) {
            $a = mysqli_real_escape_string($conn, $a);
        });
        $row_query .= "('" . implode("','", $tmp_row) . "'),";
    }
    $sql = substr($sql, 0, -1) . "  ) ";
    $insert_query = "INSERT INTO weekly_ads2_" . $_SESSION['id'] . " (" . implode(',', $table_col) . ") VALUES " . substr($row_query, 0, -1);
    mysqli_query($conn, $sql);
    mysqli_query($conn, $insert_query);
    /**********************For exceptions_name**************************/
    $inputFileName = "uploads/" . $file['exceptions_name'];
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $exceptions = $objPHPExcel->getActiveSheet()->toArray();
    mysqli_query($conn, "DROP TABLE IF EXISTS exceptions" . $_SESSION['id']);
    $sql = "CREATE TABLE exceptions" . $_SESSION['id'] . " (
				id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $end_key = '';
    $row_query = '';
    $table_col = array();
    foreach ($exceptions[0] as $key => $row) {
        if ($row == Null) {
            break;
        }
        array_push($table_col, '`' . $row . '`');
        $sql .= '`' . $row . '`' . "  VARCHAR(255) NOT NULL,";
        $end_key = $key;
    }
    foreach ($exceptions as $key => $row) {
        $tmp_row = array_slice($row, 0, ($end_key + 1));
        array_walk($tmp_row, function (&$a) use ($conn) {
            $a = mysqli_real_escape_string($conn, $a);
        });
        $row_query .= "('" . implode("','", $tmp_row) . "'),";
    }
    $sql = substr($sql, 0, -1) . "  ) ";
    $insert_query = "INSERT INTO exceptions" . $_SESSION['id'] . " (" . implode(',', $table_col) . ") VALUES " . substr($row_query, 0, -1);
    mysqli_query($conn, $sql);
    mysqli_query($conn, $insert_query);
    /**********************For department_lists_name**************************/
    $inputFileName = "uploads/" . $file['department_lists_name'];
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $department_lists = $objPHPExcel->getActiveSheet()->toArray();
    mysqli_query($conn, "DROP TABLE IF EXISTS department_lists" . $_SESSION['id']);
    $sql = "CREATE TABLE department_lists" . $_SESSION['id'] . " (
				id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $end_key = '';
    $row_query = '';
    $table_col = array();
    foreach ($department_lists[0] as $key => $row) {
        if ($row == Null) {
            break;
        }
        array_push($table_col, '`' . $row . '`');
        $sql .= '`' . $row . '`' . "  VARCHAR(255) NOT NULL,";
        $end_key = $key;
    }
    foreach ($department_lists as $key => $row) {
        $tmp_row = array_slice($row, 0, ($end_key + 1));
        array_walk($tmp_row, function (&$a) use ($conn) {
            $a = mysqli_real_escape_string($conn, $a);
        });
        $row_query .= "('" . implode("','", $tmp_row) . "'),";
    }
    $sql = substr($sql, 0, -1) . "  ) ";
    $insert_query = "INSERT INTO department_lists" . $_SESSION['id'] . " (" . implode(',', $table_col) . ") VALUES " . substr($row_query, 0, -1);
    mysqli_query($conn, $sql);
    mysqli_query($conn, $insert_query);
    /**********************For wholesale_price_books_name**************************/
    $inputFileName = "uploads/" . $file['wholesale_price_books_name'];
    $sheetnm = 'PRICE BOOK';
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName); 
    $objPHPExcel->setActiveSheetIndexByName('PRICE BOOK');
    $wholesale_price_books = $objPHPExcel->getActiveSheet()->toArray();
    mysqli_query($conn, "DROP TABLE IF EXISTS wholesale_price_books2_" . $_SESSION['id']);
    $sql = "CREATE TABLE wholesale_price_books2_" . $_SESSION['id'] . " (
				id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $end_key = '';
    $row_query = '';
    $table_col = array();
    foreach ($wholesale_price_books[0] as $key => $row) {
        if ($row == Null) {
            break;
        }
        array_push($table_col, '`' . $row . '`');
        $sql .= '`' . $row . '`' . "  VARCHAR(255) NOT NULL,";
        $end_key = $key;
    }

    foreach ($wholesale_price_books as $key => $row) {
        $tmp_row = array_slice($row, 0, ($end_key + 1));
        array_walk($tmp_row, function (&$a) use ($conn) {
            $a = mysqli_real_escape_string($conn, $a);
        });
        $row_query .= "('" . implode("','", $tmp_row) . "'),";
    }
    $sql = substr($sql, 0, -1) . "  ) ";
    $insert_query = "INSERT INTO wholesale_price_books2_" . $_SESSION['id'] . " (" . implode(',', $table_col) . ") VALUES " . substr($row_query, 0, -1);
    mysqli_query($conn, $sql);
    mysqli_query($conn, $insert_query);
    /*****************Updating Excel Data into Mysql**********************/
    mysqli_query($conn, "update users set analyzed = 1 where id = '" . $_SESSION['id'] . "'");
    //$_SESSION['msg'] = 'Analysis complete.';
	header("location:my_downloads.php");
}
if ($_REQUEST['type'] == 'contact_us_email') {
	// the message
	$msg = $_POST['email']."\r\n\r\n".$_POST['message'];

	// use wordwrap() if lines are longer than 70 characters
	$msg = wordwrap($msg,70);

	// send email
	$adEmail = mysqli_query($conn,"SELECT admin_email FROM users WHERE id = '1'")->fetch_assoc();
	$adminEmail = $adEmail['admin_email'];
	$mailSuccess = mail($adminEmail,$_POST['subject'],$msg,$_POST['email']);
	if (!$mailSuccess) {
		$_SESSION['msg'] = error_get_last()['message'];
	} else {
    	$_SESSION['msg'] = 'Email sent successfully.';
	}
    header("location:contact_us.php");
}