<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Decript phone by email</title>
</head>
<body>
  <?php
    if( isset($_POST['email'])  && !empty($_POST['email']) ){
		$mysqli = new mysqli("localhost", "test", "test", "test");
		$q = $mysqli->query("select * from users where  email = '".md5($_POST['email'])."'"); // find email in table
		if($q->num_rows ){
			$row = $q->fetch_array();
			$iv = mcrypt_create_iv (mcrypt_get_iv_size (MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
			$phone_decript = mcrypt_decrypt (MCRYPT_RIJNDAEL_256, base64_encode($_POST['email']), $row['phone'], MCRYPT_MODE_ECB, $iv);   // decript PHONE
			mail ($_POST['email']  , 'Retrive your phone' ,'Your phone is '.$phone_decript ); // send mail with encrypt phone
		}
		$mysqli->close();
	}
  ?>
  <p>Retrive your phone number</p>
  <form action="" method="post">
   <p>
      Enter your e-mail<br>
      <input name="email" type="email" value="">
   </p>
   <p>The phone number will be e-mailed to you</p>
   <p>   
     <input type="submit" value="Submit">
   </p>
  </form>
</body>
</html>