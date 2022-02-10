[cc] Utiliser le protocole SSH
On créé une clef privé / public sur la machine ou l’on est 
Chez@Wam:# ssh-keygen -t ed25519 -a 256

On peut lire les clef ainsi ;
Chez@Wam:# cat .ssh/id_ed25519.pub
Chez@Wam:# cat .ssh/id_ ed25519

On se connecte sans SSH
Chez@Wam:~$ serv@51.15.197.26

On créé le dossier caché ssh s’il n’existe pas 
serv@aChaï:$ sudo mkdir ~/.ssh

On va écrie la clef public dans la machine distante (id_ed25519.pub)
serv@aChaï:$ nano ~/.ssh/authorized_keys

On restart le serveur 
serv@aChaï:$ systemctl restart apache2

On se deconnect du serveur :
serv@aChaï:$ exit

Chez@Wam:~$ ssh serv@51.15.197.26

serv@aChaï:~$

[cc] Utiliser les commandes de base et lancer des scripts
ls : permet de voir le contenu des dossiers.
cp :  permet de copier
copier en changeant le nom : cp nom_fichier nouveau_nom
copier en changeant l’extension : cp fichier.txt fichier.html
copier dossier et son contenu vers un dossier :cp -r /source /destination
mv : permet de déplacer 
renomme voiture en avion : mv voiture avion
déplace voiture en véhicule :  mv /home/xxx/voiture /home/xxx/véhicule 
déplace plusieurs fichiers :  mv voiture1.txt voiture2.txt voiture3.txt /home/xxx/véhicule 
cat : permet de lire un fichier ( less ) 
nano/vim : sont des éditeurs de texte

[cc] Rechercher des choses dans des fichiers
Exemple rechercher tous les sponsors avec un A au début et un s à la fin 
grep -rnw 'Sponsors' -e ‘‘A*s.*’’
rechercher Messi 
grep -rnw 'Players' -e '*Messi*'
Je me balade dans les pièces du donjon
cd
Je regarde ce qu’il y a dedans 
ls
ou peut être qu’il y a des secrets…
ls -all
si il y a des fonction on les lances
./
on fait le petit jeu demandé
par exemple modifier ses son inventaire gagner des HP,
Combattre un monstre pour utiliser une potion et se remettre de la vie

[cc] Copier des fichiers sur une machine distante

[cc] Présenter en îlot le montage d'un serveur web


[cc] Comprendre un problème en lisant un fichier de logs

[cc] Lister les codes de réponses HTTP principaux et leur signification
200 : indique la réussite d'une requête
301 : indique que la ressource a définitivement été déplacée à l'URL contenue dans l'en-tête Location.
302 : indique que la ressource est temporairement déplacée vers l'URL contenue dans l'en-tête Location.
404 : indique qu'un serveur ne peut pas trouver la ressource demandée
500 : indique que le serveur a rencontré un problème inattendu qui l'empêche de répondre à la requête.

[cc] Identifier les différentes parties d'une URL
Dans :
https://web.example.com:8080/page/12?filter=term

https:// représente le schéma indiquant le protocole 
web. représente le sous-domaine
example représente le domaine
.com représente le domaine de premier niveau
:8080 représente le port
/page/12 représente le chemin
?filter=term représente les variable de requêtes
( de recherche ou les formulaires ) 

[cc] Expliquer comment un paquet va d'une machine à l'autre

[cc] Expliquer la configuration DNS.

[cc] Expliquer les failles courantes

[cc] Documenter une procédure technique

[cc] Expliquer les failles courantes

[cc] Je sais chiffrer mon site avec HTTPS
preuve HTTPS
http://solidcat.me/