<!DOCTYPE HTML>
<html>
	<head>
		<title><?= isset($title_for_layout)?$title_for_layout:'Administration'; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?= Router::webroot('css/main.css'); ?>"/>
		<noscript><link rel="stylesheet" href="<?= Router::webroot('css/noscript.css'); ?>"/></noscript>
		<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
		<script>tinymce.init({selector:'#mytextarea',});</script>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="<?= Router::url('admin/posts/index'); ?>">Administration</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<h2>Menu</h2>
							<ul class="links">
								<li><a href="<?= Router::url('posts/index'); ?>">Romans</a></li>
								<li><a href="<?= Router::url('admin/posts/index'); ?>">Articles</a></li>
								<li><a href="<?= Router::url('admin/posts/comment'); ?>">Commentaires</a></li>
								<li><a href="<?= Router::url('users/logout'); ?>">Se déconnecter</a></li>

							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>


                <!-- Content -->
                    <?= $content_for_layout ?>


                <!-- Footer -->
					<section id="footer">
						<div class="inner">
							<ul class="copyright">
								<li>&copy; Jean Forteroche</li>
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