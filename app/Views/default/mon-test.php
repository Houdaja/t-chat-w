<?php $this->layout('layout', ['title' =>'Ma page de test']); ?>
<?php $this->start('main_content'); ?>

Hello test!<br/>
Je suis un fichier de vue.
<br/>
<a href="<?php echo $this->url('default_home'); ?>" title="retour à l'accueil">Revenir a l'accueil</a>
<br/>
<?php echo $contenu ?>
<?php $this->stop('main_content');?>