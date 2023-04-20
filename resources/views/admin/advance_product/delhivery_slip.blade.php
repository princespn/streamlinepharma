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
    <td colspan='3' style='width:50%'><img src="{{ $data['cl_logo'] }}" style="width:100%"></td>
    <td colspan='3' ><img src="{{ $data['delhivery_logo'] }}" style="width:100%"></td>
</tr>
<tr>
    <td colspan='6'>
        <img src="{{ $data['barcode'] }}" style="display:block;margin:auto;">
        <div><span>{{ $data['pin'] }}</span><span style="display: inline-block;float: right;">{{ $data['sort_code'] }}</span></div>
    </td>
</tr>
<tr>
    
               <td colspan='4'>
                 <strong>Ship To:</strong><br>
                 <strong>{{ $data['name'] }}</strong><br>
                 <span>{{ $data['address'] }}</span><br>
                 <span>{{ $data['destination'] }}</span><br>
                 <strong>PIN:{{ $data['pin'] }}</strong>
               </td>
               <td colspan='2' class='center'>
                   <h3>{{ $data['pt'] }}</h3>
                   <h3>INR {{ $data['rs'] }}</h3>
               </td>
</tr>
<tr>
    <td colspan='4'>
        <strong>Seller:</strong>{{ $data['cl'] }}<br>
        <strong>Address:</strong>{{ $data['sadd'] }}
    </td>
    <td colspan='2'>
    <strong>Date:</strong>{{ str_replace('T',' ',$data['cd']) }}
    </td>
</tr>
<tr>
    <th colspan='4'>Product(Qty)	</th>
    <th>Price</th>
    <th>Total</th>
</tr>
<tr>
    <td colspan='4'>{{ $data['prd'] }}</td>
    <td>INR {{ $data['rs'] }}</td>
    <td>INR {{ $data['rs'] }}</td>
</tr>
<tr>
    <th colspan='4'>Total</th>
    <th>INR {{ $data['rs'] }}</th>
    <th>INR {{ $data['rs'] }}</th>
</tr>
<tr>
    <td colspan='6'>
    <img src="{{ $data['oid_barcode'] }}" style="display:block;margin:auto;">
    </td>
</tr>
<tr>
    <td colspan='6'>
    Return Address: {{ $data['radd'] }}
    </td>
</tr>
</table>

</body>
</html>