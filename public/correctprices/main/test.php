<?php
        require_once "PHPExcel/Classes/PHPExcel.php";
        $inputFileName = "uploads/wholesale_price_books_10_1601050251.xlsx"; 
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$objPHPExcel->setActiveSheetIndex(1);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		var_dump($sheetData);