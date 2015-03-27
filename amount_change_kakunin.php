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
	<div id="header">
	</div>
	<div id="container">
		<h1>在庫数を変更しました</h1>
		<p>現在の当該商品の在庫数は以下どおりです。</p>
		<?php
			session_start();
			$dbcon=mysqli_connect('localhost','root','','presentation');
			if(!$dbcon){
				print('DB接続失敗');
				exit;
			}
			mysqli_set_charset($dbcon,'utfs8');
			print('<table border="1px #000">');
			for($i=0;$i<$_SESSION['count'];$i++){
				if(isset($_GET['amount'.$i])){
					$g_id = $_SESSION['g_id']; 
					$size = $_SESSION['size'][$i];		
					$amount = $_GET['amount'.$i];
				}
				$sql = "SELECT";
				$sql .= " g_amount";
				$sql .= " FROM";
				$sql .= " goods_amount";
				$sql .= " WHERE";
				$sql .= " g_id";
				$sql .= " =";
				$sql .= ' "';
				$sql .= "$g_id";
				$sql .= '"';
				$sql .= " AND";
				$sql .= " g_size";
				$sql .= " =";
				$sql .= "$size";
				$sql .= " ;";
				$insert=mysqli_query($dbcon,$sql);
				$row=mysqli_fetch_assoc($insert);
				$new_amount = $row['g_amount']-$amount;
				$sql1 = 'UPDATE goods_amount SET g_amount = '.$new_amount.' WHERE g_id = "'.$g_id.'" AND g_size = '.$size;
				$insert1=mysqli_query($dbcon,$sql1);
				print('<tr>');
				print('<th>');
				print('サイズ');
				print('</th>');
				print('<th>');
				print('在庫数');
				print('</th>');
				print('</tr>');
				print('<tr>');
				print('<td>');
				print($size);
				print('</td>');
				print('<td>');
				print($new_amount);
				print('</td>');
				print('</tr>');
			}
			print('</table>');
		?>
	</div>
</body>
</html>