🚗 EasyParki – Gestion d’Événements

Bienvenue dans le module de gestion d’événements de EasyParki, une plateforme intelligente de réservation de stationnement dédiée aux événements urbains et touristiques. Ce module offre aux organisateurs d'événements la possibilité de gérer facilement la logistique des places de parking tout en améliorant l'expérience utilisateur.

✨ Objectif du projet

Gérer efficacement les événements en leur associant des solutions de stationnement intelligentes : ajout d'événements, inscription de participants, suivi en temps réel des places disponibles, export des données, visualisation sur carte, et bien plus encore.

🧩 Fonctionnalités

🎟️ CRUD complet des événements : Ajouter, modifier, supprimer, afficher

👥 Enregistrement des participants à un événement

📉 Suivi dynamique des places occupées/restantes

📫 Système de notification par e-mail (future extension)

🧭 Intégration d’une carte interactive pour localiser le lieu de l’événement

🏷️ Tarification configurable par événement

📄 Export PDF de la liste des événements

📱 Responsive Web Design

📦 Technologies utilisées

Frontend :

HTML5 / CSS3 / JavaScript

Bootstrap 5

Leaflet.js (pour les cartes)

Backend :

PHP 8 (POO)

Architecture MVC légère

Base de données : MariaDB 10.4

Serveur : Apache 2.4 (via XAMPP)

📁 Structure des fichiers

EasyParki/
┣ controllers/
┃ ┗ EvenementController.php
┣ models/
┃ ┣ Evenement.php
┃ ┗ Participation.php
┣ views/
┃ ┣ evenement/
┃ ┃ ┣ add.php
┃ ┃ ┣ edit.php
┃ ┃ ┗ list.php
┃ ┣ participation/
┃ ┃ ┗ inscription.php
┣ config/
┃ ┗ database.php
┣ public/
┃ ┣ css/
┃ ┣ js/
┃ ┗ images/
┣ index.php
┗ README.md

🗃️ Structure de la base de données (gestion_evenements)

Table : evenement

Colonne	Type	Description
idE (PK)	int(11)	Identifiant unique de l’événement (AUTO_INCREMENT)
nomE	varchar(50)	Nom de l’événement
date	varchar(50)	Date de l’événement
lieu	varchar(50)	Lieu géographique
nbrPlace_restante	int(11)	Nombre de places encore disponibles
nbrPlace_occupe	int(11)	Nombre de places déjà réservées
tarification	int(11)	Prix en TND

Table : participation

Colonne	Type	Description
id_participation (PK)	int(11)	Identifiant unique de la participation (AUTO_INCREMENT)
idE (FK)	int(11)	Référence à l’événement (relation 1:N)
nom_participant	varchar(50)	Nom du participant
prenom_participant	varchar(50)	Prénom du participant
numTel_participant	int(11)	Numéro de téléphone
mail_participant	varchar(50)	Adresse email
type_stationnement	varchar(50)	Type (VIP, couvert, normal…)
points_fidelite	int(11)	Points de fidélité attribués

🔄 Relation : Un événement peut avoir plusieurs participations (1:N)

📌 Exemples de données

Événements :

ZDEFF – Marsa – 30 Mai 2025 – 200 places restantes – Tarif : 15 TND

Ocheg Nouba – Carthage – 29 Mai 2025 – 50 places restantes – Tarif : 25 TND

Participations :

Sarah Jardak – VIP – Événement ZDEFF

Salima Cherif – Couvert – Événement Ocheg Nouba

⚙️ Installation (local via XAMPP)

Démarrer Apache et MySQL via XAMPP.

Importer le fichier SQL fourni (gestion_evenements.sql) via phpMyAdmin.

Placer le projet dans htdocs/ : C:\xampp\htdocs\EasyParki

Accéder à l’URL suivante : http://localhost/EasyParki/

Naviguer dans l’interface pour ajouter ou consulter des événements.

🧪 Fonctionnalités à venir

Authentification administrateur

Paiement en ligne sécurisé

QR Code de validation à l’entrée de l’événement

Système de fidélité amélioré

Ajout de filtres (par date, lieu, tarif)

👩‍💻 Développé par

Sarah
Étudiante en 2ème année ingénierie informatique
Projet académique 2025 — École d’Ingénieur

📧 Contact : jardaksara@gmail.tn

📜 Licence

Projet à usage éducatif uniquement. Reproduction ou diffusion interdite sans autorisation préalable.
