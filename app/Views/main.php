<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Helper Web</title>
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

		<div class="container">
			<div class="tickets">

			</div>
		</div>
	</div>
	<footer>
		<p>2020</p>
	</footer>

	<script src="<?=base_url('template/js/jquery-3.5.1.min.js');?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
	<script src="<?=base_url('template/js/core.js');?>"></script>
</body>

</html>