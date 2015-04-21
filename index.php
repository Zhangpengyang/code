<?php
date_default_timezone_set("Asia/Tokyo");
session_start();

if(isset($_GET['delete'])){
	unset($_SESSION['username']);
}
if(empty($_SESSION['username'])){
	$_SESSION['username'] = 'ゲスト';
}
$username = $_SESSION['username'];

$dbcon=mysqli_connect('localhost','root','','presentation');
if(!$dbcon){
	print('DB接続失敗');
	exit;
}
mysqli_set_charset($dbcon,'utf8');

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
			print('<html>');
			print('<head>');
			print('</head>');
			print('<body>');
			print('<div id="ifError">');
			print("ユーザーIDあるいはパスワードが存在しません");
			print("<br/>");
			print('<a href="login1.php">戻る</a>');
			print('</div>');
			print('</body>');
			print('</html>');
		 	exit;
		}
		$username = $_SESSION['username'];
	}
	else{
		$_SESSION['username'] = $_GET['username'];	
		$username = $_SESSION['username'];
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HOME</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/top.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/common.css" rel="stylesheet" type="text/css">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
<link rel="stylesheet" type="text/css" href="../css/screen.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/slaid.js"></script>

</head>

<body>
	<div id="wrapper">
			<div id="header">
				<div id="nav">

					<h1><a href="#" class="nav0"><img src="../images/logo.gif" alt="let's dunk"></a></h1>
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
												<input id="searchicon" type="submit"  name="sb" value="検索">
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
							print('<a href="login1.php" class="nav">');
							print('ログイン');
							print('</a>');
							print('</li>');
							print('<li>');
							print('<a href="entry.php" class="nav">');
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
							print('こんにちは　'.$username.'さん');							
						}
						else{
							print('ようこそゲストさん');
						}					
						print('</div>');
					?>
					<div id='news'>
						<?php
							$sql_reply = "SELECT";
							$sql_reply .= " *";
							$sql_reply .= " FROM";
							$sql_reply .= " reply";
							$sql_reply .= " WHERE";
							$sql_reply .= " username";
							$sql_reply .= " =";
							$sql_reply .= ' "';
							$sql_reply .= "$username";
							$sql_reply .= '"';

							$insert_reply=mysqli_query($dbcon,$sql_reply);
							print('<Marquee onmouseover=this.stop() onmouseout=this.start()>');
							while($row_reply=mysqli_fetch_assoc($insert_reply)){

								$content = $row_reply['content'];
								$goodsname = $row_reply['g_name'];
								$color = $row_reply['color'];
								$sql_search = "SELECT";
								$sql_search .= " g_id";
								$sql_search .= " FROM";
								$sql_search .= " goods";
								$sql_search .= " ,";
								$sql_search .= " color_shoku";
								$sql_search .= " WHERE";
								$sql_search .= " goods.g_color";
								$sql_search .= " =";
								$sql_search .= " color_shoku.g_color";
								$sql_search .= " AND";
								$sql_search .= " g_name";
								$sql_search .= " =";
								$sql_search .= ' "';
								$sql_search .= "$goodsname";
								$sql_search .= '" ';
								$sql_search .= " AND";
								$sql_search .= " color";
								$sql_search .= " =";
								$sql_search .= ' "';
								$sql_search .= "$color";
								$sql_search .= '" ';
								$sql_search .= ";";

								$insert_search=mysqli_query($dbcon,$sql_search);
								$row_search=mysqli_fetch_assoc($insert_search);


								print('<a href="goods.php?id='.$row_search['g_id'].'">');
								print($row_reply['content']);
								print('</a>');
								print('　　　');
								
							}
							print('</Marquee>');
						?>										
					</div>
				</div>
									
			</div><!--id="header"終了-->

			<div id="container">
				
				<div id="mainpic">
					<div id="slider_main">
						<ul>
						<li><a href="tokusyu.php?series=LEBRON"><input type="hidden" name="LEBRON"><img src="../images/main1.jpg" width="960" height="350" alt="main1" /></a></li>
						<?php 						
							print('<li>');
							if($username != 'ゲスト'){
								$sqlx = "SELECT";
								$sqlx .= " *";
								$sqlx .= " FROM";
								$sqlx .= " user";
								$sqlx .= " WHERE";
								$sqlx .= " u_name";
								$sqlx .= " =";
								$sqlx .= ' "';
								$sqlx .= "$username";
								$sqlx .= '"';
								$sqlx .= ' ;';
								$insertx=mysqli_query($dbcon,$sqlx);
							    $rowx=mysqli_fetch_assoc($insertx);
							    $position1 = $rowx['position'];
							    $_SESSION['positionx'] = $position1;
							 print('<a href="tokusyu1.php?position='.$position1.'">');
							 print('<input type="hidden" name="'.$position1.'">');
							 print('<img src="../images/main2.jpg" width="960" height="350" alt="main2">');
							 print('</a>');					
							}
							else {
								print('<a href="login1.php">');
								print('<img src="../images/main2.jpg" width="960" height="350" alt="main2">');
							 	print('</a>');
							}
							print('</li>');
						?>
						<li><a href="tokusyu.php?series=KEVIN"><input type="hidden" name="KEVIN"><img src="../images/main3.jpg" width="960" height="350" alt="main3" /></a></li>
					
						</ul>
					</div><!--/#slide_main-->

					<div id="slider_thumb">
						<ul>
						<li><img src="../images/point_03.png" width="10" height="10" alt="point"></li>
						<li><img src="../images/point_03.png" width="10" height="10" alt="point"></li>
						<li><img src="../images/point_03.png" width="10" height="10" alt="point"></li>
					
					
						</ul>
					</div><!--/#slide_thumb-->
				</div>
				
				<div id="osusume">
					<?php
					if($username != 'ゲスト'){
						print('<a href="tokusyu1.php?position='.$position1.'">');
						 print('<input type="hidden" name="'.$position1.'">');
						 print('<span>');
						 print('<img src="../images/Retro-Ribbons-elements222_02.png" alt="あなたのポジションに合う商品はこちら！！">');
						 print('</span>');
						 print('</a>');		
					}
					else {
						print('<a href="login1.php">');
						print('<span>');
						print('<img src="../images/Retro-Ribbons-elements222_02.png" alt="あなたのポジションに合う商品はこちら！！">');
						print('</span>');
					 	print('</a>');
					}
					?>					
				</div>

				<?php
				if($username!='ゲスト'){
					print('<p id="bbs"><a href="#form1"><img src="../images/f00348.png" width="170" height="170" alt="リクェスト"></a></p>');
				}
				else{
					print('<p id="bbs"><a href="login1.php"><img src="../images/f00348.png" width="170" height="170" alt="リクェスト"></a></p>');
				}
				?>
					

				<div id="up">
					
					<form action="step1.php" method="get">
					<div id="brand">
						<p>ブランド一覧</p>
						<ul class="brand">
							<?php
								$sql1 = "SELECT";
								$sql1 .= " *";
								$sql1 .= " FROM";
								$sql1 .= " maker_makername";
								$sql1 .= ";";

								$insert1=mysqli_query($dbcon,$sql1);
								while($row1=mysqli_fetch_assoc($insert1)){
									print('<li><a href="step1.php?maker='.$row1['g_maker'].'">');
									print('<input type="hidden"  name="maker" value="'.$row1['g_maker'].'">');
									print($row1['makername']);
									print('</a>');
									print('</li>');
								}

							?>
						</ul>
					</div><!--id=brand終了-->
					<div id="position">
						<p>ポジションンから探す</p>
						<ul class="position">
							<?php
								$sql3 = "SELECT";
								$sql3 .= " *";
								$sql3 .= " FROM";
								$sql3 .= " position";
								$sql3 .= ";";
								$insert3=mysqli_query($dbcon,$sql3);
								while($row3=mysqli_fetch_assoc($insert3)){
									print('<li>');
									print('<a href="step1.php?position='.$row3['g_position'].'">');
									print('<input type="hidden" name="position" value="'.$row3['g_position'].'">');
									print($row3['position']);
									print('</a>');
									print('</li>');
								}
							?>
						</ul>
					</div>

					<div id="price">
						<p>値段から探す</p>
						<ul class="price">
							<li><a href="step1.php?price=10000"><input type="hidden" name="price" value="10000">～￥10,000</a></li>
							<li><a href="step1.php?price=20000"><input type="hidden" name="price" value="20000">￥10,001～￥20,000</a></li>
							<li><a href="step1.php?price=30000"><input type="hidden" name="price" value="30000">￥20,001～￥30,000</a></li>
							<li><a href="step1.php?price=40000"><input type="hidden" name="price" value="40000">￥30,001～￥40,000</a></li>
							<li><a href="step1.php?price=40001"><input type="hidden" name="price" value="40001">￥40,001～</a></li>
						 	</ul>
					</div>

					<div id="color">
						<p>メインカラーから探す</p>
						<ul>
							<?php
								$sql4 = "SELECT";
								$sql4 .= " *";
								$sql4 .= " FROM";
								$sql4 .= " color_shoku";
								$sql4 .= ";";
								$insert4=mysqli_query($dbcon,$sql4);
								while($row4=mysqli_fetch_assoc($insert4)){
									print('<li>');
									print('<a href="step1.php?color='.$row4['g_color'].'">');
									print('<input type="hidden" name="color" value="'.$row4['g_color'].'">');
									print('<img src="'.$row4['c_url'].'" alt="'.$row4['color'].'" width="16" height="16">');
									print('</a>');
									print('</li>');
								}
							?>
						</ul>
					</div><!--id="color"完了-->
				</form>
				</div><!--id="up"終了-->
	
				<div id="bottom">	
							
						<h2>新作商品</h2>
						<div id="new">
						<?php
							
							$sql = "SELECT";
							$sql .= " *";
							$sql .= " FROM";
							$sql .= " goods";
							$sql .= " ORDER BY";
							$sql .= " u_date";
							$sql .= " DESC";
							$sql .= " LIMIT";
							$sql .= " 10";
							$sql .= ";";

							$insert=mysqli_query($dbcon,$sql);
							while($row=mysqli_fetch_assoc($insert)){
								print('<div class="content">');
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
								print('<div class="name">');
								print('<p class="ser">');
								print('<a href="goods.php?id='.$row['g_id'].'">');
								print('<input type = "hidden" name = "id" value = "'.$row['g_id'].'">');
								print($row['g_ser']);
								print('</a>');
								print('</p>');
								print('<p class="goodsname">');
								print('<a href="goods.php?id='.$row['g_id'].'">');
								print('<input type = "hidden" name = "id" value = "'.$row['g_id'].'">');
								print($row['g_name']);
								print('</a>');
								print('</p>');								
								print('</div>');
								print('<div class="goodsprice">');
								print("¥");
								print(number_format($row['g_price']*$row['s_price']));
								print('</div>');							
								print('</div>');
						}
						?>
					</div>
					<div id="form">
					    <h2>リクェスト</h2>
					    <div id="form1">
							<p>欲しい商品の情報を入力してください</p>
							<form method="POST" action="bbs.php">
								<textarea name="content"></textarea>
								<br>
								<input type="submit" value="送信" id="submit">
							</form>
						</div>
					</div>	
				</div><!--id="bottom"-->
			</div><!--id="container"終了-->
	
			
					<div id="footer">
					    <div id="add">						
							<p>Copyright&copy; Pengyang. All Rights Reserved.</p>
					    </div>
					    <div id="page-top">
							<p><a id="move-page-top">▲</a></p>
						</div>
					   
					
				
			
			</div><!--id="foot"終了-->
		</div><!--id="wrapper"終了-->
</body>
</html>
