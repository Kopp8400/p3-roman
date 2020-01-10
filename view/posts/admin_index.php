<section id="one" class="wrapper spotlight style1">
	<div class="inner">
		<h1 class="major"><a href="<?= Router::url('jforte/posts/index'); ?>">Administration</a></h1>
	</div>
</section>
<div class="wrapper">
	<div class="inner">
        <section>  
                <h3 class="major">Liste des articles</h3>
                <h4><?= $total ?> Article(s)</h4>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>En Ligne</th>
                                <th>Titre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $k=>$v): ?>
                                <tr>
                                    <td><?= $v->id; ?></td>
                                    <td><span <?= ($v->online==1)? 'sucess' : 'error'; ?>><?= ($v->online==1)? 'En Ligne' : 'Hors-Ligne'; ?></span></td>
                                    <td><?= $v->name; ?></td>
                                    <td>
                                        <a href="<?= Router::url('admin/posts/edit/'.$v->id); ?>">Editer</a>
                                        <a onclick="return confirm('Êtes vous sûr de vouloir supprimer le post')" href="<?= Router::url('admin/posts/delete/'.$v->id); ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?= Router::url('admin/posts/edit')?>" class="button primary">Ajouter un article</a>
                    <a href="<?= Router::url('admin/posts/comment')?>" class="button primary">Voir les commentaires</a>
        </section>
    </div>
</div>
