<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商品在庫数変更</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
<script type="text/javascript" src="../js/check1.js"></script>
</head>

<body>
	<h1>商品在庫数変更</h1>
	<br>
	<form action="amount_change_kakunin.php" method="GET">
		<?php
		session_start();
			for($i=0; $i<$_SESSION['count']; $i++){
				print('商品番号'.$_SESSION['g_id']);
				print('サイズ'.$_SESSION['size'][$i]);
				print('販売個数<input type="text" name="amount'.$i.'">');
				print('<br>');
			}
			print('<input type="submit" value="変更">');
		?>
	</form>
</body>
</html>