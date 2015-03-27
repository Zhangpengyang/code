<?php
session_start();

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
 if(isset($_GET['delete'])){
	unset($_SESSION['username']);
	$_SESSION['username'] = 'ゲスト';
}

else{
	$username=$_SESSION['username'];
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$_SESSION['id'] = $id;
}
$g_id = $_SESSION['id'];



$sql = "SELECT";
$sql .= " *";
$sql .= " FROM";
$sql .= " goods";
$sql .= " WHERE";
$sql .= " g_id";
$sql .= " =";
$sql .= ' "';
$sql .= "$g_id";
$sql .= '"';
$sql .= ";";
?>
<?php

$insert=mysqli_query($dbcon,$sql);
$row=mysqli_fetch_assoc($insert);

$o_price=$row['g_price']*$row['s_price'];
$ser = $row['g_ser'];
$series = $row['g_series'];
$kubun = $row['g_kubun'];
$syoukai = $row['g_shoukai'];
$name = $row['g_name'];
$url = $row['g_url'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商品詳細</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/goods.css" rel="stylesheet" type="text/css">
<link href="../css/swapimage.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script type="text/javascript" src="../js/swapimage.js"></script> 

</head>

<body>
	<div id="wrapper">
		<div id="header">
			<div id="nav">
				<?php 
					print('<h1>');
					print('<a href="index.php?username='.$username.'" class="nav0">');
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
					print('<a href="../entry.php" class="nav">');
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
			</div><!--subnav終了-->

		
		</div><!--id="header"終了-->


		<div id="container">	
			<div id="location">
				<?php
					print('<p id="back">');
					print('<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る |　</a>');
					print('</p>');
					print('<p id="ttop">');
					print('<a href="index.php?username='.$username.'">');
					print('TOP');
					print('</a>');
					print('</p>');
					print('>');
					print('対象商品:');
					print($name);
				?>
			</div>		
			<div id="top">
				<div id="left">
					<div class="mod_thumbnail">
						<div class="thumbnaillist">

							<?php
								$sqls = "SELECT";
								$sqls .= " *";
								$sqls .= " FROM";
								$sqls .= " thumbnail";
								$sqls .= " WHERE";
								$sqls .= " g_id";
								$sqls .= " =";
								$sqls .= '"';
								$sqls .= "$g_id";
								$sqls .= '"';
								$sqls .= " ;";

								$inserts=mysqli_query($dbcon,$sqls);
					 			$rows=mysqli_fetch_assoc($inserts);
					 			print('<p class="mainimglist">');
					 			print('<img src="'.$rows['url1'].'" alt="photo" width="480" height="360">');
					 			print('</p>');

					 			print('<p id="info">写真にマウスをのせると他のイメージを確認することができます</p>');
					 			print('<ul class="ex_clearfix">');
								print('<li class="li1"><a href="'.$rows['url1'].'" ><img src="'.$rows['url5'].'" width="60" height="60" alt="photo1"></a></li>');
								print('<li class="li2"><a href="'.$rows['url2'].'" ><img src="'.$rows['url6'].'" width="60" height="60" alt="photo2"></a></li>');
								print('<li><a href="'.$rows['url3'].'" ><img src="'.$rows['url7'].'" width="60" height="60" alt="photo3"></a></li>');
								print('<li class="li3"><a href="'.$rows['url4'].'" ><img src="'.$rows['url8'].'" width="60" height="60" alt="photo4"></a></li>');
								print('</ul>');
							?>	
							
						</div><!-- thumbnaillist_end -->
						
					</div><!-- mod_thumbnail_end -->					
				</div><!--id="left"終了-->

				<div id="right">
					<div id="goodssyousai">
						<div id="top1">
							<p id="ser">
								<?php
									print($ser);
								?>
							</p>
							<p id="img"><?php
								if($row['g_maker']==1){
									print('<img src="../images/nike.gif" alt="nike" width="50" height="50">');
								}
								if($row['g_maker']==2){
									print('<img src="../images/adidas.gif" alt="adidas" width="50" height="50">');
								}
								if($row['g_maker']==3){
									print('<img src="../images/jordan.gif" alt="jordan" width="50" height="50">');
								}
							?></p>
						</div>

						<p id="name">
							<?php
								print($name);
							?>
						</p>
						
							<?php
								print('<p id="price">');
								print('￥');
								print(number_format($o_price));
								print('</p>');
								print('<p class="syoukai">');
								print($syoukai);
								print('</p>');
							?>
						
					</div>


					<div id="buy">
					
						<form action="cart.php" method="GET">

							<div id="size">
								<p>サイズ</p>
								<select class="select_box" name="size" >
									<?php
										$sql_goods = "SELECT";
										$sql_goods .= " *";
										$sql_goods .= " FROM";
										$sql_goods .= " goods_amount";
										$sql_goods .= " WHERE";
										$sql_goods .= " g_id";
										$sql_goods .= " =";
										$sql_goods .= ' "';
										$sql_goods .= "$g_id";
										$sql_goods .= '"';

										$insert_goods=mysqli_query($dbcon,$sql_goods);
					 					while($row_goods=mysqli_fetch_assoc($insert_goods)){
					 						if($row_goods['g_amount']==0){
					 							print('<option disabled="disabled value="'.$row_goods['g_size'].'">');
					 							print($row_goods['g_size'].' ❌');
					 						}
					 						else{
					 							print('<option value="'.$row_goods['g_size'].'">');
					 							print($row_goods['g_size']);
					 						}
					 						
					 						print('</option>');
					 					}
									?>
								</select>
							</div>
								
							<div id="amount">	
								<p>数量</p>																	
								<select class="select_box" name="amount" >
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
							</div>
								<?php									
									print('<input type="hidden" name="idx" value="'.$g_id.'">');
									print('<input type="hidden" name="pricex" value="'.$o_price.'">');
									print('<input type="hidden" name="urlx" value="'.$url.'">');
									print('<input type="hidden" name="serx" value="'.$ser.'">');
									print('<input type="hidden" name="namex" value="'.$name.'">');
								?>
								<div id="cart"><input type="image" src="../images/incart.jpg" alt="カートに入れる">	</div>			
						</form>
					</div><!--id="buy"完了-->				
				</div><!--id="right"終了-->
			</div><!--id="top"終了-->

			<div id="bottom">	
				<div id="goods"> 				
					<?php
						$sql0 = "SELECT";
						$sql0 .= " g_color";
						$sql0 .= " ,";
						$sql0 .= " g_like";
						$sql0 .= " ,";
						$sql0 .= " g_kubun";
						$sql0 .= " ,";
						$sql0 .= " g_maker";
						$sql0 .= " FROM";
						$sql0 .= " goods";
						$sql0 .= " WHERE";
						$sql0 .= " g_id";
						$sql0 .= " =";
						$sql0 .= ' "';
						$sql0 .= "$g_id";
						$sql0 .= '"';
						$sql0 .= " ;";
						$insert0=mysqli_query($dbcon,$sql0);
						$row0=mysqli_fetch_assoc($insert0);

						$bestcolor = $row0['g_color'];
						$like = $row0['g_like'];
						$bestkubun = $row0['g_kubun'];
						$maker = $row0['g_maker'];
					?>
					<?php
						$sql1 = "SELECT";
						$sql1 .= " *";
						$sql1 .= " FROM";
						$sql1 .= " goods";						
						$sql1 .= " WHERE";
						$sql1 .= " g_color";
						$sql1 .= " =";
						$sql1 .= " $bestcolor";
						$sql1 .= " AND";
						$sql1 .= " g_kubun";
						$sql1 .= " =";
						$sql1 .= " $bestkubun";
						$sql1 .= " AND";
						$sql1 .= " goods.g_maker";
						$sql1 .= " =";
						$sql1 .= "$maker";
						$sql1 .= ";";
						$insert1=mysqli_query($dbcon,$sql1);
						$countx = 0;
						while($row1=mysqli_fetch_assoc($insert1)){
							if($row1['g_id'] != $g_id){
								$countx = $countx+1;																
							}							
						}
						
						if($countx > 1){
							$sql9 = "SELECT";
							$sql9 .= " *";
							$sql9 .= " FROM";
							$sql9 .= " goods";							
							$sql9 .= " WHERE";							
							$sql9 .= " g_color";
							$sql9 .= " =";
							$sql9 .= " $bestcolor";
							$sql9 .= " AND";
							$sql9 .= " g_kubun";
							$sql9 .= " =";
							$sql9 .= " $bestkubun";
							$sql9 .= " AND";
							$sql9 .= " goods.g_maker";
							$sql9 .= " =";
							$sql9 .= "$maker";
							$sql9 .= " AND";
							$sql9 .= " g_id";
							$sql9 .= " !=";
							$sql9 .= ' "';
							$sql9 .= "$g_id";
							$sql9 .= '"';
							$sql9 .= " ORDER BY";
							$sql9 .= " u_date";
							$sql9 .= " DESC";
							$sql9 .= " LIMIT";
							$sql9 .= " 5";
							$sql9 .= ";";
							$insert9=mysqli_query($dbcon,$sql9);
							
							print('<h2>');
							print('関連商品');
							print('</h2>');
							
							while($row9=mysqli_fetch_assoc($insert9)){
								if($row9['g_id'] != $g_id){	
									print('<div class="goods">');						
									print('<a href="goods.php?id='.$row9['g_id'].'">');
									print('<input type="hidden" name="id" value="'.$row9['g_id'].'">');
									print('<img src="'.$row9['g_url'].'" alt="'.$row9['g_id'].'" width="160" height="120">');
									print('</a>');
									print('<p>');
									if($row9['g_maker']==1){
									print('<img src="../images/nike.gif" alt="nike" width="30" height="30">');
									}
									if($row9['g_maker']==2){
										print('<img src="../images/adidas.gif" alt="adidas" width="30" height="30">');
									}
									if($row9['g_maker']==3){
										print('<img src="../images/jordan.gif" alt="jordan" width="30" height="30">');
									}
									print('</p>');
									print('<div class="name1">');
									print('<a href="goods.php?id='.$row9['g_id'].'">');
									print($row9['g_name']);
									print('</a>');
									print('</div>');
									print('<div class="ser1">');
									print('<a href="goods.php?id='.$row9['g_id'].'">');
									print($row9['g_ser']);
									print('</a>');
									print('</div>');
									print('<div class="price1">');
									print('￥'.$row9['g_price']*$row9['s_price']);
									print('</div>');
									print('</div>');
								}
							}
							
						}
					?>							
					</div><!--id="goods"終了-->	
				</div><!--id="bottom"終了-->		
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


		














