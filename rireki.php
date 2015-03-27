<?php
session_start();
if(!isset($_SESSION['username'])){
	print('セッションエラー');
	exit;
}
else{
	$username=$_SESSION['username'];
}

$dbcon=mysqli_connect('localhost','root','','presentation');
 if(!$dbcon){
    print('DB接続失敗');
    exit;
 }

 mysqli_set_charset($dbcon,'utf8');

$sqlx = "SELECT";
$sqlx .= " name";
$sqlx .= " FROM";
$sqlx .= " user";
$sqlx .= " WHERE";
$sqlx .= " u_name";
$sqlx .= " =";
$sqlx .= ' "';
$sqlx .= "$username";
$sqlx .= '"';
$sqlx .= ";";
$insertx=mysqli_query($dbcon,$sqlx);
$rowx=mysqli_fetch_assoc($insertx);





$sql = "SELECT";
$sql .= " *";
$sql .= " FROM";
$sql .= " sell";
$sql .= " WHERE";
$sql .= " u_name";
$sql .= " =";
$sql .= ' "';
$sql .= "$username";
$sql .= '"';
$sql .= " AND";
$sql .= " userflag";
$sql .= " =";
$sql .= " 1";
$sql .= " ORDER BY";
$sql .= " o_no";
$sql .= " DESC";
$sql .= ";";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/rireki.css" rel="stylesheet" type="text/css">
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
						print('<img src="../images/logo.gif" alt="letdunk">');
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
					print('</div>');
				?>
			</div>
		</div><!--id="header"終了-->

		<div id="container">
			<h2>購入履歴一覧</h2>
				<div id="goods">
					<?php
					print('<p id="text">');
					print($username.'様の購入履歴は以下の通りです。');
					print('<br>');
					print('ご注文は10分前後で購入履歴に反映されます。ご了承ください。');
					print('</p>');
					$insert=mysqli_query($dbcon,$sql);
					$count = 0;
					while($row=mysqli_fetch_assoc($insert)){
							print('<div class="content">');
							print('<div class="u_date">');
							print('<p>');
							print($row['o_date']);
							print('</p>');
							print('<p>');
							print('受取人:'.$rowx['name']);
							print('</p>');
							print('</div>');
							print('<div class="box1">');
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
							print('</div>');
							print('</form>');
							print('<div class="box">');							
							print('<div class="name">');
							print('<p class="goodsname">');
							print($row['g_name']);
							print('</p>');
							print('<p class="ser">');
							print($row['g_ser']);
							print('</p>');
							print('</div>');//name
							print('<div class="goodsprice">');
							print("¥");
							print($row['price']);
							print('</div>');//goodsprice
							print('<div class="amount">');
							print('<p class="amount1">');
							print('購入数量：');
							print($row['amount']);
							print('</p>');
							print('</div>');//amount
							print('</div>');//box
							print('</div>');
							print('<div class="img">');
							print('<a href="goods.php?id='.$row['g_id'].'">');
							print('<input type = "hidden" name = "id" value = "'.$row['g_id'].'">');
							print('<img src="../images/bt_red.gif" alt="もう一度購入">');
							print('</a>');
							print('</div>');							
							print('</div>');	
							$count = $count+1;
						}
						if($count == 0){
							print('<p id="text1">');
							print('商品はまだ購入されていません');
							print('</p>');
						}
					?>
				</div>
			</div><!---container end-->

			<div id="footer">
				<div id="add">				
					<p id="copyright">Copyright&copy; Pengyang. All Rights Reserved.</p>
				</div>	
				<div id="page-top">
					<p><a id="move-page-top">▲</a></p>
				</div>
			</div><!--id="foot"終了-->

		</div>
</body>
</html>