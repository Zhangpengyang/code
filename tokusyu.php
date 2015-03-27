<?php
session_start();
if(isset($_GET['series'])){
	$_SESSION['series'] = $_GET['series'];
}
if(isset($_GET['position'])){
	$_SESSION['position'] = $_GET['position'];
}
$dbcon=mysqli_connect('localhost','root','','presentation');
		if(!$dbcon){
			print('DB接続失敗');
			exit;
		}
mysqli_set_charset($dbcon,'utf8');

$username = 'ゲスト';
if(isset($_GET['username'])){
	if(isset($_GET['pass'])){
		$username1 = $_GET['username'];
		$pass1 = $_GET['pass'];
		if($username1 != $username1 || $pass1 != $pass1){
			print('ログインエラー');
			print('<a href="../login1.html">戻る</a>');
			exit;
		}
		else {				
			$_SESSION['username'] = $username1;
		}

		$sqlx = "SELECT";
		$sqlx .= " *";
		$sqlx .= " FROM";
		$sqlx .= " id_pass";
		$sqlx .= " ,";
		$sqlx .= " user";
		$sqlx .= " WHERE";
		$sqlx .= " user.u_name";
		$sqlx .= " =";
		$sqlx .= " id_pass.u_name";
		$sqlx .= " AND";
		$sqlx .= " id_pass.u_name";
		$sqlx .= " =";
		$sqlx .= ' "';
		$sqlx .= "$username1";
		$sqlx .= '"';
		$sqlx .= " AND";
		$sqlx .= " id_pass.u_pass";
		$sqlx .= " =";
		$sqlx .= ' "';
		$sqlx .= "$pass1";
		$sqlx .= '"';
		$sqlx .= ";";

		$insertx=mysqli_query($dbcon,$sqlx);

		$countx = 0;

		 while($rowx=mysqli_fetch_assoc($insertx)){
		 	foreach($rowx as $key => $val){
		 		print(" ");
		 	}
		 $countx = $countx+1;
		 }

		if($countx < 1){
			print("ユーザーIDあるいはパスワードが存在しません");
			print("<br/>");
			print('<a href="login1.php">戻る</a>');
		 	exit;
		}
	}
}

if(!isset($_SESSION['username'])){
	print('セッションエラー');
	exit;
}

else{
	$username=$_SESSION['username'];
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ナイキ</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/tokusyu.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
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
									print('<a href="index.php?username='.$username.'" class="nav">');
									print('<input type="hidden" name="username" value="'.$username.'">');
									print('<img src="../images/logo.gif" alt="lets dunk">');
									print('</a>');
									print('</h1>');								
							?>
							<ul>
							<li><a href="step1.php?sex=1" class="nav"><input type="hidden" name="sex" value="1">メンズ</a></li>
							<li><a href="step1.php?sex=0" class="nav"><input type="hidden" name="sex" value="0">ウィメンズ</a></li>
							<li><a href="step1.php?sex=2" class="nav"><input type="hidden" name="sex" value="2">キッズ</a></li>
							<li>
								<div id="search">
									<form action="step1.php" method="get">
										<table>
											<tr>
												<th>
													<input id="searchworld"  type="text"  name="search" >
													<input id="searchicon" type="image"  name="sb" src="../images/search1.jpg">
												</th>
											</tr>
										</table>
									</form>	
								</div>	
							</li>	
							<li><a href="cart.php" class="nav">カート</a></li>
							<?php
							if($username != 'ゲスト'){
							print('<li>');
							print('<a href="rireki.php" class="nav">');
							print('購入履歴');
							print('</a>');							
							print('</li>');
							print('<li>');
							print('<a href="index.php?delete=u" class="nav">');
							print('<input type="hidden" name="delete" value="u">');
							print('ログアウト');
							print('</a>');
							print('</li>');
						}
						else{
							print('<li>');
							print('<a href="login1.php" class="nav6">');
							print('ログイン');
							print('</a>');
							print('</li>');
							print('<li>');
							print('<a href="../entry.php" class="nav7">');
							print('会員登録');
							print('</a>');
							print('</li>');
						}
						?>
						</ul>
					</div><!--id="nav"終了-->
					<div id="subnav">
						<?php
						print('<div id="session">');
						if(isset($username)){
							print('ようこそ'.$username.'さん');
						}
						else{
							print('ようこそゲストさん');
						}
						print('</div>');
						?>
					</div>
			</div><!--header end-->

					<div id="container">
						<div id="location">
							<?php
								print('<a href="index.php?username='.$username.'">');
								print('<input type="hidden" name="username" value="'.$username.'">');
								print('TOP');
								print('</a>');
								print('>');
								print('特集');
							?>
						</div>

						<div id="content">
						<?php
							print('<div id="text">');
							 if(isset($_SESSION['series'])){
							 	$series = $_SESSION['series'];
							 	print('特集：');
							 	if($series == 'LEBRON'){
							 		print('LEBRON JAMES');
							 	}
							 	if($series == 'KEVIN'){
							 		print('KEVIN DURANT');
							 	}
						 	print('</div>');
							
						 	$sql = "SELECT";
						 	$sql .= " *";
						 	$sql .= " FROM";
						 	$sql .= " goods";
						 	$sql .= " WHERE";
						 	$sql .= " g_series";
						 	$sql .= " LIKE";
						 	$sql .= ' "';
						 	$sql .= "%";
						 	$sql .= "$series";
						 	$sql .= "%";
						 	$sql .= '"';
						 	$sql .= " ;";
						 
						 $insert=mysqli_query($dbcon,$sql);
						 while($row=mysqli_fetch_assoc($insert)){
							print('<div class="content">');
							print('<form action = "goods.php" method="get">');
							print('<div class="pic">');
							print('<p>');
							print('<a href="goods.php?id='.$row['g_id'].'">');
							print('<input type = "hidden" name = "id" value = "'.$row['g_id'].'">');	
							print('<img src="');
							print($row['g_url']);
							print('" alt="'.$row['g_name'].'" width="160" height="120">');
							print('</a>');
							print('</p>');
							print('<p>');
							if($row['g_maker']==1){
								print('<img src="../images/nike.gif" alt="nike" width="30" height="30">');
							}
							if($row['g_maker']==2){
								print('<img src="../images/adidas.gif" alt="adidas" width="30" height="30">');
							}
							if($row['g_maker']==3){
								print('<img src="../images/jordan.gif" alt="jordan" width="30" height="30">');
							}
							print('</p>');
							print('</div>');
							print('</form>');								
							print('<div class="name">');
							print('<p class="goodsname">');
							print($row['g_name']);
							print('</p>');
							print('<p class="ser">');
							print($row['g_ser']);
							print('</p>');
							print('</div>');
							print('<div class="goodsprice">');
							print("¥");
							print($row['g_price']*$row['s_price']);
							print('</div>');							
							print('</div>');
						}
						}

						
						unset($_SESSION['series']);

						?>
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