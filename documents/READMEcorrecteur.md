# FAQ O'Clock (à l'intention du correcteur)                     

## Informations utiles

#### Résumé :  
_j'ai perdu beaucoup de temps à reprendre et me réapproprier pas mal de notions. Un exercice vraiment bénéfique, car ça m'a permis de revoir toute la spé avec une vue d'ensemble, ce qui m'a permis de comprendre certaines choses que je n'avais pas intégrées._ 
_J'ai quand même le sentiment que je dois retravailler les notions de la dernière semaine, mais ce que j'ai fait dans cette éval est très très supérieur à ce que je pensais être capable de faire (comme à chaque éval ...)_

> Super taf, bravo à toi ! Tu t'es dépassé :)

### **Travail de préparation**

- [Modèle Conceptuel de Données](https://drive.google.com/open?id=1fqLuRvp_QlRKJ69PnlSj0BPRAjOOk_hd_6pPVqJdOYM)
- [Dictionnaire de Données](https://drive.google.com/open?id=1TZq1X6DWoTz7feyv41CRS8PetaHFd8J-aHeor5nEE3s)  
- [Trello](https://trello.com/b/zSFnC1RL/faq-eval)  

> Des wireframes (pour l'inté) et des user stories (pour l'écritures des tâches) seraient un plus, mais tes documents sont assez complets et corrects pour pouvoir lancer le travail et avoir une idée de ce qu tu dois coder ! Très bien.

### **Données**

- Format de la base de donnée : fixtures
    - à la main (en 20min pour ne pas perdre trop de temps), je n'ai pas utilisé de faker
    - je n'ai pas réussi à générer des tags rattachés aux questions (ManyToMany)

> J'ai corrigé un bug résiduel pour pouvoir lancer les fixtues, rien de dramatique ;) Ok pour les fixtures à la mano, l'important c'est qu'il y'en ait. Pour la relation Question/Tag il te suffisait d'appeler la méthode `addTag()` sur `$question`, elle existe déjà dans ton entité ;)

### **Utilisateurs / Rôles**
- Informations de connexion : login / mot de passe
    - administrateur : admin / admin
    - modérateur : modo / modo
    - utilisateur 1 : user1 / user1
    - utilisateur 2 : user2 / user2
    - utilisateur 3 : user3 / user3
    - utilisateur 4 : user4 / user4
    - utilisateur 5 : user5 / user5

> OK

## **Ce que j'ai fait**
---
- **Ce qui était demandé** :
    - ce que j'ai réussi à faire
      - ce que je n'ai pas fait
---
- **Navigation** :
    - le user peut se connecter, se déconnecter, s'inscrire;
    > Attention à l'inscription tu te bases sur le rôle dont l'id est 1, avec mes fixtures je démarrais à 4, plutôt utiliser le nom du rôle pour le récupérer, par ex. `$user->setRole($roleRepo->findOneByRolename('ROLE_USER'));`
    - le nom de l'appli fait office de bouton "/home";      
    - lorsque le user est connecté : un bouton "poser une question" et une div avec "bienvenu  NomDuUser" apparaissent.
- **Accueil** :
    - affiche la liste des questions
    - un aside regroupe les tags
- **page _/question/show/id_** :
    - affiche la liste des réponses associées
    - consultable pour le visiteur
    - un user peut répondre / un message invite le visiteur à se connecter pour répondre
    - le user à l'origine de la question peut valider une réponse (celle-ci devient verte)
    - les réponses "validées" s'affichent en haut de la liste
- **page _/user/profile_** :
    - affiche et permet la modification des données du user
    - affiche et propose un lien vers les questions ET les réponses du user
- **Bouton _Valider_** :
    - il fonctionne (valider/invalider) et insère en BDD
      - un bug dû à **_include_** dans la boucle **_for_** fait que le chemin en POST ne fonctionne que dans la 1ere itération de la boucle. Les autres itérations envoient en GET vers une autre page où figure seulement un bouton (la page du "formulaire lié en include"... Néanmoins, cliquer sur ce bouton termine l'action, et envoie correctement en BDD. Je n'ai pas trouvé comment remédier à ce bug.

> J'ai l'impression que c'est lié à un token de validation, visible dans le code source uniquement pour la première réponse. Un POST pour ce genre d'action c'est bien, au pire tu aurais pu gérer ça en via GET dans un premier temps sur un lien direct (faille CSRF potentielle du coup). Pour gérer ça via post il doit falloir créer un objet de formulaire par réponse ou autre technique de sioux à découvrir sur le site de Symfo :p

- **Bouton _Bloquer_** :
    - il fonctionne (block/unblock) et insère en BDD
    - les questions/réponses bloquées n'apparaissent pas pour les visiteurs et simples users. le modérateur les voit, le bouton block devient rouge.
      - même soucis que pour le bouton Valider au-dessus : le bouton de la premiere itération de la boucle fonctionne en direct, les autres envoie vers la page du formulaire de l'include.

> Idem donc. A tester en GET puis voir comment gérer ça via POST (j'avoue là, j'ai pas la solution codée en POST).
      
- **_Sécurité_**
    - l'admin a les droits de modérateur et user , le modérateur a les droit user.
 
- **_Intégration_**
    - même si cela n'était pas obligatoire, j'ai tenu à faire une intégration de l'appli, notamment pour générer des affichages dynamiques avec des balises {% if...%} et {% is_granted... %}: dissocié visuellement les différents éléments d'une page, changement des boutons de la navigation selon que l'utilisateur est logué ou pas et apparition d'un item avec le nom de l'utilisateur logué, des changements de couleurs en fonction des actions, réponses validées : fond vert, en haut de la boucle ; questions-reponses bloquées: en display:none pour les user, changement de couleur des boutons block pour les modérateurs)

> Bel effort sur l'inté et en effet bonne gestion du zoning, des états, des couleurs etc.

### **Ce que je n'ai pas fait**

- gestion des "tags" par modérateur/admin (créer/supprimer)
- une page de liste de questions par tags
- les tags dans le aside ne sont pas cliquables (pour envoyer vers la liste "questions par tags") 

- les BONUS

> C'est déjà un gros travali d'effectué, tu peux être fier de toi ;)