<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:zhihu-login.html');
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>首页-知乎</title>
	<link rel="stylesheet" type="text/css" href="css/zhihu_topbar_blue.css">
	<link rel="icon" href="https://static.zhihu.com/static/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/zhihu-container-mainpage.css">
</head>
<body>
<!-- 	<div class="ask-question-area-background"></div>
 -->
	<div class="hide-area">
		<div class="hide-area-container">
			<div class="hide-area-header">
				提问
				<button class="header-off-btn">
					
				</button>
			</div>
		 	<div class="ask-question-area">
		 		<p class="title"></p>
		 		<form method="POST"  id="ques-submit-form">
		 		<div class="ques-title">
		 			<textarea name="ques-title" class="ques-title" cols="68" rows="1" style="resize: none;border: none;" placeholder="写下你的问题..." form="ques-submit-form"></textarea> 
		 		</div>
		 		<div class="ques-warning">
		 			问题说明(可选):
		 		</div>
		 		<div class="ques-content">
		 			<textarea name="ques-title" class="ques-content" cols="65" rows="3" style="resize: none;border: none;" placeholder="在这里写下你的问题..." form="ques-submit-form"></textarea> 
		 		</div>
		 			<input type="submit" name="ques-submit" class="ques-submit" />
		 		</form>
		 	</div>
		 </div>
	</div>


	<!-- 顶部工具栏 -->
	<div class="top-tool">
		<div class="top-container">
			<a href="" class="zhihu-logo">
				
			</a>

			<div class="div-top-search">
				<form method="POST" style="height: 32.4px;">
					<input type="text" name="top-search-box" class="top-search" placeholder="搜索你感兴趣的内容..." />
					<button type="submit" class="top-search-button">
						<div class="top-search-button-bgimage">
						</div>
					</button>
				</form>
			</div>

			<div class="top-list-box">
				<ul class="ul-top-list">
					<li class="li-top-list" id="bg-li-top-list"><a class="top-list-box" href="">首页</a></li>
					<li class="li-top-list"><a class="top-list-box" href="">话题</a></li>
					<li class="li-top-list"><a class="top-list-box" href="">发现</a></li>
					<li class="li-top-list"><a class="top-list-box" href="">消息</a></li>
				</ul>
			</div>


			<div class="top-user-proflie">
				<a href="" class="a-top-user-proflie">
					<img src="image/mingmeng.ico" class="top-user-portrait" />
					<span class="top-nav-username"><?php
					echo $_SESSION['username'];
					?>	
					</span>
				</a>
				<ul class="top-drop-list">
					<li class="top-drop-list-li">
						<a href="" class="top-drop-list-a">
							<img src="image/人像.svg" class="top-drop-list-img">我的主页
						</a>
					</li>
					<li class="top-drop-list-li">
						<a href="" class="top-drop-list-a">
							<img src="image/邮件.svg" class="top-drop-list-img">私信
						</a>
					</li>
					<li class="top-drop-list-li">
						<a href="" class="top-drop-list-a">
							<img src="image/设置.svg" class="top-drop-list-img">设置
						</a>
					</li>
					<li class="top-drop-list-li" id="a0">
						<a href="" class="top-drop-list-a">
							<img src="image/退出.svg" class="top-drop-list-img">退出
						</a>
					</li>
				</ul>
			</div>

			<button class="top-new-question-btn">提问
			</button>
		</div>
	</div>
	<!--内容区域-->
	<div class="main-container">
		<div class="question-area">
			<div class="to-do-list">
				<img src="image/mingmeng.ico" class="con-user-icon" />
				<ul class="user-function-list">
					<li class="function-list">
						<a href="" class="a-function-list">
							<img src="image/提问.svg" class="img-function-list" />
							提问
						</a>
					</li>
					<li class="function-list">
						<a href="" class="a-function-list">
							<img src="image/写文章.svg" class="img-function-list"/>
							写文章
						</a>
					</li>
				</ul>
			</div>
			<div class="news-area-header">
				<img src="image/最新动态.svg" class="news-img" />
				最新动态
			</div>

		</div>
		<!--可能会出现的侧边栏-->
<!-- 		<div class="right-side-bar">
			<ul class="right-side-bar-ul">
				<li class="right-side-bar-li"></li>
				<li class="right-side-bar-li"></li>
				<li class="right-side-bar-li"></li>
			</ul>
		</div> -->
	</div>

	<script type="text/javascript" src="js/zhihu-mainpage.js"></script>
</body>
</html>