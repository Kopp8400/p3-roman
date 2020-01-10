<!DOCTYPE HTML>
<html>
	<head>
		<title><?= isset($title_for_layout)?$title_for_layout:'Jean Forteroche'; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?= Router::webroot('css/main.css'); ?>" />
		<noscript><link rel="stylesheet" href="<?= Router::webroot('css/noscript.css'); ?>" /></noscript>
		<link rel="shortcut icon" type="images/jpg" href="/pic03.jpg"/>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="<?= Router::url('posts/index'); ?>">Billet Simple pour l'Alaska</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<h2>Menu</h2>
							<ul class="links">
									
								<?php $pagesMenu = $this->request('Pages','getMenu'); ?>
									<li><a href="<?= Router::url('') ?>">Romans</a></li>
								<?php foreach ($pagesMenu as $p): ?>
									<li><a href="<?= BASE_URL.'/pages/view/'.$p->id; ?>" title="<?php echo $p->name; ?>"><?php echo $p->name; ?></a></li>
								<?php endforeach; ?>
								<li><a href="<?= Router::url('users/login') ?>">Connexion</a></li>
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>


                <!-- Content -->
					<?= $this->Session->flash(); ?>
                    <?= $content_for_layout ?>


                <!-- Footer -->
					<section id="footer">
						<div class="inner">
							<ul class="copyright">
								<li>&copy; Jean Forteroche | <a href="<?= BASE_URL.'/pages/view/56';?>">Mentions Légales</a> | <a href="mailto:cyril.gontier84100@gmail.com?subject=Discussion">Me contacter</a></li> 
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="<?= Router::webroot('js/jquery.min.js');?>"></script>
			<script src="<?= Router::webroot('js/jquery.scrollex.min.js');?>"></script>
			<script src="<?= Router::webroot('js/browser.min.js');?>"></script>
			<script src="<?= Router::webroot('js/breakpoints.min.js');?>"></script>
			<script src="<?= Router::webroot('js/util.js');?>"></script>
			<script src="<?= Router::webroot('js/main.js');?>"></script>

	</body>
</html>