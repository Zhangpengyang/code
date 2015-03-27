<?php 
session_start();
if(isset($_GET['position'])){
	$_SESSION['position'] = $_GET['position'];
}
$dbcon=mysqli_connect('localhost','root','','presentation');
		if(!$dbcon){
			print('DB接続失敗');
			exit;
		}
mysqli_set_charset($dbcon,'utf8');

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
<!--<link href="../css/ss.css" rel="stylesheet" type="text/css">-->
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
</head>

<body>
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
													<input id="searchicon" type="submit"  name="sb" value="検索">
												</th>
											</tr>
										</table>
									</form>	
								</div>	
							</li>	
							<li><a href="cart.php" class="nav">カート</a></li>
							<?php
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
				</div><!--"header" end-->

					<div id="container">
					<div id="location">
						<?php
							print('<p id="back">');
							print('<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る |　</a>');
							print('</p>');
							print('<p id="totop">');
							print('<a href="index.php?username='.$username.'">');
							print('<input type="hidden" name="username" value="'.$username.'">');
							print('TOP');
							print('</a>');						
							print('>');							
							print('あなたのポジションに合う商品');
							print('</p>');
						?>
					</div>

					<div id="content">
						
						<?php
						if(isset($_SESSION['position'])){
							$position = $_SESSION['position'];
							
							$sql = "SELECT";
								$sql .= " position";
								$sql .= " ,";
								$sql .= " u_sexual";
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
								while($row=mysqli_fetch_assoc($insert)){								
									$position = $row['position'];
									$sexual=$row['u_sexual'];
									$_SESSION['sex']=$sexual;						
								}

								$sql1 = "SELECT";
								$sql1 .= " goods.g_id";
								$sql1 .= " ,";
								$sql1 .= " goods.g_name";
								$sql1 .= " ,";
								$sql1 .= " goods.g_url";
								$sql1 .= " ," ;
								$sql1 .= " goods.g_ser";
								$sql1 .= " ,";
								$sql1 .= " g_price";
								$sql1 .= " ,";
								$sql1 .= " s_price";
								$sql1 .= " ,";
								$sql1 .= " goods.g_maker";
								$sql1 .= " ,";
								$sql1 .= " sum(amount)";
								$sql1 .= " FROM";
								$sql1 .= " goods";
								$sql1 .= " ," ;
								$sql1 .= " sell";
								$sql1 .= " WHERE";
								$sql1 .= " g_position";
								$sql1 .= " =";
								$sql1 .= ' "';
								$sql1 .= "$position";
								$sql1 .= '"';
								$sql1 .= " AND";
								$sql1 .= " g_kubun";
								$sql1 .= " =";
								$sql1 .= " $sexual";
								$sql1 .= " AND";
								$sql1 .= " goods.g_id";
								$sql1 .= " =";
								$sql1 .= " sell.g_id";
								$sql1 .= " GROUP BY";
								$sql1 .= " goods.g_id";
								$sql1 .= " ORDER BY";
								$sql1 .= " sum(amount)";
								$sql1 .= " DESC";
								/*$sql1 .= " LIMIT";
								$sql1 .= " 4";*/
								$sql1 .= ";";
								$insert1=mysqli_query($dbcon,$sql1);
								$insert2=mysqli_query($dbcon,$sql1);
								$count = 0;
								while($row2=mysqli_fetch_assoc($insert2)){	
									$count = $count+1;
								}
								print('<div id="text">');
								print($username.'様の登録したポジションは');
								if($position == 'c'){
									print('センターです');
								}
								if($position == 'pf'){
									print('パワーフォーワードです');
								}
								if($position == 'sf'){
									print('スモールフォーワードです');
								}
								if($position == 'pg'){
									print('ポイントガードです');
								}
								if($position == 'sg'){
									print('シューティングガードです');
								}
								print('<p>');
								print('対象商品('.$count.'アイテム)');
								print('</p>');
								print('</div>');
								while($row1=mysqli_fetch_assoc($insert1)){									
									print('<div class="content">');
									print('<form action = "goods.php" method="get">');
									print('<div class="pic">');
									print('<p>');
									print('<a href="goods.php?id='.$row1['g_id'].'">');
									print('<input type = "hidden" name = "id" value = "'.$row1['g_id'].'">');
									print('<img src="');
									print($row1['g_url']);
									print('" alt="'.$row1['g_name'].'" width="160" height="120">');
									print('</a>');
									print('</p>');
									print('<p>');
									if($row1['g_maker']==1){
										print('<img src="../images/nike.gif" alt="nike" width="30" height="30">');
									}
									if($row1['g_maker']==2){
										print('<img src="../images/adidas.gif" alt="adidas" width="30" height="30">');
									}
									if($row1['g_maker']==3){
										print('<img src="../images/jordan.gif" alt="jordan" width="30" height="30">');
									}
									print('</p>');
									print('</div>');
									print('</form>');
									print('<div class="name">');
									print('<p class="goodsname">');
									print($row1['g_name']);
									print('</p>');
									print('<p class="ser">');
									print($row1['g_ser']);
									print('</p>');
									print('</div>');
									print('<div class="goodsprice">');
									print("¥");
									print($row1['g_price']*$row1['s_price']);
									print('</div>');							
									print('</div>');
								}
						
						}
						unset($_SESSION['position']);
						unset($_SESSION['sex']);
						?>
					</div><!--id="content" end-->
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