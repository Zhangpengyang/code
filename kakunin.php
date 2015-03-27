<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HOME</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/cart.css" rel="stylesheet" type="text/css">
</head>
<?php
$givenname = $_POST['givenname'];
$firstname = $_POST['firstname'];
$givennamekana = $_POST['givennamekana'];
$firstnamekana = $_POST['firstnamekana'];
$mail = $_POST['mail'];
$username = $_POST['username'];
$pass = $_POST['pass'];

$year = $_POST['year']."年";
$month = $_POST['month']."月";
$day = $_POST['day']."日";
$birthday = $year.$month.$day;
$post = $_POST['post'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$position = $_POST['position'];

$dbcon=mysqli_connect('localhost','root','','presentation');
if(!$dbcon){
	print('DB接続失敗');
	exit;
}

mysqli_set_charset($dbcon,'utfs8');

$sql = "SELECT";
$sql .= " *";
$sql .= " FROM";
$sql .= " user";
$sql .= " WHERE";
$sql .= " u_name";
$sql .= " =";
$sql .= ' "';
$sql .= "$username";
$sql .= '"';
$sql .= ";";



$insert=mysqli_query($dbcon,$sql);

$count = 0;

 while($row=mysqli_fetch_assoc($insert)){
 	foreach($row as $key => $val){
 		print("");
 	}
 $count = $count+1;
 
 }

 mysqli_free_result($insert);
 mysqli_close($dbcon);
 $mes = "ユーザーIDは使用できません。";
 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>会員登録確認</title>
</head>

<body>
<div id="container">
<form action="up_user.php" method="POST">
<p>名前(姓):<input type="hidden" value="<?php print($givenname); ?>" name="givenname"><?php print($givenname); ?></p>
<p>名前(名):<input type="hidden" value="<?php print($firstname); ?>" name="firstname"><?php print($firstname); ?></p>
<p>フリガナ(姓):<input type="hidden" value="<?php print($givennamekana); ?>" name="givennamekana"><?php print($givennamekana); ?></p>
<p>フリガナ(名):<input type="hidden" value="<?php print($firstnamekana); ?>" name="firstnamekana"><?php print($firstnamekana); ?></p>
<p>性別:<?php if(isset($_POST['sexual'])){
				if($_POST['sexual']==1){				
					print('男');		
					print('<input type="hidden" value="'.$_POST['sexual'].'" name="sexual1"');	 				
				}
				else {
					print('女');	
					print('<input type="hidden" value="'.$_POST['sexual'].'" name="sexual1"');					
				}
				 } ?></p>
<p>メールアドレス: <input type="hidden" value="<?php print($mail); ?>" name="mail"><?php print($mail); ?></p>
<p>ユーザーネーム: <input type="hidden" value="<?php print($username); ?>" name="username"><?php print($username);?>
					<span><?php if($count > 0){
									print($mes);
								}
							?></span></p>
					
<p>パスワード: <input type="hidden" value="<?php print($pass); ?>" name="pass"><?php print($pass); ?></p>
<p>パスワードの確認: <input type="hidden" value="<?php print($pass); ?>" name="pass1"><?php print($pass); ?></p>
<p>生年月日: <input type="hidden" value="<?php print($birthday); ?>" name="birthday"><?php print($birthday); ?><br>
<p>郵便番号: <input type="hidden" value="<?php print($post); ?>" name="post"><?php print($post); ?></p>
<p>ご住所: <input type="hidden" value="<?php print($address); ?>" name="address"><?php print($address); ?></p>
<p>電話番号: <input type="hidden" value="<?php print($tel); ?>" name="tel"><?php print($tel); ?></p>
<p>チームにおけるポジション: <input type="hidden" value="<?php print($position); ?>" name="position"><?php print($position); ?></p>

<p>
<?php
if($count > 0){
	print('<p><a href="entry.php">やり直し</a></p>');
}
else {
	$url = $_SERVER['HTTP_REFERER'];
	print('<input type="submit" value="entry">');
	print('<a href="'.$url.'">');
	print('入力内容を再編集');
	print('</a>');
}
?>
</p>
</form>
</body>
</body>
</html>
