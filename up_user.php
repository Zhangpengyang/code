<html>
<head>
<title>登録完了</title>
</head>
<body>
<?php
	session_start();
	$givenname1=$_POST['givenname'];
	
	
	$firstname1=$_POST['firstname'];
	
	
	$name = $givenname1.$firstname1;
	
	
	$givennamekana1=$_POST['givennamekana'];

	
	$firstnamekana1=$_POST['firstnamekana'];
	
	
	$namekana = $givennamekana1.$firstnamekana1;
	
	
	$sexual2 = $_POST['sexual1'];
	
	
	$mail1 = $_POST['mail'];
	
	
	$username1 = $_POST['username'];
	
	
	$pass1 = $_POST['pass'];
	
	
	

	
	$birthday = $_POST['birthday'];
	
	
	$post1 = $_POST['post'];

	
	$address1 = $_POST['address'];

	
	$tel1 = $_POST['tel'];

	

	
	$position1 = $_POST['position'];

	


$dbcon=mysqli_connect('localhost','root','','presentation');
 if(!$dbcon){
    print('DB接続失敗');
    exit;
 }


 
 mysqli_set_charset($dbcon,'utfs8');
 
 $sql1 = "SELECT";
 $sql1 .= " *";
 $sql1 .= " FROM";
 $sql1 .= " user";
 $sql1 .= " WHERE";
 $sql1 .= " u_id";
 $sql1 .= " LIKE ";
 $sql1 .= ' "';
 $sql1 .= "u%";
 $sql1 .= '"';
 $sql1 .= ";";
 

 
 $insert=mysqli_query($dbcon,$sql1);
 
 $count = 0;

 while($row=mysqli_fetch_assoc($insert)){
 	foreach($row as $key => $val){
 		print(" ");
 	}	
 		
 $count = $count+1;
 
 }
 
$no  = 1+$count;
$u_id = 'u000'.$no;


 $sql='INSERT INTO user( u_id, u_name, u_sexual, u_birthday, u_mail, u_post, u_ado, u_tel, position, name, namekana ) VALUES ( "'.$u_id.'", "'.$username1.'", "'.$sexual2.'", "'.$birthday.'", "'.$mail1.'", "'.$post1.'", "'.$address1.'", "'.$tel1.'", "'.$position1.'", "'.$name.'", "'.$namekana.'")';
 
 
 $insert1=mysqli_query($dbcon,$sql);



 $sql2 = 'INSERT INTO id_pass( u_name, u_pass ) VALUES ( "'.$username1.'", "'.$pass1.'")';

 $insert2=mysqli_query($dbcon,$sql2);

mysqli_free_result($insert);
mysqli_close($dbcon);

$_SESSION['name'] = $name;
?>

<p>登録ありがとうございます。</p>
<p><a href="php/loginx.php">ログインページに進む</a></p>
</body>
</html>