<section id="one" class="wrapper spotlight style1">
	<div class="inner">
		<h1 class="major"><a href="<?= Router::url('jforte/posts/index'); ?>">Administration</a></h1>
	</div>
</section>
<div class="wrapper">
	<div class="inner">
        <section>  
                <h2 class="major">Interface de modérations</h3>
                <h3> <?= $total ?> Commentaire(s) à modérer</h4>
                <table>
                    <?= $this->Session->flash(); ?>
                    <thead>
                        <td>Post référent</td>
                        <td>Id Commentaire</td>
                        <td>Auteur</td>
                        <td>Commentaire</td>
                        <td>Etat</td>
                        <td>Action</td>
                    </thead>
                    <tbody>
                        <?php foreach($comment as $k=>$v): 
                            if($v->state == 0){
                            ?>
                            <tr>
                                <td>
                                    <?php
                                        foreach ($posts as $key => $value) {
                                            if($v->ref_id == $value->id)
                                            {
                                                echo '<a href="'.Router::url("posts/view/id:{$value->id}/slug:{$value->slug}").'">'.$value->name.'</a>';
                                            }
                                        }
                                    ?>
                                </td>
                                <td><?= $v->id ?></td>
                                <td><?= $v->username ?></td>
                                <td><?= $v->comment?></td>
                                <td>Non modéré</td>  
                                <td>
                                    <a href="<?= Router::url('admin/posts/moderate/'.$v->id.'/'.$v->ref_id); ?>">Valider</a>                                           
                                    <a href="<?= Router::url('admin/posts/deleteComment/'.$v->id); ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php
                            }
                            endforeach; ?>
                    </tbody>
                </table>         
        
                <h3><?= $totalSignal ?> Commentaire(s) signalés</h4>
                <table>
                    <?= $this->Session->flash(); ?>
                    <thead>
                        <td>Post référent</td>
                        <td>Id Commentaire</td>
                        <td>Auteur</td>
                        <td>Commentaire</td>
                        <td>Etat</td>
                        <td>Action</td>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($commentSignal as $k => $v) {
                                if($v->state == 1){
                        ?>
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
                                        <td>Signalés</td>  
                                        <td>
                                            <a href="<?= Router::url('admin/posts/moderate/'.$v->id.'/'.$v->ref_id); ?>">Valider</a>                                           
                                            <a href="<?= Router::url('admin/posts/deleteComment/'.$v->id); ?>">Supprimer</a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <a href="<?= Router::url('admin/posts/commentAll')?>" class="button primary">Voir tous les commentaires</a>
        </section>
    </div>
</div>