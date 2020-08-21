<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Авторизація | Helper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Авторизація">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="<?=base_url('template/css/style_login.css');?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?=base_url('template/css/font-awesome.min.css');?>" type="text/css" media="all">

	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">

</head>

<body>

<section class="main">
	<div class="layer">
		
		<div class="bottom-grid">
			<div class="logo">
				<h1 style="text-align: center"> <a href="index.html"><img src="<?=base_url('template/img/logo.png');?>" alt=""></a></h1>
			</div>
			
		</div>
		<div class="content-w3ls">
			<div class="text-center icon">
                <span class="fa fa-user"></span>
                <? if (isset($error)) { echo '<h2 class="errorMsg">' . $error . '</h2>'; } ?>
			</div>
			<div class="content-bottom">
				<form action="<?=base_url('tickets/auth');?>" method="post">
					<div class="field-group">
						<span class="fa fa-user" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="login" id="text1" type="text" value="" placeholder="Логін" required>
						</div>
					</div>
					<div class="field-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="pass" id="myInput" type="Password" placeholder="Пароль">
						</div>
					</div>
					<div class="wthree-field">
						<button type="submit" class="btn">Вхід</button>
					</div>
					<ul class="list-login">
						<li>
							<a href="#" class="text-right">Забули пароль?</a>
						</li>
						<li class="clearfix"></li>
					</ul>
				</form>
			</div>
		</div>
		
    </div>
</section>

</body>
</html>
