	<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<h2>Billet Simple pour l'Alaska</h2>
			<p>Un roman en ligne par épisode écrit par Jean Forteroche</a></p>
		</div>
	</section>

<!-- Wrapper -->
	<section id="wrapper">

		<!-- One -->
			<section id="one" class="wrapper spotlight style1">
				<div class="inner">
					<a href="<?= BASE_URL.'/pages/view/40';?>" class="image"><img src="images/pic01.jpeg" alt="" /></a>
					<div class="content">
						<h2 class="major">Jean Forteroche</h2>
						<p>						<p>Jean Forteroche est un écrivain née à Paris en 1988, depuis toujours il est passionné de littérature et très vite il développe un talent pour l'écriture. Avec une envie de moderniser la littérature et changer la façon de lire un livre il se lance aujourd'hui dans une nouvelle aventure de roman en ligne.</p>
						<a href="<?= BASE_URL.'/pages/view/40';?>" class="special">En savoir plus</a>
					</div>
				</div>
			</section>
	</section>
	<section id="four" class="wrapper alt style1">
		<div class="inner">
			<h3 class="major">Le Roman</h3>
			<p>Tous les lundi retrouvés un nouveau chapitre du livre</p>
			<section class="features">
				<?php foreach ($posts as $k=>$v): ?>
					<article>
						<a href="<?= Router::url("posts/view/id:{$v->id}/slug:{$v->slug}"); ?>" class="image"><img src="images/pic02.jpg" alt="" /></a>
						<h3 class="major"><?= $v->name ?></h3>
						<a href="<?= Router::url("posts/view/id:{$v->id}/slug:{$v->slug}"); ?>" class="special">Lire en entier</a>
					</article>
				<?php endforeach; ?>
			</section>
		<div class="inner">
			<ul class="pagination">
				<?php for ($i=1; $i <= $page; $i++): ?> 
					<li><a href="?page=<?= $i; ?>" <?php if($i==$this->request->page) echo 'class="page active"'; ?>class="page"> <?= $i; ?></a></li>
				<?php endfor; ?>
			</ul>
		</div>											
	</section>

									