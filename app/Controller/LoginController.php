<?php
namespace Controller;

use  \W\Controller\Controller;
use  \W\Security\AuthentificationModel;
use \W\Model\UsersModel;

class LoginController extends Controller {

	public function form(){
		//var_dump('Hello xdebug');
		//si un post a bien été envoyé, on effectue le traitement du formulaire

		// je créer un tableau d'erreur
		$errors = array();
		//var_dump('Contenu de $_POST : ',$_POST);
		if($_POST){
			//On vérifie qu'un pseudo et un mot de passe ont bien été envoyés
			if(empty($_POST['pseudo'])){
				$errors['pseudo'] = 'Vous devez renseigner un pseudo';
			}

			if(empty($_POST['mot_de_passe'])){
				$errors['mot_de_passe'] = 'Vous devez renseigner un mot_de_passe';
			}

			//var_dump('Contenu de mes erreurs après verification empty()', $errors);

			/*Je fais appel au modèle de l'authentification de facon à profiter d ela méthode
			isValidLoginInfo qui a été codé par les concepteurs du framework*/
			$auth = new AuthentificationModel();

			/*Je fais appel à isValidLoginInfo qui va vérifier  que la combinaison 
			pseudo/mot de passe entré par l'utilisateur correspond bien à un utlisateur
			en base de donées*/

			$pseudo = ! empty($_POST['pseudo']) ? $_POST['pseudo'] : '';
			$motDePasse = ! empty($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
			
			//var_dump('pseudo : ', $pseudo);
			//var_dump('mot de passe : ', $motDePasse);

			$userId = $auth->isValidLoginInfo($pseudo, $motDePasse);

			if ($userId === 0){
				$errors['pseudo/mot_de_passe'] = 'Les informations de connexions entrées sont incorrectes';
			}

			//var_dump('Contenu de mes erreurs après validation totale : ', $errors);
			//je vérifie que le tableau d'erreur est non vide, ce qui signifie que le formulaire
			//a été correctement rempli
			if(empty($errors)){
				$usersModel = new UsersModel();
				$userInfos = $usersModel->find($userId);
				//var_dump('informations de l\'utilisateur', $userInfos);
				$auth->logUserIn($userInfos);
				$this->redirectToRoute('default_home');

			}
		}
		$this->show('login/form', array('errors'=>$errors));
	}

}