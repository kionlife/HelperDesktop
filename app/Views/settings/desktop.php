<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Helper Web | Налаштування</title>
	<link rel="stylesheet" href="<?=base_url('template/css/style.css');?>">
</head>

<body>
	<div class="content">
		<header>
			<div class="container">
				<div class="logo">
					<img src="<?=base_url('template/img/logo.png');?>" alt="">
				</div>
				<div class="profile">
					<button><?=$login;?></button>
				</div>

				<?=view('parts/menu.php');?>


			</div>
		</header>
	
	<?php //var_dump($user_problems); ?>

		<div class="container">
			<h2>Налаштування <b>Helper Desktop</b></h2>
			<hr>
			<div class="settings">
				<form action="<?=base_url('/settings/updateSettings');?>" method="post">
					<div class="problems_block">
						<p>Редагування проблем користувачів</p>
						<ul class="user_problems">
							<?php 
							
								foreach ($user_problems as $item) {
									echo "<li><button type='button' class='del btn red' data='".$item['name']."'>x</button>" . $item['name'] . "</li>";
								}					 
							?>			
						</ul>
						<div class="group">
							<input name="user_problems" id="add_problem_text" type="text" placeholder="Проблема користувача">
							
							<button type="submit" id="add_problem" class="btn blue">Додати</button>
						</div>

					</div>
					<div class="problems_block">
						<p>Адреса серверу</p>
						<input disabled class="textInput" type="text" value="<?=$server_url;?>" name="server_url">
					</div>
					<!--<button class="btn green mCenter" type="submit">Зберегти</button>-->
				</form>
			</div>
		</div>
		
		
		
	</div>
	<footer>
		<p>2020</p>
	</footer>

	<script src="<?=base_url('template/js/jquery-3.5.1.min.js');?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
	<script src="<?=base_url('template/js/core.js');?>"></script>

	<script>
		/* $("body").on("click", "#add_problem", function(){
			var text = $("#add_problem_text").val();
			$("#problems").val($("#problems").val() + text + ";");
			$("ul.user_problems").append('<li><button type="button" class="del btn red" data="' + text + '">x</button>' + text + '</li>');
			
		});
		
		$("body").on("click", ".del", function() {
			var curr_text = $("#problems").val();
			var new_text = curr_text.replace($(this).attr("data") + ';', '');
			$("#problems").val(new_text);
			$(this).parent("li").fadeOut(500);
		}); */
		
	</script>

</body>

</html>