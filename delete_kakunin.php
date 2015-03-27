<?php
session_start();
if(!isset($_SESSION['username'])){
print('セッションエラー');
exit;
}
else{
$username=$_SESSION['username'];
}

if(isset($_GET['id'])){
	$_SESSION['delete_id']=$_GET['id'];
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商品詳細</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/cart.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="header">
		<div id="nav">
			<h1><a href="index.php?username='.$username.'" class="nav"><img src="../images/logo.gif" alt="lets dunk"></a></h1>
		</div>
		<div id="subnav">					
			<?php
				print('<div id="session">');
				if(isset($username)){
					print('こんにちは　'.$username.'さん');							
				}
				else{
					print('ようこそゲストさん');
				}
				print('</div>');
			?>
		</div>
	</div>

	<div id="container1">
		<div id="location">
			<?php
				print('<p id="back">');
				print('<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る |　</a>');
				print('</p>');
				print('<p id="ttop">');
				print('<a href="index.php?username='.$username.'">');
				print('<input type="hidden" name="username" value="'.$username.'">');
				print('TOP');
				print('</a>');
				print('>');
				print('SHOPPINGCART');
				print('</p>');
			?>
		</div>
		<form action="cart.php" method="get">
		<p>カートの中の商品を削除します。よろしですか？</p>
		<p><a href="cart.php?key=yes"><input type="hidden" name="key" value="yes"><img src="../images/delete.png" alt="削除"></a></p>
		<p id="no"><a href="cart.php?key=no"><input type="hidden" name="key" value="no">戻る</a></p>
		</form>
	</div>

	<div id="footer">
			<div id="add">							
				<p id="copyright">Copyright&copy; Pengyang. All Rights Reserved.</p>
			</div>
			<div id="page-top">
				<p><a id="move-page-top">▲</a></p>
			</div>		
	</div><!--id="foot"終了-->
</body>
</html>
