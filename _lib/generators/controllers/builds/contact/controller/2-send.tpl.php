
	// Send
	public function send() {
		if ($this->Request()->isPost()) {
			${#Model#} = new <?= $model ?>();

			${#Model#}->fromArray($this->Request()->post());	
			if (${#Model#}->isValid()) {
			
				// Envoi l'email
				$Mailer = new MailerComponent();
				$Mailer->setSubject("[".Config::get('project.domain')."] Un message vient de vous être envoyé.");
				$Mailer->setFrom(${#Model#}['email'], ${#Model#}['name']);
				$Mailer->setTo(Config::get('project.email', Config::get('project.owner')));
				$Mailer->setBody(${#Model#}['body']);
				$Mailer->send();

				FlashComponent::set('success', "Le message a bien été envoyé.");
				$this->redirect(array('controller' => '{#model#}'));
			} else {
				$errors = ${#Model#}->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|{#}} erreur{s}.'));
				
				$this->View->setPath('{#model#}/index');
				$this->View->set('{#Model#}', ${#Model#});
			}
		}		
	}

