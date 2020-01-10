
<section id="one" class="wrapper spotlight style1">
	<div class="inner">
		<h1 class="major"><a href="<?= Router::url('jforte/posts/index'); ?>">Edition d'article</a></h1>
	</div>
</section>
	<div class="inner">
        <section>
            <form action="<?= Router::url('admin/posts/edit/'.$id); ?>" method="post">
                <div class="wrapper">
					<div class="inner">
                        <div class="col-12">
                            <?= $this->Form->input('name', 'Titre : '); //Modif balise php?> 
                            <?= $this->Form->input('slug', 'URL : '); ?>
                            <?= $this->Form->input('id', 'hidden'); ?>
                            <?= $this->Form->input('content', 'Contenu :', array('type'=>'textarea', 'rows'=>20)); ?>
                            <?= $this->Form->input('online', 'Mettre en ligne', array('type'=>'checkbox'));?>
                            <br>
                            <ul class="actions">
                                <li><input type="submit" value="Modifier" class="primary" /></li>
                            </ul>
                        </div>
					</div>
                </div>
            </form>
        </section>
    </div>
</div>