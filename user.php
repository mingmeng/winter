<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:zhihu-login.php");
}
$id=$_GET['id'];
$nowid=$_SESSION['id'];
$config=require_once 'php/config.php';
$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
$user=$conn->query("SELECT * FROM user WHERE id={$id}")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>用户 - <?php echo $user['user_name']; ?></title>
	<link rel="icon" href="https://static.zhihu.com/static/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/zhihu_topbar_blue.css">
	<link rel="stylesheet" type="text/css" href="css/zhihu-user.css">
</head>
<body>
			<!-- 顶部工具栏 -->
		<div class="top-tool">
			<div class="top-container">
				<a href="zhihu.php" class="zhihu-logo">
					
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
						<li class="li-top-list" id="bg-li-top-list"><a class="top-list-box" href="zhihu.php">首页</a></li>
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
							<a href="
							<?php 
							$e_content="user.php?id=";
							echo $e_content.$nowid; 
							?>" class="top-drop-list-a">
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
							<a href="php/quit.php" class="top-drop-list-a">
								<img src="image/退出.svg" class="top-drop-list-img">退出
							</a>
						</li>
					</ul>
				</div>

				<button class="top-new-question-btn">提问
				</button>
			</div>
		</div>
			<!-- 提问部分 -->
		<div class="hide-area">
			<div class="hide-area-container">
				<div class="hide-area-header">
					提问
					<button class="header-off-btn">
						
					</button>
				</div>
			 	<div class="ask-question-area">
			 		<p class="title"></p>
			 		<form method="GET"  id="ques-submit-form" action="php/sumary.php">
			 		<div class="ques-title">
			 			<textarea name="ques-title" class="ques-title" cols="68" rows="1" style="resize: none;border: none;" placeholder="写下你的问题..." form="ques-submit-form"></textarea> 
			 		</div>
			 		<div class="ques-warning">
			 			问题说明(可选):
			 		</div>
			 		<div class="ques-content">
			 			<textarea name="ques-content" class="ques-content" cols="65" rows="3" style="resize: none;border: none;" placeholder="在这里写下你的问题..." form="ques-submit-form"></textarea> 
			 		</div>
			 			<input type="submit" name="ques-submit" class="ques-submit" />
			 		</form>
			 	</div>
			 </div>
		</div>
			<!-- 用户信息 -->
		<div class="userInfo-header">
			<div class="userInfoHeaderBGimg">
				
			</div>
			<div class="userInfoArea">

				<div class="userInfoIcon">
					<img src="image/mingmeng.ico" class="userInfoIcon" />
				</div>

				<div class="userInfoDetails">
					<div class="userInfoDetailsName">
						<span>
							<?php echo $user['user_name']; ?>
						</span>
					</div>
					<span class="userInfoDetailsDescribe">
						<?php echo $user['user_information']; ?>
					</span>
				</div>

			</div>
		</div>
		

		<div class="userInfoAnimate">
			<div class="userInfoAnimateChangeHeader">
				<ul class="userInfoAnimate">
					<li>
						<a id="on">
						<?php
						if ($_SESSION['id']==$id) {
							echo "我的回答";
						}
						else{
							echo "他的回答";
						} 
						?>
						<span class="CountAnswers"></span>
						</a>
					</li>

					<li>
						<a>
						<?php 
						if ($_SESSION['id']==$id) 
						{
							echo "我的提问";
						}
						else
						{
							echo "他的提问";
						} 
						?>
						<span class="CountQuestions"></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="answerContainer">
			<?php
			//demob找出最后一个答案的值并开始遍历
			$demob=$conn->query("SELECT * FROM answer ORDER BY answer_id DESC")->fetch(PDO::FETCH_ASSOC);
			for ($count=$demob['answer_id']; $count >0 ; $count--) 
			{ 
				$userAnswer=$conn->query("SELECT * FROM answer WHERE answer_id={$count}")->fetch(PDO::FETCH_ASSOC);
				$question=$conn->query("SELECT * FROM ques WHERE ques_id={$userAnswer['answer_pq_id']}")->fetch(PDO::FETCH_ASSOC);
				if ($userAnswer['answer_author']!=$id) 
				{
					continue;
				}
				else
				{
					echo '<div class="userInfoAnimateOne">';
					echo '<span class="userInfoAnimateHeader">';
					echo "<a href=question.php?id=".$question['ques_id'].">".$question['ques_title']."</a>";
					echo '</span>';
					echo '<div class="userInfoAnimateContent">';
					echo $userAnswer['answer_content'];
					echo "</div>";
					echo "</div>";
				}
			}
			?>
		</div>

		<div class="questionContainer">
			<?php
				//找出最后一个问题的值并开始遍历
				$democ=$conn->query("SELECT * FROM ques ORDER BY ques_id DESC")->fetch(PDO::FETCH_ASSOC);
				for ($countb=$democ['ques_id']; $countb >0 ; $countb--) 
				{ 
					$democ=$conn->query("SELECT * FROM ques WHERE ques_id={$countb}")->fetch(PDO::FETCH_ASSOC);
					if($democ['questioner_id']!=$id)
					{
						continue;
					}
					else
					{
						echo '<div class="userInfoAnimateOne" id="a">';
						echo "<a href=question.php?id=".$democ['ques_id'].">";
						echo $democ['ques_title'];
						echo "</a>";
						echo "</div>";
					}
				}
			?>
		</div>


<script type="text/javascript" src="js/zhihu-source-topbar.js"></script>
<script type="text/javascript" src="js/zhihu-user.js"></script>
</body>
</html>