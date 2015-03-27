<?php
session_start();
$username=$_SESSION['username'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HOME</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/login.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="header">
				<div id="nav">
					<?php
						print('<h1>');
						print('<a href="index.php" class="nav">');
						print('<img src="../images/logo.gif" alt="lets dunk">');
						print('</a>');
						print('</h1>');
					?>						
				</div><!--id="nav"終了-->
			</div><!--id="header"終了-->
			
			<div id="container">

					<p id="newmember"><img src="../images/newmember.jpg" alt="newmember" width="960" height="300"></p>				
					<div id="content">

					
						<div id="form1">
							<form  action=index.php method="get">
								<p class="member">LET' DUNK メンバーの方</p>
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
						</div><!--id="form1"終了-->
					
						<div id="notmember">
							<p class="notmember">LET'S DUNK メンバーではない方</p>
							<p id="melit">メンバーのメリット</p>
							<ul>
								<li>返品送料はいつも無料</li>
								<li>お届け先情報のご登録で2回目以降のご注文がスムーズぬなる</li>
								<li>ポジションに合わせたおすすめ情報が確認できる</li>
							</ul>
							
							<p id="guest"><a href="entry.html">会員登録</a></p>
						</div><!--id="notmenber"終了-->
					</div><!--id="content"終了-->
				</div><!--id="container"終了-->
			
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