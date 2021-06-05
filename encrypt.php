<?php

// Store a string into the variable which
// need to be Encrypted
$simple_string =645705175;

// Display the original string
 echo "Original String: " . $simple_string;

// Store the cipher method
$ciphering = "AES-128-CTR";

// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';

// Store the encryption key
$encryption_key = "GeeksforGeeks";

// Use openssl_encrypt() function to encrypt the data
$encryption =openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv);

// Display the encrypted stringecho"<br>";
echo"<br>";
echo "Encrypted String: " . $encryption . "\n";
echo"<br>";

// Non-NULL Initialization Vector for decryption
$decryption_iv = '1234567891011121';

// Store the decryption key
$decryption_key = "GeeksforGeeks";

// Use openssl_decrypt() function to decrypt the data
$decryption=openssl_decrypt ("$encryption", $ciphering,$decryption_key, $options, $decryption_iv);

// Display the decrypted string
echo"<br>";
echo "Decrypted String: " . $decryption;

?>
<?php 

$simple_string =7758840493;


$ciphering = "AES-128-CTR";

$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

$encryption_iv = '1234567891011121';

// Store the encryption key
$encryption_key = "chat_application";

$encryption =openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv);

 ?>

<?php  // echo $user_pass = md5(960061749);
// // $options =['cost'=>HASHCOST];
// // echo'<br>';
// //   echo $pass = password_hash('aman', PASSWORD_DEFAULT);
// //   echo'<br>';
// //   echo $pass = password_hash('aman', PASSWORD_DEFAULT);
// //   echo "string";echo'<br>';
// //   if(password_verify($user_pass, $pass) ){
// //     echo "sex";
// //   }else{
// //     echo "not matched";
// //   }
// //   echo'<br>';
//   $option=['cost'=>10];
//   echo $pass1 = password_hash(123456, PASSWORD_DEFAULT,$option);
// echo'<br>';
//   // if(password_verify('aman', $pass1) ){
//   //   echo "cost success";
//   // }else{
//   //   echo "not matched";
//   // }
//   // echo'<br>';
// die(); ?>
 