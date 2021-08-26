<?php require "inc/head.php" ?>
<style>
#wrap_register_codice{
	/*visibility: hidden;*/
}
</style>
<body class=''>

	<?php require "inc/menu.php" ?>

		<?php 
		// definiamo quale tipo di utente si registra in base all'URL leggermente oscurato
		//1.1/2 aggiungi campo extra nel form per determinare ruolo da assegnare all'utente		
		$wire->addHookAfter("LoginRegisterProRegister::build", function (HookEvent $event) {
			$form = $event->object->form();
			$page = wire('page'); 
			$input = wire('input');
			$role = $input->get->role;

		/*1.2/2 __ limita gli accessi e controlla che il ruolo sia definito nel campo "codice_textarea", in modo da limitare gli accessi 
			(mi raccomando non dimentichiamoci di togliere i permessi, altrimenti chiunque puo' sceglersi in teoria il ruolo) */

			/* i ruoli sono: grafico / catalogatore / catalogatore_junior / gestore */

			$text = $page->codice_textarea; 
			$arrayAllowedRoles = array();
			foreach (explode("\n", $text) as $line) {
				$arrayAllowedRoles[] = trim($line);
			}

			if (in_array($role, $arrayAllowedRoles)) {
				$assignRole = sha1($role); 
			}else{
				$assignRole = "00001"; // tanto per segnalare qualcosa che non va;
				$log = wire('log');
				$log->save("login-register-pro", "New user registration using role not allowed: $role");
			}

			$fieldCodice = $form->getChildByName('register_codice');
			$fieldCodice->value = $assignRole;
			$fieldCodice->class = "uk-hidden";

		});

		//2/2 aggiungi ruolo in base al campo del form, in base ai ruoli sopra definiti
		$wire->addHook('LoginRegisterPro::createUserReady', function($event) {
			$user = $event->arguments(0); /** @var User $user User about to be saved */
			$values = $event->arguments(1); /** @var array $values Values from form */

			if($values['register_codice'] === sha1("grafico")) { $user->addRole('grafico');	}
			if($values['register_codice'] === sha1("catalogatore")) { $user->addRole('catalogatore');	}
			if($values['register_codice'] === sha1("catalogatore_junior")) { $user->addRole('catalogatore_junior');	}
			if($values['register_codice'] === sha1("gestore")) { $user->addRole('gestore');	}

		});
		?>	

		<section class="uk-container">
			<?php echo "<h2 class='uk-margin-remove-bottom'>".ucfirst($page->title)."</h2>";
			$loginRegister = $modules->get('LoginRegisterPro');
			
			$loginRegister->setRedirectUrl('/gestione/'); //redirect da attivare in production, altrimenti mi reindirizza sempre nel back-end
			$loginRegister->setMarkup([
			  // error notification
			  'error' =>
			    "<div class='uk-alert-danger' uk-alert>" .
			      "<a class='uk-alert-close' uk-close></a>" .
			      "<p><span uk-icon='warning'></span> {out}</p>" .
			    "</div>",

			   // success or message notification
			  'success' =>
			    "<div class='uk-alert-success' uk-alert>" .
			      "<a class='uk-alert-close' uk-close></a>" .
			      "<p><span uk-icon='check'></span> {out}</p>" .
			    "</div>",

			   // inline error notification (appears below input)
			  'item_error' =>
			    "<div class='uk-text-danger uk-text-small uk-margin-small-top'>" .
			      "<span uk-icon='warning'></span> {out}" .
			    "</div>",

			   // wrapper for list of links generated by module
			  'links_list' =>
			    "<ul class='uk-list uk-list-divider LoginRegisterLinks'>{out}</ul>",

			  // The following adds custom classes to certain input types.
			  'InputfieldText' => [ 'class' => 'uk-input' ],
			  'InputfieldTextarea' => [ 'class' => 'uk-textarea' ],
			  'InputfieldSelect' => [ 'class' => 'uk-select' ],
			  'InputfieldRadios' => [ 'class' => 'uk-radio' ],
			  'InputfieldCheckbox' => [ 'class' => 'uk-checkbox' ],
			  'InputfieldCheckboxes' => [ 'class' => 'uk-checkbox' ],
			  'InputfieldSubmit' => [ 'class' => 'uk-button uk-button-primary' ],

			  // Login form: make name & pass fields side-by-side 50% width
			  'name=login_name' => [ 'columnWidth' => 50 ],
			  'name=login_pass' => [ 'columnWidth' => 50 ]
			]); 
			echo $loginRegister->execute();
			 ?>
		</section>


	
	<?php require "inc/footer.php" ?>

</body>
</html>


<?php 
/*
<main>
  <?php
  $loginRegister = $modules->get('LoginRegisterPro');
  if($user->isLoggedin()) {
    // logged-in user: let it auto-detect what to display
    echo $loginRegister->execute();
  } else {
    // user not logged-in: tell it to display registration form
    echo $loginRegister->execute('register');
  }
  ?>
</main>

<aside>
  <?php
  // displays login form only if user not already logged in
  if(!$user->isLoggedIn()) {
    echo $loginRegister->execute('login');
  }
  ?>
</aside>

*/ ?>