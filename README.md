![separe](https://github.com/studoo-app/.github/blob/main/profile/studoo-banner-logo.png)
# Symfony TP 2 - Le système de template Twig
[![Version](https://img.shields.io/badge/Version-2025-blue)]()
[![Niveau](https://img.shields.io/badge/Niveau-SIO2-yellow)]()

## 1. Contexte professionnel

Vous êtes développeur web dans une agence digitale spécialisée dans le secteur du divertissement. Le groupe CinéVision, propriétaire de plusieurs complexes cinématographiques en région, souhaite moderniser sa présence en ligne. Ils vous confient la création d'une plateforme web permettant de :

- Présenter la programmation actuelle des films
- Afficher les détails complets de chaque film (synopsis, durée, acteurs, séances)
- Permettre aux visiteurs de filtrer les films par genre cinématographique
- Offrir une interface moderne et responsive pour améliorer l'expérience client
- Proposer différentes vues selon le type d'utilisateur (visiteur, employé)

Le groupe a choisi Symfony pour sa flexibilité et Twig pour ses capacités de templating avancées. Ce sprint consiste à créer une architecture de templates professionnelle avec héritage, composants réutilisables et intégration CSS moderne.

## 2. Objectifs pédagogiques

**Compétences techniques visées :**
- Maîtriser la syntaxe fondamentale de Twig (affichage, conditions, boucles)
- Créer une architecture de templates avec héritage
- Développer des composants réutilisables (include, embed)
- Utiliser les filtres Twig pour le formatage des données
- Intégrer un framework CSS moderne (Bootstrap)
- Implémenter des templates responsives

**Compétences transversales :**
- Structuration et organisation du code frontend
- Séparation des responsabilités (logique/présentation)
- Création d'interfaces utilisateur cohérentes

## 3. Consignes détaillées

### 🚀 Phase 1 : Configuration et Structure de Base 

#### Étape 1.1 : Installation des dépendances Twig et Encore
**Mission :** Configurez votre projet `cinema-gestvision` avec tous les composants nécessaires

1. Créez le projet et installez les dépendances :
   ```bash
   symfony new cinema --webapp
   ```

#### Étape 1.2 : Création du contrôleur principal
**Mission autonome :** Créez `CinemaController` avec les méthodes de base

**Structure requise :**
```php
<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CinemaController extends AbstractController
{
    #[Route('/', name: 'cinema_accueil')]
    public function accueil(): Response
    {
        // À compléter avec données de test
    }
    
    #[Route('/programmation', name: 'cinema_programmation')]
    public function programmation(): Response
    {
        // À compléter
    }
    
    #[Route('/film/{id}', name: 'cinema_film_detail')]
    public function filmDetail(int $id): Response
    {
        // À compléter
    }
}
```

### 🚀 Phase 2 : Template de Base et Architecture

#### Étape 2.1 : Création du template de base
**Mission :** Créez `templates/base.html.twig` avec une structure professionnelle

**Spécifications :**
```html
<!DOCTYPE html>  
<html>  
    <head>  
        <meta charset="UTF-8">  
        <title>{% block title %}Welcome!{% endblock %}</title>  
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text><text y=%221.3em%22 x=%220.2em%22 font-size=%2276%22 fill=%22%23fff%22>sf</text></svg>">  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
        {% block stylesheets %}  
        {% endblock %}  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
        {% block javascripts %}  
            {% block importmap %}{{ importmap('app') }}{% endblock %}  
        {% endblock %}  
    </head>  
    <body>  
        {% block body %}{% endblock %}  
    </body>  
</html>
```

#### Étape 2.2 : Installation et configuration de Bootstrap
**Mission autonome :** Ajouter et configurer Boostrap ou tout autre framework frontend afin de l'utiliser comme framework d'interface

### 🚀 Phase 3 : Composants de Navigation et Layout

#### Étape 3.1 : Composant de navigation
**Mission :** Créez `templates/components/navigation.html.twig`

**Données simulées pour la navigation ( à traduire dans les templates ) :**
```php
$navigation = [
    'accueil' => ['route' => 'cinema_accueil', 'label' => 'Accueil'],
    'programmation' => ['route' => 'cinema_programmation', 'label' => 'Programmation'],
    'genres' => [
        'label' => 'Genres',
        'items' => [
            'action' => ['route' => 'cinema_genre', 'label' => 'Action', 'params' => ['genre' => 'action']],
            'comedie' => ['route' => 'cinema_genre', 'label' => 'Comédie', 'params' => ['genre' => 'comedie']],
            'drame' => ['route' => 'cinema_genre', 'label' => 'Drame', 'params' => ['genre' => 'drame']],
            'sciencefiction' => ['route' => 'cinema_genre', 'label' => 'Science-Fiction', 'params' => ['genre' => 'sf']]
        ]
    ],
    'contact' => ['route' => 'cinema_contact', 'label' => 'Contact']
];
```

**Spécifications du composant :**
- Navigation responsive avec Bootstrap
- Menu déroulant pour les genres
- Indication de la page active
- Logo CinéVision

#### Étape 3.2 : Composant footer
**Mission autonome :** Créez un footer avec informations du cinéma

**Contenu requis :**
- Coordonnées du cinéma (adresse, téléphone, email)
- Horaires d'ouverture
- Copyright avec année dynamique

### 🚀 Phase 4 : Templates de Films et Données Complexes

#### Étape 4.1 : Structure des données films
**Mission :** Implémentez les données de test dans vos contrôleurs

**Données complètes à simuler :**
```php
$films = [
    1 => [
        'id' => 1,
        'titre' => 'Avatar : La Voie de l\'Eau',
        'titre_original' => 'Avatar: The Way of Water',
        'realisateur' => 'James Cameron',
        'genre' => 'science-fiction',
        'duree' => 192, // en minutes
        'annee' => 2022,
        'note_presse' => 4.2,
        'note_spectateurs' => 4.8,
        'synopsis' => 'Jake Sully vit désormais avec sa famille sur Pandora. Lorsqu\'une menace familière revient pour finir ce qui a été commencé, Jake doit travailler avec Neytiri...',
        'acteurs' => ['Sam Worthington', 'Zoe Saldaña', 'Sigourney Weaver', 'Stephen Lang'],
        'image_affiche' => 'avatar2.jpg',
        'image_banniere' => 'avatar2_banner.jpg',
        'bande_annonce' => 'https://youtube.com/watch?v=exemple',
        'classification' => 'Tous publics',
        'langue' => 'VF/VOSTFR',
        'seances' => [
            ['horaire' => '14:00', 'salle' => 1, 'version' => 'VF'],
            ['horaire' => '17:30', 'salle' => 1, 'version' => 'VOSTFR'],
            ['horaire' => '21:00', 'salle' => 2, 'version' => 'VF']
        ],
        'statut' => 'a_l_affiche'
    ],
    2 => [
        'id' => 2,
        'titre' => 'Top Gun : Maverick',
        'titre_original' => 'Top Gun: Maverick',
        'realisateur' => 'Joseph Kosinski',
        'genre' => 'action',
        'duree' => 131,
        'annee' => 2022,
        'note_presse' => 4.5,
        'note_spectateurs' => 4.7,
        'synopsis' => 'Pete "Maverick" Mitchell, après plus de trente ans de service en tant que pilote naval, repousse ses limites en tant qu\'instructeur d\'élite...',
        'acteurs' => ['Tom Cruise', 'Miles Teller', 'Jennifer Connelly', 'Jon Hamm'],
        'image_affiche' => 'topgun.jpg',
        'image_banniere' => 'topgun_banner.jpg',
        'bande_annonce' => 'https://youtube.com/watch?v=exemple2',
        'classification' => 'Tous publics',
        'langue' => 'VF/VOSTFR',
        'seances' => [
            ['horaire' => '15:30', 'salle' => 3, 'version' => 'VF'],
            ['horaire' => '19:00', 'salle' => 3, 'version' => 'VOSTFR'],
            ['horaire' => '22:15', 'salle' => 1, 'version' => 'VF']
        ],
        'statut' => 'a_l_affiche'
    ],
    3 => [
        'id' => 3,
        'titre' => 'The Menu',
        'titre_original' => 'The Menu',
        'realisateur' => 'Mark Mylod',
        'genre' => 'thriller',
        'duree' => 107,
        'annee' => 2022,
        'note_presse' => 4.0,
        'note_spectateurs' => 3.9,
        'synopsis' => 'Un couple se rend sur une île côtière pour dîner dans un restaurant exclusif où le chef a préparé un menu somptueux...',
        'acteurs' => ['Anya Taylor-Joy', 'Ralph Fiennes', 'Nicholas Hoult'],
        'image_affiche' => 'themenu.jpg',
        'image_banniere' => 'themenu_banner.jpg',
        'bande_annonce' => 'https://youtube.com/watch?v=exemple3',
        'classification' => 'Interdit -12 ans',
        'langue' => 'VOSTFR',
        'seances' => [
            ['horaire' => '20:00', 'salle' => 4, 'version' => 'VOSTFR'],
            ['horaire' => '22:30', 'salle' => 4, 'version' => 'VOSTFR']
        ],
        'statut' => 'prochainement'
    ]
];
```

#### Étape 4.2 : Template de programmation
**Mission :** Créez `templates/cinema/programmation.html.twig`

**Spécifications :**
- Affichage en grille responsive (3 colonnes desktop, 2 tablette, 1 mobile)
- Carte pour chaque film avec image, titre, genre, durée
- Filtres par statut (à l'affiche, prochainement)
- Utilisation des filtres Twig pour formatage des données

#### Étape 4.3 : Template de détail film
**Mission autonome :** Créez `templates/cinema/film_detail.html.twig`

**Exigences :**
- Layout en deux colonnes (affiche + informations)
- Affichage de toutes les données du film
- Section séances avec horaires formatés
- Breadcrumb de navigation
- Boutons d'action (bande-annonce, partage)

### 🚀 Phase 5 : Composants Réutilisables et Filtres Avancés (60 minutes)

#### Étape 5.1 : Composant carte de film
**Mission :** Créez `templates/components/film_card.html.twig`

**Fonctionnalités :**
- Notes avec étoiles (utiliser des filtres)
- Badge de genre avec couleur
- Durée formatée en heures/minutes

#### Étape 5.2 : Filtres personnalisés avancés
**Mission autonome :** Utilisez les filtres Twig pour améliorer l'affichage

**Exemples à implémenter :**
```twig
{# Durée en format lisible #}
{{ film.duree|format_duree }} {# "3h 12min" au lieu de "192" #}

{# Genre avec badge coloré #}
{{ film.genre|genre_badge|raw }}

{# Note avec étoiles #}
{{ film.note_spectateurs|etoiles|raw }}

{# Première lettre en majuscule pour les acteurs #}
{{ film.acteurs|map(actor => actor|title)|join(', ') }}

{# Synopsis tronqué intelligemment #}
{{ film.synopsis|slice(0, 150)|trim }}...
```

Créer les macros nécessaires dans un fichier `film_filters.html.twig`.

#### Étape 5.3 : Template avec embed pour modales
**Mission :** Créez un système de modales réutilisables

**Composant de base :** `templates/components/modal_base.html.twig`
**Utilisation :** Modal de bande-annonce avec embed pour personnalisation

## 5. Ressources utiles

### Documentation officielle
- [Templates Twig](https://symfony.com/doc/current/templates.html)
- [Héritage de templates](https://twig.symfony.com/doc/3.x/templates.html#template-inheritance)
- [Filtres Twig](https://twig.symfony.com/doc/3.x/filters/index.html)
- [Macros](https://twig.symfony.com/doc/3.x/tags/macro.html)
- [Embed](https://twig.symfony.com/doc/3.x/tags/embed.html)

### Ressources Bootstrap
- [Documentation Bootstrap 5](https://getbootstrap.com/docs/5.3/)
- [Composants Bootstrap](https://getbootstrap.com/docs/5.3/components/)
- [Système de grille](https://getbootstrap.com/docs/5.3/layout/grid/)
