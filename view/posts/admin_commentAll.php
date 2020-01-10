<section id="one" class="wrapper spotlight style1">
	<div class="inner">
		<h1 class="major"><a href="<?= Router::url('jforte/posts/comment'); ?>">Administration</a></h1>
	</div>
</section>
<div class="wrapper">
	<div class="inner">
        <section>  
                <h2 class="major">Tous les commentaires</h3>
                <h3> <?= $total ?> Commentaire(s)</h4>
                <table>
                    <?= $this->Session->flash(); ?>
                    <thead>
                        <td>Post référent</td>
                        <td>Id Commentaire</td>
                        <td>Auteur</td>
                        <td>Commentaire</td>
                    </thead>
                    <tbody>
                        <?php foreach($comment as $k=>$v):?>
                            <tr>
                                <td>
                                    <?php
                                        foreach ($posts as $key => $value) {
                                            if($v->ref_id == $value->id)
                                            {
                                                echo $value->name;
                                            }
                                        }
                                    ?>
                                </td>
                                <td><?= $v->id ?></td>
                                <td><?= $v->username ?></td>
                                <td><?= $v->comment ?></td>
                                <td><?= $v->created ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>         