<?php
	session_start();
	if(!isset($_SESSION['id']))
	{
		header('location:zhihu-login.php;');
	}
	$request_q_id=$_GET['id'];
	$config=require_once 'php/config.php';
	$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$sql="SELECT * FROM ques WHERE ques_id={$request_q_id}";
	$data=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
?>
	<!DOCTYPE html>
	<meta charset="utf-8">
	<html>
	<head>
		<title><?php echo $data['ques_title']; ?> - 问题</title>
		<link rel="icon" href="https://static.zhihu.com/static/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/zhihu_topbar_blue.css">
		<link rel="stylesheet" type="text/css" href="css/zhihu-question.css">
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
							<?php
							$t_url='user.php?id=';
							echo "<a href=".$t_url.$_SESSION['id']; ?> class="top-drop-list-a">
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
			<!-- 问题区域 -->
		<div class="question-detail">
			<div class="left-q-area">
			<div class="shadow">				
				<div class="q-d-title"><?php echo $data['ques_title']; ?></div>
				<!-- <div><?php echo $data['questioner'];?></div> -->
				<div class="q-d-content">
					<?php echo $data['ques_content']; ?>
				</div> 
				<div class="border-div"></div>


				<div class="q-numbers">
					<span>N个回答</span>
					<a class="w-answer">
						写回答
					</a>
				</div>
				</div>
				
				<?php
				$answer_arra=$conn->query("SELECT * FROM answer ORDER BY answer_id DESC")->fetch(PDO::FETCH_ASSOC);
				$answer_startid=$answer_arra['answer_id'];
				$classa="ind-answer";
				$classb="ind-answer-header";
				$classc="ind-answer-header-username";
				$classd="ind-answer-content";
				for ($i=$answer_startid; $i >0 ; $i--) {
					$answer_arr=$conn->query("SELECT * FROM answer WHERE answer_id={$i}")->fetch(PDO::FETCH_ASSOC);
					if ($answer_arr['answer_pq_id']!=$request_q_id) {
						continue;
					}
					else
					{
						$isliked=$conn->query("SELECT * FROM answerup WHERE doner={$_SESSION['id']}  AND answerid={$answer_arr['answer_id']}")->fetch(PDO::FETCH_ASSOC);
						$liked=$conn->query("SELECT * FROM answerup WHERE answerid={$answer_arr['answer_id']}")->fetchAll(PDO::FETCH_ASSOC);
						$likednum=count($liked);
						$updpwn="php/UpDown.php?bedoner=";
						$questionid="&question=";
						$answerid="&answerid=";
						$test_user=$conn->query("SELECT * FROM user WHERE id={$answer_arr['answer_author']}")->fetch(PDO::FETCH_ASSOC);
						$t_url='user.php?id=';
						echo "<div class=".$classa."><div class=".$classb."><a href=".$t_url.$test_user['id']." class=".$classc.">";
						echo $test_user['user_name'];
						echo "</a>";
						if (!empty($isliked)) 
						{
							echo "<a id='liked' >点赞 {$likednum}</a></div>";
						}
						else if($answer_arr['answer_author']==$_SESSION['id'])
						{
							echo "<a id='unlike'>点赞 {$likednum}</a></div>";
						}
						else
						{
							echo "<a href=".$updpwn.$answer_arr['answer_author'].$questionid.$answer_arr['answer_pq_id'].$answerid.$answer_arr['answer_id']." id='unlike'>点赞 {$likednum}</a></div>";
						}
						
						echo "<div class=".$classd.">";
						echo $answer_arr['answer_content'];
						echo "</div></div>";
					}
					
				}
						
				?>
				<div class="answer-area-in-bottom">
					<div class="answer-area-input">
						<form action="php/answer.php" method="GET">
							<textarea class="answer-area-input-ta" cols="60" rows="7" placeholder="在这里写下你的回答...."  name="answer_content"></textarea>
							<input type="submit" name="answer-area-input-submit" class="answer-area-input-submit" />
							<input type="hidden" name="ques_id" value="<?php echo $request_q_id; ?>" />
						</form>
					</div>
				</div>
			</div>
		</div>

			<!-- 回答区域 -->
		<div class="answer-area-container">
			<div class="answer-area">
				<div class="answer-area-header">
					写回答
					<button class="answer-area-off-btn">
						
					</button>
				</div>
				<div class="answer-area-input">
					<div class="answer-area-input-subtitle">
						请写下你的回答...
					</div>
					<form action="php/answer.php" method="GET">
						<textarea class="answer-area-input-ta" cols="60" rows="7" placeholder="在这里写下你的回答...."  name="answer_content"></textarea>
						<input type="submit" name="answer-area-input-submit" class="answer-area-input-submit" />
						<input type="hidden" name="ques_id" value="<?php echo $request_q_id; ?>" />
					</form>
				</div>
			</div>
		</div>


	<script type="text/javascript" src="js/zhihu-question.js"></script>
	</body>
	</html>