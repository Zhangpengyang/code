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

if(isset($_GET['pager'])){
	$_SESSION['pager'] = $_GET['pager'];
}
else{
	$_SESSION['pager']=1;
}
$pager = ($_SESSION['pager']-1)*20;

if(isset($_GET['sex'])){
	$_SESSION['sex']=$_GET['sex'];
}

if(isset($_SESSION['sex'])){
    $sex=$_SESSION['sex'];
}

if(isset($_GET['maker'])){
	$_SESSION['maker'] = $_GET['maker'];
}
if(isset($_GET['price'])){
	$_SESSION['price'] = $_GET['price'];
}

if(isset($_GET['position'])){
	$_SESSION['position'] = $_GET['position'];
}

if(isset($_GET['series'])){
	if($_GET['series'] == 'LEBRON'){
		$_SESSION['series']='LEBRON JAMES';
 	}
 	if($_GET['series'] == 'KEVIN'){
 		$_SESSION['series']='KEVIN DURANT';
 	}
 	else{
	$_SESSION['series'] = $_GET['series'];
	
	}
}

if(isset($_GET['color'])){
	$_SESSION['color'] = $_GET['color'];
}

if(isset($_GET['search'])){
	if(strlen($_GET['search'])>0){
		$_SESSION['keyword'] = $_GET['search'];		
	}
}

if(isset($_GET['delete'])){
	if($_GET['delete']=='m'){
		unset($_SESSION['maker']);
	}
	if($_GET['delete']=='s'){
		unset($_SESSION['series']);
	}
	if($_GET['delete']=='p'){
		unset($_SESSION['position']);
	}
	if($_GET['delete']=='pr'){
		unset($_SESSION['price']);
	}
	if($_GET['delete']=='c'){
		unset($_SESSION['color']);
	}
	if($_GET['delete']=='sx'){
		unset($_SESSION['sex']);
	}
	if($_GET['delete'] == 'k'){
		unset($_SESSION['keyword']);
	}
	if($_GET['delete'] == 'u'){
		unset($_SESSION['username']);
		$_SESSION['username'] = 'ゲスト';
		$username = $_SESSION['username'];
	}
	if($_GET['delete'] == 'all'){
		unset($_SESSION['keyword']);
		unset($_SESSION['sex']);
		unset($_SESSION['color']);
		unset($_SESSION['price']);
		unset($_SESSION['position']);
		unset($_SESSION['series']);
		unset($_SESSION['maker']);
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商品一覧</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/brand.css" rel="stylesheet" type="text/css">
<link href="../css/totop.css" rel="stylesheet" type="text/css">
<link href="../css/aaa.css" rel="stylesheet" type="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../js/totop.js"></script>
<script type="text/javascript" src="../js/overmenu.js"></script> 
<script type="text/javascript" src="../js/aaa.js"></script> 
<script type="text/javascript"><!--
	function change(){
	  mySelect = document.form1.select1.selectedIndex;
	  location.href = document.form1.select1.options[mySelect].value;
	}
// -->
</script>
<script type="text/javascript" src="../js/pagetop.js"></script>
</head>
<?php
$sql = "SELECT";
$sql .= " *";
$sql .= " FROM";
$sql .= " goods";
$sql .= " ,";
$sql .= " maker_makername";
$sql .= " ,";
$sql .= " color_shoku";
$sql .= " ,";
$sql .= " position";
$sql .= " WHERE";
$sql .= " goods.g_maker";
$sql .= " =";
$sql .= "  maker_makername.g_maker";
$sql .= " AND";
$sql .= " goods.g_color";
$sql .= " =";
$sql .= " color_shoku.g_color";
$sql .= " AND";
$sql .= " goods.g_position";
$sql .= " =";
$sql .= "  position.g_position";
$sql .= " AND";
$sql .= " 1=1";

if(isset($_SESSION['sex'])){
	$sql .= " AND";
	$sql .= " goods.g_kubun";
	$sql .= " =";
	$sql .= ' "' ;
	$sql .= "$sex";
	$sql .= '"' ;

}
if(isset($_SESSION['price'])){
	$price = $_SESSION['price'];
		if($price == 40001){
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " >";
			$sql .= " $price";
		}

		if($price == 10000){
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " <";
			$sql .= " $price+1";
		}

		if($price == 20000){
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " >=";
			$sql .= " 10001";
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " <";
			$sql .= " 20001";
		}

		if($price == 30000){
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " >=";
			$sql .= " 20001";
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " <";
			$sql .= " 30001";
		}

		if($price == 40000){
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " >=";
			$sql .= " 30001";
			$sql .= " AND";
			$sql .= " goods.g_price";
			$sql .= "*";
			$sql .= "s_price";
			$sql .= " <";
			$sql .= " 40001";
		}
	}


	if(isset($_SESSION['position'])){
		$position = $_SESSION['position'];
		$sql .= " AND";
		$sql .= " (";
		$sql .= " goods.g_position";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$position";
		$sql .= '"' ;
		$sql .= " OR";
		$sql .= " goods.g_position2";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$position";
		$sql .= '"' ;
		$sql .= " OR";
		$sql .= " goods.g_position3";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$position";
		$sql .= '"' ;
		$sql .= " OR";
		$sql .= " goods.g_position4";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$position";
		$sql .= '"' ;
		$sql .= " OR";
		$sql .= " goods.g_position5";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$position";
		$sql .= '"' ;
		$sql .= ")";
	}

	if(isset($_SESSION['maker'])){
		$maker = $_SESSION['maker'];
		$sql .= " AND";
		$sql .= " goods.g_maker";
		$sql .= " =";
		$sql .= "$maker";
	}


	if(isset($_SESSION['series'])){
		$series=$_SESSION['series'];
		$sql .= " AND";
		$sql .= " goods.g_series";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$series";
		$sql .= '"' ;
	}

	if(isset($_SESSION['color'])){
		$color = $_SESSION['color'];
		$sql .= " AND";
		$sql .= " goods.g_color";
		$sql .= " =";
		$sql .= ' "' ;
		$sql .= "$color";
		$sql .= '"' ;
	}

	if(isset($_SESSION['keyword'])){
		$keyword = $_SESSION['keyword'];
		if(strlen($keyword)>0){					
			$rightword = str_replace("　"," ",$keyword);
			$array = explode(" ",$rightword);
			$sql .= " AND";
			for($word=0;$word<count($array);$word++){
				$sql .= " (";
				$sql .= " makername";	
				$sql .= " LIKE";
				$sql .= ' "';
				$sql .= "%";
				$sql .= $array[$word];
				$sql .= "%";
				$sql .= '"';
				$sql .= " OR";
				$sql .= " g_name";	
				$sql .= " LIKE";
				$sql .= ' "';
				$sql .= "%";
				$sql .= $array[$word];
				$sql .= "%";
				$sql .= '"';
				$sql .= " OR";
				$sql .= " color";
				$sql .= " LIKE";
				$sql .= ' "';
				$sql .= "%";
				$sql .= $array[$word];
				$sql .= "%";
				$sql .= '"';
				$sql .= " OR";
				$sql .= " position";	
				$sql .= " LIKE";
				$sql .= ' "';
				$sql .= "%";
				$sql .= $array[$word];
				$sql .= "%";
				$sql .= '"';
				$sql .= " OR";
				$sql .= " g_series";	
				$sql .= " LIKE";
				$sql .= ' "';
				$sql .= "%";
				$sql .= $array[$word];
				$sql .= "%";
				$sql .= '"';
				$sql .= " OR";
				$sql .= " g_price";	
				$sql .= " *";
				$sql .= " s_price";
				$sql .= " LIKE";
				$sql .= ' "';
				$sql .= "%";
				$sql .= $array[$word];
				$sql .= "%";
				$sql .= '"';
				$sql .= " )";
				if($word<count($array)-1){
					$sql .= " AND";
				}
			}
		}

	}
	$sql .= ";";
		$insert=mysqli_query($dbcon,$sql);
		$count = 0;
		while($row=mysqli_fetch_assoc($insert)){
			$count = $count+1;	
		}

?>

<body>
	<div id="wrapper">
				<div id="header">
				<div id="nav">

					<?php print('<h1>');
						  print('<a href="index.php?username='.$username.'" class="nav">');
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
				</div>
			</div><!--id="header"終了-->

			<div id="container">
				<div id="location">
				<?php
					print('<p id="back">');
					print('<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る |　</a>');
					print('</p>');
					print('<p id="ttop">');
					print('<a href="index.php?username='.$username.'">');
					print('<input type="hidden" name="username" value="'.$username.'">');
					print('TOP');
					print('</a>');
					print('</p>');

					
					print('>');
					print('対象商品');
					print('(　');
					if(isset($_SESSION['maker'])){
						print('ブランド:');
						if($_SESSION['maker']==1){
							print('NIKE');
						}
						if($_SESSION['maker']==2){
							print('ADIDAS');
						}
						if($_SESSION['maker']==3){
							print('AIR JORDAN');
						}
						print('　');
					}
					if(isset($_SESSION['series'])){
						print('シリーズ:');
						print($_SESSION['series'].'　');
					}
					if(isset($_SESSION['position'])){
						print('ポジション:');
						if($_SESSION['position']== 'c'){
							print('センター');
						}
						if($_SESSION['position']== 'pf'){
							print('パワーフォーワード');
						}
						if($_SESSION['position']== 'sf'){
							print('スモールフォーワード');
						}
						if($_SESSION['position']== 'pg'){
							print('ポイントガード');
						}
						if($_SESSION['position']== 'sg'){
							print('シューティングガード');
						}
						print('　');
					}
					if(isset($_SESSION['price'])){
						print('価格帯:');	
						if($_SESSION['price']==10000){
							print('～￥10,000');
						}	
						if($_SESSION['price']==20000){
							print('￥10,001～￥20,000');
						}		
						if($_SESSION['price']==30000){
							print('￥20,001～￥30,000');
						}		
						if($_SESSION['price']==40000){
							print('￥30,001～￥40,000');
						}		
						if($_SESSION['price']==40001){
							print('￥40,000～');
						}	
						print('　');				
					}
					if(isset($_SESSION['color'])){
						print('カラー:');
						if($_SESSION['color'] == 1){
							print('赤');
						}
						if($_SESSION['color'] == 2){
							print('黒');
						}
						if($_SESSION['color'] == 3){
							print('青');
						}
						if($_SESSION['color'] == 4){
							print('グレー');
						}
						if($_SESSION['color'] == 5){
							print('紫');
						}
						if($_SESSION['color'] == 6){
							print('黄');
						}
						if($_SESSION['color'] == 7){
							print('白');
						}
						if($_SESSION['color'] == 8){
							print('グリーン');
						}
						if($_SESSION['color'] == 9){
							print('ピンク');
						}
						if($_SESSION['color'] == 0){
							print('その他');
						}
						print('　');
					}
					if(isset($_SESSION['sex'])){
						print('性別:');
						if($_SESSION['sex'] == 1){
							print('メンズ');
						}
						else if($_SESSION['sex'] == 0) {
							print('ウィメンズ');
							
						}
						else if($_SESSION['sex'] == 2) {
							print('キッズ');
						}
						print('　');
					}
					print(')');		
				?>
				</div>

				<div id="items">
					<?php
						print('<p>');
						print('対象商品');
						print('(');
						print($count.'アイテム');	
						print(')');
						print('</p>');	
					?>
				</div>

				<div id="box">
					<div id="left">
						
						<div id="jyouken">
							<div id="jyoukencontent">
								<p>検索条件</p>
							</div>
							<?php 
							print('<div id="jyoukenbox">');
							if(isset($_SESSION['keyword'])){
								$keyword = $_SESSION['keyword'];
								if(strlen($keyword)>0){
									print('<div class="jyouken">');
									print('<a href="step1.php?delete=k&amp;username='.$username.'">');
									print('<input type="hidden" name="delete" value="k">');
									print('<img src="../images/arrow5.png" alt="Ｘ">');
									print(' ');
									print('キーワード:');
									print($keyword);
									print('</a>');	
									print('</div>');						
								}
							}
							if(isset($_SESSION['sex'])){
								print('<div class="jyouken">');
								print('<a href="step1.php?delete=sx&amp;username='.$username.'">');
								print('<input type="hidden" name="delete" value="sx">');
								print('<img src="../images/arrow5.png" alt="Ｘ">');
								print(' ');
								if($_SESSION['sex']==0){
									print('性別:');
									print('ウィメンズ');
								}
								if($_SESSION['sex']==1){
									print('性別:');
									print('メンズ');
								}
								if($_SESSION['sex']==2){
									print('性別:');
									print('キッズ');
								}
								print('</a>');
								print('</div>');
								
							}

							if(isset($_SESSION['maker'])){
								$sql9 = "SELECT";
								$sql9 .= " *";
								$sql9 .= " FROM";
								$sql9 .= " maker_makername";
								$sql9 .= " WHERE";
								$sql9 .= " g_maker";
								$sql9 .= " =";
								$sql9 .= "$maker";
								$insert9=mysqli_query($dbcon,$sql9);
								$row9=mysqli_fetch_assoc($insert9);
								print('<div class="jyouken">');
								print('<a href="step1.php?delete=m&amp;username='.$username.'">');
								print('<input type="hidden" name="delete" value="m">');
								print('<img src="../images/arrow5.png" alt="Ｘ">');
								print(' ');
								print('ブランド:');
								print($row9['makername']);
								print('</a>');
								print('</div>');
							}
							if(isset($_SESSION['series'])){
								print('<div class="jyouken">');
								print('<a href="step1.php?delete=s&amp;username='.$username.'">');
								print('<input type="hidden" name="delete" value="s">');
								print('<img src="../images/arrow5.png" alt="Ｘ">');
								print(' ');
								print('シリーズ:');
								print($_SESSION['series']);
								print('</a>');
								print('</div>');
							}
							if(isset($_SESSION['position'])){
								print('<div class="jyouken">');
								print('<a href="step1.php?delete=p&amp;username='.$username.'">');
								print('<input type="hidden" name="delete" value="p">');
								print('<img src="../images/arrow5.png" alt="Ｘ">');
								print(' ');
								print('ポジション:');
								print($_SESSION['position']);
								print('</a>');
								print('</div>');
							}
							if(isset($_SESSION['price'])){
								print('<div class="jyouken">');
								print('<a href="step1.php?delete=pr&amp;username='.$username.'">');
								print('<input type="hidden" name="delete" value="pr">');
								print('<img src="../images/arrow5.png" alt="Ｘ">');
								print(' ');
								print('価格帯:');
								if($_SESSION['price']==10000){
									print('～￥10,000');
								}	
								if($_SESSION['price']==20000){
									print('￥10,001～￥20,000');
								}		
								if($_SESSION['price']==30000){
									print('￥20,001～￥30,000');
								}		
								if($_SESSION['price']==40000){
									print('￥30,001～￥40,000');
								}		
								if($_SESSION['price']==40001){
									print('￥40,000～');
								}	
								print('</a>');
								print('</div>');
							}
							if(isset($_SESSION['color'])){
								$color1 = $_SESSION['color'];
								$sql8 = "SELECT";
								$sql8 .= " *";
								$sql8 .= " FROM";
								$sql8 .= " color_shoku";
								$sql8 .= " WHERE";
								$sql8 .= " g_color";
								$sql8 .= " =";
								$sql8 .= " $color1";
								$sql8 .= ";";
								$insert8=mysqli_query($dbcon,$sql8);
								$row8=mysqli_fetch_assoc($insert8);

								print('<div class="jyouken">');
								print('<a href="step1.php?delete=c&amp;username='.$username.'">');
								print('<input type="hidden" name="delete" value="c">');
								print('<img src="../images/arrow5.png" alt="Ｘ">');
								print(' ');
								print('カラー:');
								print($row8['color']);
								print('</a>');
								print('</div>');
							}						
							print('</div>');

							print('<p id="jyoukendelete">');
							print('<a href="step1.php?delete=all&amp;username='.$username.'">');
							print('条件を取り消す');
							print('</a>');
							print('</p>');	
							
							?>
						</div>
								
						<?php
							print('<div id="brand">');
							print('<h2>ブランド一覧</h2>');
							print('<ul class="menu">');
							$sql2 = "SELECT";
							$sql2 .= " *";
							$sql2 .= " FROM";
							$sql2 .= " maker_makername";
							$sql2 .= ";";
							$insert2=mysqli_query($dbcon,$sql2);
							$count9=1;
							while($row2=mysqli_fetch_assoc($insert2)){
								print('<li>');
								print('<a href="step1.php?maker='.$row2['g_maker'].'">');
								print('<input type="hidden" name="maker" value="'.$row2['g_maker'].'">');
								$maker1=$row2['g_maker'];
								print($row2['makername']);
								print('</a>');
								

								$sql1 = "SELECT";//メーカーの中のシリーズを出力する
								$sql1 .= " *";
								$sql1 .= " FROM";
								$sql1 .= " maker_series";
								$sql1 .= " WHERE";
								$sql1 .= " g_maker";
								$sql1 .= " =";
								$sql1 .= "$maker1";											
								$sql1 .= ";";
								$insert1=mysqli_query($dbcon,$sql1);
								print('<ul class="sub">');

								while($row1=mysqli_fetch_assoc($insert1)){
									print('<li>');
									print('<a href="step1.php?maker='.$maker1.'&amp;series='.$row1['g_series'].'">');
									print('<input type="hidden" name="series" value="'.$row1['g_series'].'">');
									print($row1['g_series']);
									print('</a>');
									print('</li>');
								}
								print('</ul>');						
								print('</li>');
								
							}
							print('</ul>');
							print('</div>');//id="brand"終了	


							print('<div id="position">');
							print('<h2>ポジションンから探す</h2>');
							print('<ul class="position">');
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
							print('</ul>');
						print('</div>');

						print('<div id="price">');
						print('<h2>値段から探す</h2>');
						print('<ul class="price">');
							print('<li><a href="step1.php?price=10000"><input type="hidden" name="price" value="10000">～¥10,000</a></li>');
							print('<li><a href="step1.php?price=20000"><input type="hidden" name="price" value="20000">¥10,001～¥20,000</a></li>');
							print('<li><a href="step1.php?price=30000"><input type="hidden" name="price" value="30000">¥20,001～¥30,000</a></li>');
							print('<li><a href="step1.php?price=40000"><input type="hidden" name="price" value="40000">¥30,001～¥40,000</a></li>');
							print('<li><a href="step1.php?price=40001"><input type="hidden" name="price" value="40001">¥40,001～</a></li>');
						print('</ul>');
						print('</div>');
							
							print('<div id="color">');
								print('<h2>メインカラーから探す</h2>');	
								print('<ul class="color">');
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
								print('</ul>');
							print('</div>');
						?>
						
					</div><!--id="left"終了-->
		
			<div id="right">
				<div id="form">
					<p>並び替え</p>
					<form name="form1" action="step1.php" method = "get">
						<?php
						if(isset($_GET['key'])){
							if($_GET['key']=='new'){
								print('<select name="select1" onchange="change()">');																
								print('<option value="step1.php?key=new">新着順</option>');
								print('<option value="step1.php?key=old">古い順</option>');
								print('<option value="step1.php?key=rich">金額の高い順</option>');
								print('<option value="step1.php?key=cheap">金額の低い順</option>');
								print('</select>');
							}
							if($_GET['key']=='old'){
								print('<select name="select1" onchange="change()">');								
								print('<option value="step1.php?key=old">古い順</option>');
								print('<option value="step1.php?key=new">新着順</option>');
								print('<option value="step1.php?key=rich">金額の高い順</option>');
								print('<option value="step1.php?key=cheap">金額の低い順</option>');
								print('</select>');
							}
							if($_GET['key']=='rich'){
								print('<select name="select1" onchange="change()">');
								print('<option value="step1.php?key=rich">金額の高い順</option>');
								print('<option value="step1.php?key=cheap">金額の低い順</option>');
								print('<option value="step1.php?key=new">古い順</option>');
								print('<option value="step1.php?key=old">新着順</option>');																
								print('</select>');
							}
							if($_GET['key']=='cheap'){
								print('<select name="select1" onchange="change()">');
								print('<option value="step1.php?key=cheap">金額の低い順</option>');
								print('<option value="step1.php?key=rich">金額の高い順</option>');
								print('<option value="step1.php?key=old">新着順</option>');
								print('<option value="step1.php?key=new">古い順</option>');															
								print('</select>');
							}
						}
						else{
							print('<select name="select1" onchange="change()">');
							print('<option value="step1.php?key=new">新着順</option>');
							print('<option value="step1.php?key=old">古い順</option>');
							print('<option value="step1.php?key=rich">金額の高い順</option>');
							print('<option value="step1.php?key=cheap">金額の低い順</option>');
							print('</select>');
						}
						?>
					</form>
				</div>


				<?php
												
						$sqlpage = "SELECT";
						$sqlpage .= " *";
						$sqlpage .= " ,";
						$sqlpage .= " g_price";
						$sqlpage .= " *";
						$sqlpage .= " s_price";
						$sqlpage .= " as";
						$sqlpage .= " '";
						$sqlpage .= "price";
						$sqlpage .= "'";
						$sqlpage .= " FROM";
						$sqlpage .= " goods";
						$sqlpage .= " ,";
						$sqlpage .= " maker_makername";
						$sqlpage .= " ,";
						$sqlpage .= " color_shoku";
						$sqlpage .= " ,";
						$sqlpage .= " position";
						$sqlpage .= " WHERE";
						$sqlpage .= " goods.g_maker";
						$sqlpage .= " =";
						$sqlpage .= "  maker_makername.g_maker";
						$sqlpage .= " AND";
						$sqlpage .= " goods.g_color";
						$sqlpage .= " =";
						$sqlpage .= " color_shoku.g_color";
						$sqlpage .= " AND";
						$sqlpage .= " goods.g_position";
						$sqlpage .= " =";
						$sqlpage .= "  position.g_position";
						$sqlpage .= " AND";
						$sqlpage .= " 1=1";

						if(isset($_SESSION['sex'])){
							$sqlpage .= " AND";
							$sqlpage .= " goods.g_kubun";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$sex";
							$sqlpage .= '"' ;

						}
						if(isset($_SESSION['price'])){
							$price = $_SESSION['price'];
								if($price == 40001){
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " >";
									$sqlpage .= " $price";
								}

								if($price == 10000){
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " <";
									$sqlpage .= " 10001";
								}

								if($price == 20000){
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " >=";
									$sqlpage .= " 10001";
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " <";
									$sqlpage .= " 20001";
								}

								if($price == 30000){
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " >=";
									$sqlpage .= " 20001";
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " <";
									$sqlpage .= " 30001";
								}

								if($price == 40000){
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " >=";
									$sqlpage .= " 30001";
									$sqlpage .= " AND";
									$sqlpage .= " goods.g_price";
									$sqlpage .= "*";
									$sqlpage .= "s_price";
									$sqlpage .= " <";
									$sqlpage .= " 40001";
								}
							}


						if(isset($_SESSION['position'])){
							$position = $_SESSION['position'];
							$sqlpage .= " AND";
							$sqlpage .= " (";
							$sqlpage .= " goods.g_position";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$position";
							$sqlpage .= '"' ;
							$sqlpage .= " OR";
							$sqlpage .= " goods.g_position2";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$position";
							$sqlpage .= '"' ;
							$sqlpage .= " OR";
							$sqlpage .= " goods.g_position3";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$position";
							$sqlpage .= '"' ;
							$sqlpage .= " OR";
							$sqlpage .= " goods.g_position4";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$position";
							$sqlpage .= '"' ;
							$sqlpage .= " OR";
							$sqlpage .= " goods.g_position5";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$position";
							$sqlpage .= '"' ;
							$sqlpage .= ")";
						}

						if(isset($_SESSION['maker'])){
							$maker = $_SESSION['maker'];
							print('<br>');
							$sqlpage .= " AND";
							$sqlpage .= " goods.g_maker";
							$sqlpage .= " =";
							$sqlpage .= "$maker";
						}

						if(isset($_SESSION['series'])){
							$series=$_SESSION['series'];
							$sqlpage .= " AND";
							$sqlpage .= " goods.g_series";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$series";
							$sqlpage .= '"' ;
						}

						if(isset($_SESSION['color'])){
							$color = $_SESSION['color'];
							$sqlpage .= " AND";
							$sqlpage .= " goods.g_color";
							$sqlpage .= " =";
							$sqlpage .= ' "' ;
							$sqlpage .= "$color";
							$sqlpage .= '"' ;
						}

						if(isset($_SESSION['keyword'])){
							$keyword = $_SESSION['keyword'];
							if(strlen($keyword)>0){
								//$notword = $array0(",",".",".","、","　");
								$rightword = str_replace("　"," ",$keyword);
								$array = explode(" ",$rightword);
								$sqlpage .= " AND";
								for($word=0;$word<count($array);$word++){
									$sqlpage .= " (";
									$sqlpage .= " makername";	
									$sqlpage .= " LIKE";
									$sqlpage .= ' "';
									$sqlpage .= "%";
									$sqlpage .= $array[$word];
									$sqlpage .= "%";
									$sqlpage .= '"';
									$sqlpage .= " OR";
									$sqlpage .= " g_name";	
									$sqlpage .= " LIKE";
									$sqlpage .= ' "';
									$sqlpage .= "%";
									$sqlpage .= $array[$word];
									$sqlpage .= "%";
									$sqlpage .= '"';
									$sqlpage .= " OR";
									$sqlpage .= " color";
									$sqlpage .= " LIKE";
									$sqlpage .= ' "';
									$sqlpage .= "%";
									$sqlpage .= $array[$word];
									$sqlpage .= "%";
									$sqlpage .= '"';
									$sqlpage .= " OR";
									$sqlpage .= " position";	
									$sqlpage .= " LIKE";
									$sqlpage .= ' "';
									$sqlpage .= "%";
									$sqlpage .= $array[$word];
									$sqlpage .= "%";
									$sqlpage .= '"';
									$sqlpage .= " OR";
									$sqlpage .= " g_series";	
									$sqlpage .= " LIKE";
									$sqlpage .= ' "';
									$sqlpage .= "%";
									$sqlpage .= $array[$word];
									$sqlpage .= "%";
									$sqlpage .= '"';
									$sqlpage .= " OR";
									$sqlpage .= " g_price";	
									$sqlpage .= " *";
									$sqlpage .= " s_price";
									$sqlpage .= " LIKE";
									$sqlpage .= ' "';
									$sqlpage .= "%";
									$sqlpage .= $array[$word];
									$sqlpage .= "%";
									$sqlpage .= '"';
									$sqlpage .= " )";
									if($word<count($array)-1){
										$sqlpage .= " AND";
									}
								}
							}
						}
							if(isset($_GET['key'])){
								if($_GET['key']=='new'){
									$sqlpage .= " ORDER BY";
									$sqlpage .= " u_date";
									$sqlpage .= " DESC";
								}
								if($_GET['key']=='old'){
									$sqlpage .= " ORDER BY";
									$sqlpage .= " u_date";
								}
								if($_GET['key']=='rich'){
									$sqlpage .= " ORDER BY";
									$sqlpage .= " price";
									$sqlpage .= " DESC";
								}
								if($_GET['key']=='cheap'){
									$sqlpage .= " ORDER BY";
									$sqlpage .= " price";
								}
							}
							else {
								$sqlpage .= " ORDER BY";
								$sqlpage .= " u_date";
								$sqlpage .= " DESC";
							}

						    $sqlpage .= " LIMIT 20 ";

						if(isset($_SESSION['pager'])){
							$sqlpage .= " offset ";
							$sqlpage .= $pager;							
						}
							$sqlpage .= ";";
						$insert_pager=mysqli_query($dbcon,$sqlpage);
						$count7 = 0;
						while($row_pager=mysqli_fetch_assoc($insert_pager)){
							$goods_price = $row_pager['g_price']*$row_pager['s_price'];
							print('<div class="content">');
							print('<form action = "goods.php" method="get">');
							print('<div class="pic">');
							print('<p>');
							print('<a href="goods.php?id='.$row_pager['g_id'].'">');
							print('<input type = "hidden" name = "id" value = "'.$row_pager['g_id'].'">');	
							print('<img src="');
							print($row_pager['g_url']);
							print('" alt="'.$row_pager['g_name'].'" width="160" height="120">');
							print('</a>');
							print('</p>');
							print('<p>');
							if($row_pager['g_maker']==1){
								print('<img src="../images/nike.gif" alt="nike" width="30" height="30">');
							}
							if($row_pager['g_maker']==2){
								print('<img src="../images/adidas.gif" alt="nike" width="30" height="30">');
							}
							if($row_pager['g_maker']==3){
								print('<img src="../images/jordan.gif" alt="nike" width="30" height="30">');
							}
							print('</p>');
							print('</div>');
							print('<div class="name">');
							print('<a href="goods.php?id='.$row_pager['g_id'].'">');
							print('<input type = "hidden" name = "id" value = "'.$row_pager['g_id'].'">');
							print($row_pager['g_ser']);
							print('<br>');
							print($row_pager['g_name']);
							print('</a>');													
							print('</div>');
							print('<div class="goodsprice">');
							print("¥");
							print(number_format($goods_price));
							print('</div>');
							print('</form>');							
							print('</div>');
							$count7 = $count7+1;
						}

						$i=0;
						print('<div id="page">');
						if(isset($_GET['key'])){
							if($_GET['key']=='new'){
								for($count8=0;$count8<$count;$count8=$count8+20){ 
									$i++;						
									print('<a href="step1.php?pager='.$i.'&amp;key=new">');
									print('<input type="hidden" name="pager" value="'.$i.'">');
									print($i);
									print('</a>');
								}
							}
							if($_GET['key']=='old'){
								for($count8=0;$count8<$count;$count8=$count8+20){ 
									$i++;						
									print('<a href="step1.php?pager='.$i.'&amp;key=old">');
									print('<input type="hidden" name="pager" value="'.$i.'">');
									print($i);
									print('</a>');
								}
							}
							if($_GET['key']=='rich'){
								for($count8=0;$count8<$count;$count8=$count8+20){ 
									$i++;						
									print('<a href="step1.php?pager='.$i.'&amp;key=rich">');
									print('<input type="hidden" name="pager" value="'.$i.'">');
									print($i);
									print('</a>');
								}
							}
							if($_GET['key']=='cheap'){
								for($count8=0;$count8<$count;$count8=$count8+20){ 
									$i++;						
									print('<a href="step1.php?pager='.$i.'&amp;key=cheap">');
									print('<input type="hidden" name="pager" value="'.$i.'">');
									print($i);
									print('</a>');
								}
							}

						}
						else{
							for($count8=0;$count8<$count;$count8=$count8+20){ 
								$i++;						
								print('<a href="step1.php?pager='.$i.'">');
								print('<input type="hidden" name="pager" value="'.$i.'">');
								print($i);
								print('</a>');
							}
						}
						print('</div>');

						$j = 0;
						print('<div id="page1">');
						print('<div id="page_su">');
						if(isset($_GET['key'])){
							if($_GET['key']=='new'){
								for($count8=0;$count8<$count;$count8=$count8+20){
									$j++;						
									print('<a href="step1.php?pager='.$j.'&amp;key=new">');
									print('<input type="hidden" name="pager" value="'.$j.'">');
									print($j);
									print('</a>');
								}
							}
							if($_GET['key']=='old'){
								for($count8=0;$count8<$count;$count8=$count8+20){
									$j++;						
									print('<a href="step1.php?pager='.$j.'&amp;key=old">');
									print('<input type="hidden" name="pager" value="'.$j.'">');
									print($j);
									print('</a>');
								}
							}
							if($_GET['key']=='rich'){
								for($count8=0;$count8<$count;$count8=$count8+20){
									$j++;						
									print('<a href="step1.php?pager='.$j.'&amp;key=rich">');
									print('<input type="hidden" name="pager" value="'.$j.'">');
									print($j);
									print('</a>');
								}
							}
							if($_GET['key']=='cheap'){
								for($count8=0;$count8<$count;$count8=$count8+20){
									$j++;						
									print('<a href="step1.php?pager='.$j.'&amp;key=cheap">');
									print('<input type="hidden" name="pager" value="'.$j.'">');
									print($j);
									print('</a>');
								}
							}
						}
						else{
							for($count8=0;$count8<$count;$count8=$count8+20){
									$j++;						
									print('<a href="step1.php?pager='.$j.'">');
									print('<input type="hidden" name="pager" value="'.$j.'">');
									print($j);
									print('</a>');
								}
						}
						print('</div>');
						print('<p>');
						print('(現在表示<span>'.$_SESSION['pager'].'</span>/'.$j.'ページ)');
						print('</p>');
						print('</div>');
						
						if($count7==0){
							print('指定商品は見つかっておりません');
						}						
					?>
				</div><!--id="right"終了-->	
			</div>
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