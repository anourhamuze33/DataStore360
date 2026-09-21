# DataStore360

**Transformer les ventes brutes en données fiables et exploitables**

DataStore360 est un projet de Data Engineering qui consiste à transformer un jeu de données retail brut en données propres, structurées, sécurisées et prêtes à être exploitées.

Le projet couvre différentes étapes, de l'exploration et du nettoyage des données jusqu'à leur stockage dans PostgreSQL et l'automatisation du pipeline avec Apache Airflow.

Objectifs

* Explorer et analyser les données de ventes.
* Identifier les valeurs manquantes, les doublons, les incohérences et les valeurs aberrantes.
* Réaliser un Data Profiling afin d'évaluer la qualité des données.
* Nettoyer et transformer les données selon des règles métier.
* Protéger les données personnelles en appliquant des principes de pseudonymisation.
* Calculer des informations utiles comme le délai de livraison et la marge.
* Organiser les données dans PostgreSQL avec une architecture `staging / core`.
* Automatiser les différentes étapes avec Apache Airflow.
* Construire un pipeline reproductible et idempotent.

Pipeline de données


CSV brut  - Extraction  -Staging PostgreSQL  -Nettoyage  -Pseudonymisation  -Transformation  -Core PostgreSQL  -Contrôles qualité

L'ensemble du pipeline est orchestré avec Apache Airflow.

# Exploration et Data Profiling

Une première phase d'analyse permet de mieux comprendre la structure et la qualité du dataset.

Les principales analyses réalisées sont :

* analyse de la structure du dataset ;
* analyse des distributions et des tendances ;
* étude des relations entre les variables ;
* détection des valeurs manquantes ;
* recherche des doublons ;
* identification des incohérences ;
* détection des valeurs aberrantes ;
* génération d'un rapport de Data Profiling au format HTML.

# Nettoyage et transformation

Les données sont ensuite nettoyées en fonction des règles métier définies pour le projet.

Les traitements comprennent notamment :

* gestion des valeurs manquantes ;
* suppression et correction des doublons ;
* correction des incohérences ;
* validation et conversion des dates ;
* traitement des valeurs invalides ou hors limites ;
* création de nouvelles variables à partir des données existantes.

Parmi les variables calculées :

* `delivery_time`
* `profit_margin`

Ces transformations permettent d'obtenir des données plus cohérentes et directement exploitables pour les analyses.

# Protection des données personnelles

La colonne `Customer Name` contient une information permettant d'identifier un client. Elle est donc pseudonymisée avant son chargement dans la couche `core`.

Le nom du client est transformé à l'aide de SHA-256 :


Customer Name  -  SHA-256   -   Nom pseudonymisé


Ainsi, le nom original n'est pas conservé en clair dans la couche `core`.

# Architecture PostgreSQL

Le projet utilise deux principales couches de données.

## Staging

La table `staging.superstore_raw` contient les données brutes telles qu'elles sont fournies par le fichier source.

Cette couche permet de conserver une copie des données avant leur transformation.

# Core

Après le nettoyage et les transformations, les données sont organisées dans plusieurs tables :


core.customers
core.products
core.orders

Cette séparation permet de conserver les données originales dans la couche `staging` tout en disposant d'une couche `core` propre et structurée pour l'exploitation.

## Technologies utilisées

| Domaine                  | Technologies           |

| Langage                  | Python                 |
| Manipulation des données | Pandas, NumPy          |
| Visualisation            | Matplotlib, Seaborn    |
| Data Profiling           | ydata-profiling        |
| Base de données          | PostgreSQL             |
| Connexion à la base      | SQLAlchemy, psycopg2   |
| Orchestration            | Apache Airflow         |
| Infrastructure           | Docker, Docker Compose |
| Administration DB        | pgAdmin                |
| Gestion des dépendances  | uv                     |
| Versionnement            | Git, GitHub            |
| Pseudonymisation         | SHA-256, hashlib       |


# Résultat

À la fin du pipeline, les données retail sont :

* nettoyées ;
* contrôlées ;
* pseudonymisées ;
* transformées ;
* structurées dans PostgreSQL ;
* vérifiées à l'aide de contrôles qualité ;
* chargées automatiquement par Airflow.

Le pipeline peut être exécuté plusieurs fois de manière reproductible tout en évitant la création de doublons.

# Indicateurs disponibles

Le projet permet notamment de suivre :

* le nombre de commandes ;
* le nombre de clients ;
* le nombre de produits ;
* les ventes par catégorie ;
* les ventes par région ;
* les ventes par segment ;
* les anomalies détectées et corrigées ;
* le taux de complétude des données ;
* le nombre de doublons supprimés ;
* les traitements de pseudonymisation appliqués.

## Projet

**DataStore360 — Data Engineering**

Projet individuel réalisé dans le cadre de la formation **YouCode / UM6P**.
