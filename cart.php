<?php
session_start();
$dbcon=mysqli_connect('localhost','root','','presentation');
if(!$dbcon){
print('DB接続失敗');
exit;
}
mysqli_set_charset($dbcon,'utfs8');

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
$sessionid = session_id();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ショッピングカート</title>
<meta http-equiv="content-script-type" content="text/javascript">
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/cart.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<div id="nav">
				<h1>
				<?php 
				print('<a href="index.php?username='.$username.'" class="nav0">');
				print('<img src="../images/logo.gif" alt="lets dunk">');
				print('</a>');
				?>
				</h1>
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
				</div>
			</div><!--id="header"終了-->

			<div id="container">
				<div id="location">
					<?php
						
						print('<p id="ttop">');
						print('<a href="index.php?username='.$username.'">');
						print('<input type="hidden" name="username" value="'.$username.'">');
						print('TOP');
						print('</a>');
						print('</p>');
						print('>');
						print('SHOPPING CART'); 
					?>
				</div><!--id="location" end-->
				<div id="step">
					<div id="naka">
						<p class="text1"><span>STEP1</span> ショッピングカート</p>
						<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
						<p class="text"><span>STEP2</span> 注文情報の入力</p>
						<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
						<p class="text"><span>STEP3</span> 注文内容の確認</p>
						<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
						<p class="text"><span>STEP4</span> 注文完了</p>
					</div>
				</div><!--id="step"終了-->

					<?php
						if(!isset($_SESSION['cartx'])){
							$_SESSION['cartx'] = array();
						}
						if(isset($_GET['delete'])){
							unset($_SESSION['cartx'][$_GET['delete']]);
							$count0=0;
							foreach($_SESSION['cartx'] as $value1){
								$biyou[$count0] = $value1;
								$count0 = $count0+1;
							}
							unset($_SESSION['cartx']);
							$_SESSION['cartx'] = array();
							for($j=0;$j<$count0;$j++){
								$_SESSION['cartx'][$j]=$biyou[$j];
							}
						}

						if(isset($_GET['idx'])&&isset($_GET['size'])&&isset($_GET['amount'])&&isset($_GET['serx'])&&isset($_GET['pricex'])&&isset($_GET['urlx'])&&isset($_GET['namex'])){
							print('<div id="box">');
							$cart= array( "g_id" => $_GET['idx'], "g_name" => $_GET['namex'], "g_size" => $_GET['size'], "g_amount" => $_GET['amount'], "g_url" => $_GET['urlx'], "g_price" => $_GET['pricex'], "g_ser" => $_GET['serx']);
							$id = $cart['g_id'];
							$size = $cart['g_size'];
							$amount = $cart['g_amount'];
							
							if(!empty($_SESSION['cartx'])){
								$countz = count($_SESSION['cartx']);
								for($k=0;$k<$countz;$k++){
									if($_SESSION['cartx'][$k]['g_id']==$id&&$_SESSION['cartx'][$k]['g_size']==$size){
										$a = $_SESSION['cartx'][$k]['g_amount']+$amount;
										$_SESSION['cartx'][$k] = array( "g_id" => $id, "g_name" => $_GET['namex'], "g_size" => $size, "g_amount" => $a, "g_url" => $_GET['urlx'], "g_price" => $_GET['pricex'], "g_ser" => $_GET['serx']);
										$unset=1;
									}
								}
								
								$countx=count($_SESSION['cartx']);
								if(isset($unset)){
									unset($cart);
								}
								else{
									$_SESSION['cartx'][$countx]=$cart;
								}
							}

							else{
								$countx=count($_SESSION['cartx']);
								$_SESSION['cartx'][$countx]=$cart;
							}
						}
						
						if(!empty($_SESSION['cartx'])){
							$countz=0;
							$total_price=0;
							$total_amount=0;
							print('<table id="cart_table">');
							print('<tr>');
							print('<th>');
							print('商品');
							print('</th>');
							print('<th>');
							print('名称');
							print('</th>');
							print('<th>');
							print('サイズ');
							print('</th>');
							print('<th>');
							print('数量');
							print('</th>');
							print('<th>');
							print('金額');
							print('</th>');
							print('<th>');
							print('');
							print('</th>');
							print('</tr>');
							foreach($_SESSION['cartx'] as $value){
								print('<tr>');
								print('<td>');
								print('<img src="'.$value['g_url'].'" alt="'.$value['g_id'].'" width="160" height="120">');							
								print($value['g_ser']);
								print('</td>');
								print('<td>');
								print($value['g_name']);
								print('</td>');
								print('<td>');
								print($value['g_size']);
								print('</td>');
								print('<td>');
								print($value['g_amount']);
								print('</td>');
								print('<td>');
								print('￥'.number_format($value['g_price']));
								print('</td>');
								print('<td>');
								print('<p>');
								print('<a href="cart.php?delete='.$countz.'">');
								print('削除');
								print('</a>');
								print('</p>');
								print('</td>');
								print('</tr>');
								$countz=$countz+1;								
								$total_price=$total_price+$value['g_price']*$value['g_amount'];
								$total_amount = $total_amount + $value['g_amount'];
							}
							if($total_price>=15000){
								$delevery=0;
							}
							else{
								$delevery=300;
							}
							print('</table>');
							print('<p id="textx">');
							print('※商品などの色合い、形状については使用するディスプレイやモニターの性能や設定条件によって、画面表示されたものと実物で異なる場合がございます。ご了承の上、ご注文ください。');
							print('</p>'); 
							print('<ul id="list">');
							print('<li>ショッピングカートに商品を入れた時点では、在庫は確保されません。</li>');
							print('<li>「購入て続くヘ進む」ボタンをクリックし、注文手続を完了してください。</li>');
							print('<li>注文時点で「売り切れ」となり購入できない場合もあります。ご了承ください。</li>');
							print('</ul>');
							
							$_SESSION['total_price']=$total_price;
							print('<div id="box2">');
							print('<p id="link">');
							print('<a href="index.php?username='.$username.'">買い物を続ける</a>');
							print('</p>');
							print('<div id="box3">');
							print('<table>');
							print('<tr>');
							print('<th>');
							print('商品代金(税込)');
							print('</th>');
							print('<td>');
							print('￥'.number_format($total_price));
							print('</td>');
							print('</tr>');
							print('<tr>');
							print('<th>');
							print('商品数量');
							print('</th>');
							print('<td>');
							print($total_amount);
							print('</td>');
							print('</tr>');
							print('<tr>');
							print('<th>');
							print('送料(税込)');
							print('</th>');
							print('<td>');
							print($delevery);
							print('</td>');
							print('</tr>');
							print('<tr>');
							print('<th>');
							print('合計金額(税込)');
							print('</th>');
							print('<td>');
							print('￥'.number_format($total_price+$delevery));
							print('</td>');
							print('</tr>');
							print('</table>');
							if($username!="ゲスト"){
								print('<a href="account.php">購入手続きへ進む</a>');
							}
							else {
								print('<a href="cartlogin.php">購入手続きへ進む</a>');
							}	
							print('</div>');
							print('</div>');
							print('</div>');	
					}
					else{
						print('<div id="box1">');
						print('<p id="text1">');
						print('カートの中身がありません。');
						print('</p>');
						print('<p>');
						print('<a href="index.php?username='.$username.'">TOPに戻る</a>');
						print('</p>');
						print('</div>');
					}	
							
					?>

			</div><!--id="container"終了-->

			<div id="footer">
				<div id="add">				
					<p id="copyright">Copyright&copy; Pengyang. All Rights Reserved.</p>
				</div>	
				<div id="page-top">
					<p><a id="move-page-top">▲</a></p>
				</div>
			</div><!--id="foot"終了-->
	</div><!--wrapper終了-->	
</body>
</html>