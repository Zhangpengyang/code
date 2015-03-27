<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新規会員登録</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/entry.css" rel="stylesheet" type="text/css">
<link href="css/totop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/check.js"></script>
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/totop.js"></script>
</head>

<body>
		<div id="wrapper">
			<div id="header">
				<div id="nav">
					<h1><a href="php/index.php" class="nav"><img src="images/logo.gif" alt="lets dunk"></a></h1>
				</div>
			</div><!--id="header"終了-->
			
			
			
			<div id="container">
				<div id="location">
					<p>LET' DUNK > <a href="#">新規会員登録</a></p>
				</div>
				<div id="form">
					<p id="text">新規会員登録</p>
					<form id="form1" name="form1" action = "kakunin.php" method="POST" onSubmit="return check()">
				
					<div id="content">
						<div id="left">
							<div id="name">
								<p>名前(姓)<span>*</span></p>
								<p><input type = "text" size = "30" id="givenname" name = "givenname"/></p>
								<p>名前(名)<span>*</span></p>
								<p><input type = "text" name = "firstname"/></p>
							</div>
						
							<div id="namekana">
								<p>フリガナ(姓)<span>*</span></p>
								<p><input type = "text" name = "givennamekana"/></p>	
								<p>フリガナ(名)<span>*</span></p>
								<p><input type = "text" name = "firstnamekana"/></p>
							</div>
					
							<div id="mail">
								<p>メールアドレス<span>*</span></p>
								<p><input type = "text" name = "mail"/></p>
							</div>
							
							<div id="username">
								<p>ユーザーネーム<span>*</span></p>
								<p><input type = "text" name = "username"/></p>
							</div>
						
							<div id="pass">
								<p>パスワード<span>*</span></p>
								<p class="demo"><input type = "password" name = "pass"/></p>
								<p>パスワードの確認<span>*</span></p>
								<p class="demo"><input type = "password" name = "pass1"/></p>
							</div>
						
							<div id="sexual">
								<p>性別<span>*</span></p>
								<p><input type = "radio" name = "sexual" value = "1"/>男
								<input type = "radio" name = "sexual" value = "0"/>女
								</p>
							</div><!--id="sexual"完了-->
							<p><span>*</span>必須フィールド</p>	
						</div><!--id="left"完了-->
					
						<div id="right">	
							<div id="birthday">
								<p>生年月日<span>*</span></p>
									<p><select name="year">
									<option value="">--</option>
									<?php
									$this_year = date("Y");
									$year = $this_year;
									$end_year = $year-50;
									for($y = $year;$y>=$end_year;$y--){
										print('<option value="'.$y.'">'.$y.'</option>');
									}
									
									?>
									</select>
									年
									<select name="month">
									<option value="">--</option>
									<?php
									for($month = 1;$month <=12;$month++){
										print('<option value="'.$month.'">'.$month.'</option>');
									}
									
									?>
									</select>
									月
									<select name="day">
									<option value="">--</option>
									<?php
									for($day = 1; $day<=31;$day++){
										print('<option value="'.$day.'">'.$day.'</option>');
									}
									?>
									</select>
   									日 
								</p>
							</div>
						
							<div id="post">
								<p>郵便番号<span>*</span></p>
								<p><input type = "text" name = "post" value=""/></p>
							</div>
							
							<div id="address">
								<p>ご住所(マンション名までご記入ください)<span>*</span></p>
								<p><input type = "text" name = "address" value=""/></p>
							</div>
							
							<div id="tel">
								<p>電話番号<span>*</span></p>
								<p><input type = "text" name = "tel" value=""/></p>
							</div>
							
							<div id="position">
								<p>チームにおけるポジション<span>*</span></p>
								<p>
								<select name="position">
									<option value="">--</option>
									<option value="c">センター/C</option>
									<option value="pf">パワーフォーワード/PF</option>
									<option value="sf">スモールフォーワード/SF</option>
									<option value="sg">シューティングガード/SG</option>
									<option value="pg">ポイントガード/PG</option>									
								</select>
								</p>

							</div>
						</div><!--id="right"完了--> 
					</div><!--id="content"完了-->
							
							<p id="button"><input type="image" src="images/sent.jpg" name="sent"></p> 
							
							
						
						</form><!--id="info"完了-->
					</div><!--id="form"終了-->
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