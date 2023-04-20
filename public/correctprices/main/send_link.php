
<?php include "include/db.php"; 
session_start();
?>
<?php
if(isset($_POST['submit_email']) && $_POST['email'])
{
  $email = $_POST['email'];
  $select=mysqli_query($conn, "select email,password from users where email= '" . $email . "'");
  if(mysqli_num_rows($select)==1)
  {
    while($row=mysqli_fetch_array($select))
    {
      $hemail=md5($row['email']);
      $pass=md5($row['password']);
    }
    $link='<a href="http://www.correctprices.com/reset.php?key='.$hemail.'&reset='.$pass.'">Click To Reset Password</a>';
    $msg = "If you initiated this reset request and need to create a <br> new password, click here to choose a new one: <br>" . $link;
	  
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	// send email
	$mailSuccess = mail($email,'Reset Password',$msg,$headers);
	if (!$mailSuccess) {
		$_SESSION['msg'] = error_get_last()['message'];
	} else {
    	$_SESSION['msg'] = 'Email sent successfully.  Please click the link in the email to continue the reset password process. <br> If it does not appear in your Inbox within a couple of minutes, check your spam folder for an email with "Reset Password" in the subject.';
	}
    header("location:reset_pass.php");
  }	
}

	
?>

