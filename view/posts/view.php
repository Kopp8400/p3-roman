<section id="one" class="wrapper spotlight style1">
	
	<div class="inner">
		<h2 class="major"><a href="<?= Router::url('posts/index');?>"><?= $post->name; ?></a></h2>
	</div>
</section>
<section id="wrapper">
	<!-- Content -->
		
		<div class="wrapper">
			<div class="inner">
				<p><?= $post->content; ?></p>
				<ul class="actions">
					<li><a href="mailto:cyril.gontier84100@gmail.com?Subject=<?= $post->name; ?>" class="button primary">Me contacter</a></li>
				</ul>
			</div>
		</div>
		<section id="one" class="wrapper spotlight style1">
			<div class="inner">
				<h2>Espace Commentaire</h2>
			</div>
		</section>
		<div class="wrapper">
			<div class="inner">
				
				<?php 
					
					foreach ($comment as $k => $v) { 
						switch ($v->state) {
							case '0':
								echo '<strong>'.$v->username.'</strong> le <strong>'.$v->created.'</strong> : '.htmlspecialchars($v->comment).'
								<p><a href="'.Router::url("posts/signal/{$v->id}/{$v->ref_id}/{$post->slug}").'"><sub>Signaler le commentaire</sub></a></p>';
								break;
									
							case '1':		
								echo '<strong>'.$v->username.'</strong> le <strong>'.$v->created.'</strong> : '.htmlspecialchars($v->comment).'
								<p><sub>Le commentaire est déjà signalé</sub></p>';
								break;

							case '2':
								echo '<strong>'.$v->username.'</strong> le <strong>'.$v->created.'</strong> : '.htmlspecialchars($v->comment).'
								<p><sub>Le commentaire a été validé</sub></p>';
								break;

							case '3':
								echo '<strong>'.$v->username.'</strong> le <strong>'.$v->created.'</strong> : '.htmlspecialchars($v->comment).'
								<p><sub>Le commentaire a été validé</sub></p>';
								break;
						}
					}
				?>					
				<div class="wrapper">
					<div class="inner">
						<section>
							<h3 class="major"> Ajouter un commentaire</h3>
							<form method="post" action="<?= Router::url("posts/view/id:{$post->id}/slug:{$post->slug}"); ?>">
								<?= 
								    $this->Form->input('username', 'Nom d\'utilisateur : '); 
								?>
								<br>
								<?= 
								   $this->Form->input('comment', 'Message :', array('type'=>'textarea', 'rows'=>5));
								?>
								<br>
								<ul class="actions">
									<li><input type="submit" value="Ajouter le commentaire" class="primary" /></li>
								</ul>
							</form>            
						</section>
					</div>
				</div>
			</div>
		</div>
</section>
