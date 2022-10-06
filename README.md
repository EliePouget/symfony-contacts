# symfony-contacts Utilisation de symfony
## Pouget Elie
## Installation / Configuration
### Installation exécutable symfony
 
Exécutable symfony : **get https://get.symfony.com/cli/installer -O - | bash**

Ajout au fichier .bashrc se trouvant à la racine la ligne : **export PATH="$HOME/.symfony5/bin:$PATH"**

Charger les modifications : **source ~/.bashrc**

Vérifier fonctionnement : **symfony self:version**

Contrôler la compatibilité : **symfony check:requirements  --verbose**

### Installation composer 

#### Linux : 

Si besoin créez répertoire bin à la racine : **mkdir ~/bin**

Placez-vous dedans : **cd ~/bin**

Rendez-vous sur le site et exécuté les commandes : https://getcomposer.org/download/

Insérer la ligne au fichier .bashrc : **export PATH="$HOME/bin:$PATH"**

Charger les modifications : **source ~/.bashrc**

Vérifier fonctionnement : **wich composer**

Contrôler la compatibilité : **composer --version**

#### Windows : 

Rendez vous sur le site https://getcomposer.org/doc/00-intro.md#installation-windows et installé le Setup.exe

Installation multi-user

Conserver l'option de désinstallation

Vérifier le chemin php.exe détecté

Testez le fonctionnement dans un **Git Bash** : **composer --version**

### Installer Codeception

Lancez la commande avec composer : **composer require --dev --no-interaction codeception/codeception codeception/module-asserts codeception/module-symfony**

Initialisez Codeception : **php vendor/bin/codecept bootstrap --namespace=App\\Tests --empty**

Ajoutez les paramètres au fichier codeception.yml :
**"params: - .env - .env.test**

### Lancement d'un nouveau projet Symfony 

Commande : symfony --version 5.4 --webapp new symfony-contacts

Associez au répertoire distant : git remote add origin https://iut-info.univ-reims.fr/gitlab/poug0007/symfony-contacts.git

Installez et activez le plugin Symfony Support 

Installez PHP CS Fixer et activez le : **composer require friendsofphp/php-cs-fixer --dev**
http://cutrona/installation-configuration/phpstorm/#configuration-de-phpstorm-analyse-statique-tests-statiques-de-code-php

## Commandes

Lancer serveur web de test : **composer start**

Vérification du code par PHP CS Fixer : **composer test:cs**

Correction du code par PHP CS Fixer : **composer fix:cs**