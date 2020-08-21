<nav id="menu" class="left show menu">
	<ul>
		<li>
			<a href="#">Тікети</a>
			<ul>
				<li><a href="<?=base_url('tickets/all');?>">Всі</a></li>
				<li><a href="<?=base_url('tickets/new');?>">Нові</a></li>
				<li><a href="<?=base_url('tickets/accept');?>">В роботі</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Налаштування</a>
			<ul>
				<li><a href="<?=base_url('/');?>">Helper WEB</a></li>
				<li><a href="<?=base_url('settings/desktop');?>">Helper Desktop</a></li>
				<li><a href="<?=base_url('settings/users');?>">Користувачі</a></li>
			</ul>
		</li>
	</ul>
</nav>