<?php


if(isset($_GET['income'])){
	$income = $_GET['income'];
	$expense = $_GET['expense'];
	$balance = $_GET['balance'];

  	$subject="Mail from expense Manager";
  	$to="vighneshnayak280@gmail.com";

  	$message="Dear user your account status is as below:\n";
  	$message="Total Income: "  .$income ."\n";
  	$message="Total Expense :" .$expense ."\n";
  	$message="Balance in the account :" .$balance ."\n";

  	$header = "From : $to \r\n";
  	$header = "MIME-Version:1.0\n";
  	$header .= "Content-Type:text/html;charset=\"iso-8895-1\"\n";
  	$headers .= "X-Priority: 1 (Highest)\n";
  	$headers .= "X-MSMail-Priority:High\n";
  	$headers .= "Importance:High\n";

  	$mail_me = mail($to,$subject,$message,$headers);

  	if ($mail_me) {
  		echo 'email sent';
  	}
  	else{
  		echo 'error sending email';
  	}

  	

  }



?>