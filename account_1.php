<?php
session_start();
if(isset($_POST['username'])){
	$_SESSION['username'] = $_POST['username'];
	$userflag = 0;
	$_SESSION['userflag'] = $userflag;
}
else{
	$userflag = 1;
	$_SESSION['userflag'] = $userflag;
}

$username = 'ゲスト';
 if(!isset($_SESSION['username'])){
	print('セッションエラー');
	exit;
}
else{
	$username=$_SESSION['username'];
}
$userflag = $_SESSION['userflag'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HOME</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<link href="../css/account.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
</head>

<body>
	<div id="wrapper">
			<div id="header">
				<div id="nav">
					<h1 class="nav"><img src="../images/logo.gif" alt="lets dunk" ></h1>
				</div><!--id="nav"終了-->
				<div id="subnav">
					
				</div>
			</div><!--id="header"終了-->

		
		<div id="container">
			<p id="location">LET'S DUNK >　注文内容の確認 ></p>
			
			<div id="step">
				<div id="naka">
					<p class="text"><span>STEP1</span> ショッピングカート</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text"><span>STEP2</span> 注文情報の入力</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text1"><span>STEP3</span> 注文内容の確認</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text"><span>STEP4</span> 注文完了</p>
				</div>
			</div><!--id="step"終了-->
	
				<form action="account_2.php" method="POST">
					
				<?php
					print('<table id="tablex">');
					print('<tr>');
					print('<th>');
					print('お名前：');
					print('</th>');
					print('<td>');
					print($username);
					print('</td>');
					print('</tr>');
					if(isset($_POST['ado'])){
						if($_POST['ado']=='diff'){
							if(isset($_POST['post'])&&isset($_POST['add'])&&isset($_POST['tel'])&&isset($_POST['mail'])){
								$post=$_POST['post'];
								$add=$_POST['add'];
								$tel=$_POST['tel'];
								$mail=$_POST['mail'];
								print('<tr>');
								print('<th>');
								print('郵便番号:');
								print('</th>');
								print('<td>');
								print($post);
								print('</td>');
								print('</tr>');
								print('<tr>');
								print('<th>');
								print('ご住所:');
								print('</th>');
								print('<td>');
								print($add);
								print('</td>');
								print('</tr>');
								print('<tr>');
								print('<th>');
								print('電話番号:');
								print('</th>');
								print('<td>');
								print($tel);
								print('</td>');
								print('</tr>');
								print('<tr>');
								print('<th>');
								print('メールアドレス:');
								print('</th>');
								print('<td>');
								print($mail);
								print('</td>');
								print('</tr>');
								$_SESSION['post']=$post;
								$_SESSION['ado']=$add;
								$_SESSION['tel']=$tel;
								$_SESSION['mail']=$mail;
							}
							else{
								print('お届け先情報を入力してください');
							}
						}
						elseif($_POST['ado']=='same'){
							$dbcon=mysqli_connect('localhost','root','','presentation');
								if(!$dbcon){
									print('DB接続失敗');
									exit;
								}

								mysqli_set_charset($dbcon,'utf8');


								$sql = "SELECT";
								$sql .= " u_mail";
								$sql .= ",";
								$sql .= "u_post";
								$sql .= ",";
								$sql .= "u_ado";
								$sql .= ",";
								$sql .= "u_tel";
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


								print('<tr>');
								print('<th>');
								print('郵便番号');
								print('</th>');
								print('<td>');
								print($row['u_post']);
								print('</td>');
								print('</tr>');
								print('<tr>');
								print('<th>');
								print('ご住所');
								print('</th>');
								print('<td>');
								print($row['u_ado']);
								print('</td>');
								print('</tr>');
								print('<tr>');
								print('<th>');
								print('電話番号');
								print('</th>');
								print('<td>');
								print($row['u_tel']);
								print('</td>');
								print('</tr>');
								print('<tr>');
								print('<th>');
								print('メールアドレス');
								print('</th>');
								print('<td>');
								print($row['u_mail']);
								print('</td>');
								$_SESSION['post']=$row['u_post'];
								$_SESSION['ado']=$row['u_ado'];
								$_SESSION['tel']=$row['u_tel'];
								$_SESSION['mail']=$row['u_mail'];
							}										
						}									
					}
					else{
						print("お届け先を選択してください");
					}

					if(isset($_POST['number'])&&isset($_POST['year'])&&isset($_POST['month'])){
						$number=$_POST['number'];
						$year=$_POST['year'];
						$month=$_POST['month'];
						print('<tr>');
						print('<th>');
						print('カード番号:');
						print('</th>');
						print('<td>');
						print($number);
						print('</td>');
						print('</tr>');
						print('<tr>');
						print('<th>');
						print('有効期限:');
						print('</th>');
						print('<td>');
						print($year);						
						print('年');						
						print($month);
						print('月');
						print('</td>');
						print('</tr>');
						$_SESSION['cardnumber']=$number;
					}
				
					else{
						print('カード情報を入力してください');
					}

					if(isset($_POST['month1'])&&isset($_POST['day1'])){
						$month1=$_POST['month1'];
						$day1=$_POST['day1'];
						print('<tr>');
						print('<th>');
						print('お届け日:');
						print('</th>');
						print('<td>');
						print($month1);
						print('月');
						print($day1);
						print('日');
						print('</td>');
						print('</tr>');
						$_SESSION['d_date']=$month1.'月'.$day1.'日';
					}
					else{
						print("配送日を選択してください");
					}
					print('<tr>');
					print('<th>');
					print('総額');
					print('</th>');
					print('<td>');
					print($_SESSION['total_price'].'円');
					print('</td>');
					print('</tr>');
					print('</table>');
				?>
				<input type="submit" value="確定して送信">
			</form>

		</div>

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