<?php
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商品詳細</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/cartlogin.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="header">
			<div id="nav">
				<h1><a href="index.php"><img src="../images/logo.gif" alt="lets dunk"></a></h1>								
			</div><!--id="nav"終了-->
			<div id="subnav">
				<div id="session">	
					<?php
						print('ようこそ'.$username.'さん');
					?>
				</div>
			</div>		
	</div>
	
	<div id="container">
		<div id="location">
			<?php 
				print('<a href="index.php?username='.$username.'">');
				print('TOP');
				print('</a>');
				print('>');
				print('ログイン');
			?>
		</div>

		
		<div id="pic"><img src="../images/newmember.jpg" alt="20000円以上は送料無料!"></div>
		<div id="box">		
			<div id="left">
				<form action="account.php" method="get" id="form1">
					<h2>LET'S DUNK メンバーの方はこちら</h2>
					<div id="id">
						<p>ユーザーネーム</p>
						<input type="text" name="username">
					</div>

					<div id="pass">
						<p>パスワード</p>
						<input type="password" name="pass">
					</div>
					
					<div id="submit1">
						<input type="image" id="login1" src="../images/login1.jpg" alt="login">
					</div>
				</form>
			</div>
			
			<div id="notuser">
				<h2>LET'S DUNK メンバーでない方はこちら</h2>
				<p>ログインのメリット</p>
				<ul>
					<li>あなたのポジションに合う商品の売上ランキングが閲覧可能</li>
					<li>購入履歴が確認できます</li>
				</ul>
				<p><a href="account.php">ログインせずに購入</a></p>
			</div>
		</div>
		
	</div>
	
		<div id="footer">
			<div id="add">				
				<p id="copyright">Copyright&copy; Pengyang. All Rights Reserved.</p>
			</div>	
			<div id="page-top">
				<p><a id="move-page-top">▲</a></p>
			</div>
		</div><!--id="foot"終了-->
	</div><!--id="wrapper"終了-->


</body>
</html>