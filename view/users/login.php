<div class="wrapper">
	<div class="inner">
            <h3 class="major">Connexion à la partie Administrateur</h3>
            <form method="post" action="<?= Router::url('users/login'); ?>">
                <div class="wrapper">
					<div class="inner">
                        <div class="fields">
                            <br>
                            <?= $this->Form->input('login', 'Identifiant');?>
                            <br>
                            <?= $this->Form->input('password', 'Mot de Passe', array('type'=>'password'));?>
                            <br>
                            <ul class="actions">
                                <li><input type="submit" value="Se Connecter" /></li>
                            </ul>
                        </div>
					</div>
				</div>    
            </form>
    </div>        
</div>