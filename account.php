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
			print('<a href="cartlogin.php">戻る</a>');
		 	exit;
		}
	}


 if(!isset($_SESSION['username'])){
	print('セッションエラー');
	exit;
}
else{
	$username=$_SESSION['username'];
}
$a=$_SESSION['id'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HOME</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/account.css" rel="stylesheet" type="text/css">
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
							print('<a href="index.php?username='.$username.'">');
							print('<input type="hidden" name="username" value="'.$username.'">');
							print('<img src="../images/logo.gif" alt="lets dunk">');
							print('</a>');
							print('</h1>');					
						?>
					
				</div><!--id="nav"終了-->
				<div id="subnav">
					<?php
						print('<div id="session">');
						print('ようこそ'.$username.'さん');
						print('</div>');
					?>
				</div>
			</div><!--id="header"終了-->

		
		<div id="container">
			<div id="location">
				<p>TOP > 送り先情報入力</p> 
			</div><!--id="location" end-->
			<div id="step">
				<div id="naka">
					<p class="text"><span>STEP1</span> ショッピングカート</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text1"><span>STEP2</span> 注文情報の入力</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text"><span>STEP3</span> 注文内容の確認</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text"><span>STEP4</span> 注文完了</p>
				</div>
			</div><!--id="step"終了-->
			
				<div id="bigBox">
				<form action="account_1.php" method="post">				
						<?php				
							if($username == 'ゲスト'){
								print('<div id="text1">');
								print('<h2>');
								print('お名前');
								print('</h2>');
								print('<table id="table0">');
								print('<tr>');
								print('<th>');
								print('お名前');
								print('</th>');
								print('<td>');
								print('<input type="text" name="username">');
								print('</td>');
								print('</tr>');
								print('</table>');
								print('</div>');
							}
						?>
		
					<div id="text2">
						<?php
						if($username != 'ゲスト'){
							$sql = "SELECT";
							$sql .= " *";
							$sql .= " FROM";
							$sql .= " user";
							$sql .= " WHERE";
							$sql .= " u_name";
							$sql .= " =";
							$sql .= ' "';
							$sql .= "$username";
							$sql .= '"';
							$insert=mysqli_query($dbcon,$sql);
							$row=mysqli_fetch_assoc($insert);
							print('<h2>');
							print('お届け先');
							print('</h2>');
							print('<table id="table1">');
							print('<tr>');
							print('<th>');
							print('会員登録の住所');
							print('</th>');
							print('<td>');
							print('お名前:');
							print($row['u_name']);
							print('<br>');
							print('郵便番号:');
							print($row['u_post']);
							print('<br>');
							print('ご住所:');
							print($row['u_ado']);
							print('<br>');
							print('電話番号:'.$row['u_tel']);
							print('<br>');
							print('メールアドレス:'.$row['u_mail']);
							print('</td>');
							print('<th>');
							print('<input type="radio" name="ado" value="same">');
							print('この住所に送る');
							print('</th>');
							print('</tr>');
							print('</table>');
					    
						    print('<h2>');
						    print('未登録の新しい住所に送る');
						    print('</h2>');						    
						    print('<table id="table2">');
						    print('<tr>');
						    print('<th>');
						    print('郵便番号');
						    print('</th>');
						    print('<td>');
						    print('<input type="text" name="post">');
						    print('</td>');
						    print('<th rowspan = "4">');				   
						    print('<input type="radio" name="ado" value="diff">');
						    print('この住所に送る');
						    print('</th>');
						    print('</tr>');
						    print('<tr>');
						    print('<th>');
						    print('ご住所');
						    print('</th>');
						    print('<td>');
						    print('<input type="text" name="add">');
						    print('</td>');
						    print('</tr>');
						    print('<tr>');
						    print('<th>');
						    print('電話番号');
						    print('</th>');
						    print('<td>');
						    print('<input type="text" name="tel">');
						    print('</td>');
						    print('</tr>');
						    print('<tr>');
						    print('<th>');
						    print('メールアドレス');
						    print('</th>');
						    print('<td>');
						    print('<input type="text" name="mail">');
						    print('</td>');							    
						    print('</tr>');
						    print('</table>');
						    
						}
						else{
							print('<input type="hidden" name="ado" value="diff">');
							print('<h2>');
							print('お届け先情報');
							print('</h2>');
							print('<table id="table3">');
							print('<tr>');
							print('<th>');
							print('郵便番号');
							print('</th>');
							print('<td>');
							print('<input type="text" name="post">');
							print('</td>');
							print('</tr>');
							print('<tr>');
							print('<th>');
							print('住所');
							print('</th>');
							print('<td>');
							print('<input type="text" name="add">');
							print('</td>');
							print('</tr>');
							print('<tr>');
							print('<th>');
							print('電話番号');
							print('</th>');
							print('<td>');
							print('<input type="text" name="tel">');
							print('</td>');
							print('</tr>');
							print('<tr>');
							print('<th>');
							print('メールアドレス');
							print('</th>');
							print('<td>');
							print('<input type="text" name="mail">');
							print('</td>');
							print('</tr>');
							print('</table>');
						}
						?>
						
					</div>

				<div id="text3">
					<h2>カード情報</h2>
					<table id="table4">
						<tr>
							<th>カード番号</th>
							<td><input type="text" name="number"></td>
						</tr>
							
						<tr>
							<th>有効期限</th>
							<td>
								<select name="year">
									<?php
									$this_year = date("Y");
									$end_year = $this_year+20;
									for($i= $this_year; $i<=$end_year; $i++){
										print("<option>$i</option>");
									}							
									?>
								</select>年
						
								<select name="month">
									<?php								
									for($j = 1; $j<=12; $j++){
										print("<option>$j</option>");
									}								
									?>
								</select>月
							</td>
						</tr>
					</table>
				</div><!--id="text3"完了-->
							
				<div id="text4">					
					<h2>配送日を指定する</h2>
						<?php
						$this_month = date("n");
						$today = date("j");	
						?>
					
					<table id="table5">
						<tr>
							<th>配送日</th>
							<td>
								<select name="month1">
									<?php
									for($month=1;$month<13;$month++){
										if($month == $this_month){
											print('<option selected>'.$this_month.'</option>');
										}
										else{
											print('<option>'.$month.'</option>');
										}
									}

									?>
								</select>
								月

								<select name="day1">
									<?php
									for($day=1;$day<32;$day++){
										if($day == $today){
											print('<option selected>'.$day.'</option>');
										}
										else{
											print('<option>'.$day.'</option>');
										}
									}
									?>
								</select>
								日
							</td>
						</tr>
					</table>
				</div>
				<input type="submit" value="送信">
			</form>
		</div><!--id="bigBox" end-->
		</div><!--id="container"終了-->
		
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