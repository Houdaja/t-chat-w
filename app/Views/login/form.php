<?php $this->layout('layout', ['title' =>"Connectez a T'Chat"]); ?>

<?php $this->start('main_content'); ?>

<h2>Connectez-vous à T'Chat</h2>

<?php foreach ($errors as $error) : ?>
		<?php 	echo '<p>'.$error.'</p>'; ?>
<?php endforeach;?>

<form action="<?php $this->url('login') ?>" method="POST">
	<p>
		<label for="pseudo">
			Pseudo :
		</label>
		<input type="text" 
			   name="pseudo" 
			   id="pseudo" 
			   value=""/>
	</p>
	<p>
		<label for="mot_de_passe">
			Mot de passe :
		</label>
		<input type="password" name="mot_de_passe" id="mot_de_passe" />
	</p>
	<p>
		<input type="submit" class="button" value="Me connecter"/>
		<a class="button" href="<?php echo $this->url('register') ?>" title="Accéder à la page d'inscription">
			Pas encore inscrit ?
		</a>
	</p>

</form>

<?php $this->stop('main_content');?>