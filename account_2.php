<?php
session_start();
date_default_timezone_set("Asia/Tokyo");
if(!isset($_SESSION['username'])){
	print('セッションエラー');
	exit;
}
else{
	$username=$_SESSION['username'];
}
$sessionid = SESSION_id();

$ado=$_SESSION['ado'];

$mail=$_SESSION['mail'];

$tel=$_SESSION['tel'];

$id=$_SESSION['id'];

$post=$_SESSION['post'];

$userflag = $_SESSION['userflag'];

$cardnumber=$_SESSION['cardnumber'];

$ddate=$_SESSION['d_date'];

$this_date=date('Y年m月d日');

$dbcon=mysqli_connect('localhost','root','','presentation');
 if(!$dbcon){
    print('DB接続失敗');
    exit;
 }

 mysqli_set_charset($dbcon,'utf8');

 $sql = "SELECT";
 $sql .= " *";
 $sql .= " FROM";
 $sql .= " o_cus";
 $sql .= ";";
 
 $insert=mysqli_query($dbcon,$sql);
 $count = 0;
 while($row=mysqli_fetch_assoc($insert)){
 	$count = $count+1;
 }
 $count1 = $count+1;
 $sql1 = 'INSERT INTO o_cus ( o_no, u_name, o_date, card_no, d_post, d_ado, d_tel, d_mail, d_date, o_price ) VALUES ( '.$count1.', "'.$username.'", "'.$this_date.'", "'.$cardnumber.'", "'.$post.'", "'.$ado.'", "'.$tel.'", "'.$mail.'","'.$ddate.'",'.$_SESSION['total_price'].')';

 $insert1 = mysqli_query($dbcon,$sql1);

 $sql2 = "SELECT";
 $sql2 .= " *";
 $sql2 .= " FROM";
 $sql2 .= " sell";
 $sql2 .= ";";
 
 foreach($_SESSION['cartx'] as $value1){
 	$count2=1;
	$id=$value1['g_id'];
	$size=$value1['g_size'];
	$amount=$value1['g_amount'];
	$price=$value1['g_price'];
	$url = $value1['g_url'];
	$name = $value1['g_name'];
	$ser = $value1['g_ser'];
 	$insert2=mysqli_query($dbcon,$sql2);
 	while($row1=mysqli_fetch_assoc($insert2)){
 		$count2=$count2+1;
 	}
	$sql4 = 'INSERT INTO sell(o_no, g_id, g_name, g_size, amount, price, u_name, userflag, g_url, o_date, g_ser) VALUES ('.$count2.',"'.$id.'","'.$name.'",'.$size.','.$amount.','.$price.',"'.$username.'",'.$userflag.',"'.$url.'","'.$this_date.'","'.$ser.'")';
	$insert4=mysqli_query($dbcon,$sql4);
 }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HOME</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/thankspage.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="nav">
				<?php
				if($userflag == 0){
					print('<h1><a href="index.php" class="nav0"><img src="../images/logo.gif" alt="lets dunk"></a></h1>');
				}
				else{
					print('<h1>');
					print('<a href="index.php?username='.$username.'">');
					print('<img src="../images/logo.gif" alt="lets dunk"></a></h1>');
				}
				?>
			</div>
			<div id="subnav">
			</div>
		</div>	

		<div id="container">
			<div id="location">
				<p>TOP > 注文完了</p>
			</div>
			<div id="step">					
				<div id="naka">
					<p class="text"><span>STEP1</span> ショッピングカート</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text"><span>STEP2</span> 注文情報の入力</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text"><span>STEP3</span> 注文内容の確認</p>
					<p class="arrow"><img src="../images/arrow.gif" alt="arrow" width="11" height="11"></p>
					<p class="text1"><span>STEP4</span> 注文完了</p>
				</div>
			</div>

			<div id="left">
				<h2>ありがとうございました。注文が確定されました。</h2>
				<div id="costumer">
					<p>お客様の注文番号は XXXXXXXXXXXXXXXXXXXXXXXXXXXです。</p>
					<p>商品を次の届け先へ発送します。</p>
					<?php
					print('<p>');
					print($_SESSION['ado']);
					print($_SESSION['post']);
					print('</p>');
					print('<p>');
					print('お届け予定日:');
					print($_SESSION['d_date']);
					print('</p>');
					unset($_SESSION['cartx']);
					?>
					
				</div>
				<div id="inquiry">
					<h3>お問い合わせ</h3>
					<p><a href="#">LET'S DUNK オンラインストアお客様窓口(営業時間 9:00～19:00)</a></p>
					<p>電話番号</p>
					<p>XX-XXXXX-XXXX</p>
				</div>
			</div>

			<div id="right">
				<h3>よくあるご質問</h3>
					<div id="box1">
						<h4>初めてのお客様</h4>
						<ul>	
							<li><a href="#">弊社ウェブサイトを利用する際の注意点について</a></li>
							<li><a href="#">ご利用規約</a></li>
							<li><a href="#">プライバシーポリシー</a></li>
						</ul>
					</div>
					<div id="box2">
						<h4>会員のお客様へ</h4>
						<ul>
							<li><a href="#">注文の確認について</a></li>
							<li><a href="#">注文内容の変更について</a></li>
							<li><a href="#">配送について</a></li>
							<li><a href="#">交換について</a></li>
							<li><a href="#">返品について</a></li>
							<li><a href="#">会員情報の確認・変更について</a></li>
						</ul>
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
	</div>

</body>
</html>

 


 
 






