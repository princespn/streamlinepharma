<!DOCTYPE html>
<html>
<head>
<title>Delhivery Slip</title>
<style>
table{
    border-collapse: collapse;
}    
table tr td,th{
    border:2px solid black;
}
td{
    padding:0px
}
.center{
    text-align:Center;
}
</style>
</head>
<body onload="window.print()">

<table style='width:400px;margin:auto'>

<tr>
    <td colspan='3' style='width:50%'><img src="<?php echo e($data['cl_logo']); ?>" style="width:100%"></td>
    <td colspan='3' ><img src="<?php echo e($data['delhivery_logo']); ?>" style="width:100%"></td>
</tr>
<tr>
    <td colspan='6'>
        <img src="<?php echo e($data['barcode']); ?>" style="display:block;margin:auto;">
        <div><span><?php echo e($data['pin']); ?></span><span style="display: inline-block;float: right;"><?php echo e($data['sort_code']); ?></span></div>
    </td>
</tr>
<tr>
    
               <td colspan='4'>
                 <strong>Ship To:</strong><br>
                 <strong><?php echo e($data['name']); ?></strong><br>
                 <span><?php echo e($data['address']); ?></span><br>
                 <span><?php echo e($data['destination']); ?></span><br>
                 <strong>PIN:<?php echo e($data['pin']); ?></strong>
               </td>
               <td colspan='2' class='center'>
                   <h3><?php echo e($data['pt']); ?></h3>
                   <h3>INR <?php echo e($data['rs']); ?></h3>
               </td>
</tr>
<tr>
    <td colspan='4'>
        <strong>Seller:</strong><?php echo e($data['cl']); ?><br>
        <strong>Address:</strong><?php echo e($data['sadd']); ?>

    </td>
    <td colspan='2'>
    <strong>Date:</strong><?php echo e(str_replace('T',' ',$data['cd'])); ?>

    </td>
</tr>
<tr>
    <th colspan='4'>Product(Qty)	</th>
    <th>Price</th>
    <th>Total</th>
</tr>
<tr>
    <td colspan='4'><?php echo e($data['prd']); ?></td>
    <td>INR <?php echo e($data['rs']); ?></td>
    <td>INR <?php echo e($data['rs']); ?></td>
</tr>
<tr>
    <th colspan='4'>Total</th>
    <th>INR <?php echo e($data['rs']); ?></th>
    <th>INR <?php echo e($data['rs']); ?></th>
</tr>
<tr>
    <td colspan='6'>
    <img src="<?php echo e($data['oid_barcode']); ?>" style="display:block;margin:auto;">
    </td>
</tr>
<tr>
    <td colspan='6'>
    Return Address: <?php echo e($data['radd']); ?>

    </td>
</tr>
</table>

</body>
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/advance_product/delhivery_slip.blade.php ENDPATH**/ ?>