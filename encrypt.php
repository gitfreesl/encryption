<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Encript phone & email</title>
</head>
<body>
  <?php
    if(isset($_POST['email']) && isset($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['phone'])){ 
		$mysqli = new mysqli("localhost", "test", "test", "test");
		
		$iv = mcrypt_create_iv (mcrypt_get_iv_size (MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$key = base64_encode($_POST['email']);
		$phone_encript = mcrypt_encrypt (MCRYPT_RIJNDAEL_256, $key, $_POST['phone'], MCRYPT_MODE_ECB, $iv);   // encript PHONE
		$email_encript = md5($_POST['email']);     // encript EMAIL by md5
		$phone_encript = $mysqli->real_escape_string($phone_encript); // escape special characters
		echo $phone_encript.'<br>';
		echo $email_encript;
		$mysqli->query("insert into users (email,phone) values('".$email_encript."','".$phone_encript."')");
		$mysqli->close();
	}
   
  ?>
  <p>Add your phone number</p>
  <form action="" method="post">
   <p>
      Enter your PHONE<br>
      <input name="phone" type="tel" value="">
   </p>
   <p>
      Enter your e-mail<br>
      <input name="email" type="email" value="">
   </p>
   <p>   
     <input type="submit" value="Submit">
   </p>
  </form>
</body>
</html>
