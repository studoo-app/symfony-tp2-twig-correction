<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CinemaController extends AbstractController
{
    #[Route('/', name: 'app_cinema')]
    public function index(): Response
    {
        return $this->render('cinema/index.html.twig', [
            'controller_name' => 'CinemaController',
        ]);
    }

    #[Route('/programmation', name: 'cinema_programmation')]
    public function programmation(): Response
    {

        // un tableau contenant le titre, l'image et les seances
        $programmation = array_map(function ($film) {
            return [
                'id' => $film['id'],
                'titre' => $film['titre'],
                'titre_original' => $film['titre_original'],
                'realisateur' => $film['realisateur'],
                'duree' => $film['duree'],
                'annee' => $film['annee'],
                'note_presse' => $film['note_presse'],
                'synopsis' => $film['synopsis'],
                'acteurs' => $film['acteurs'],
                'image_affiche' => $film['image_affiche'],
                'seances' => $film['seances'],
                'statut' => $film['statut'],
                'genre' => $film['genre'],
                'note_spectateurs'=>$film['note_spectateurs']
            ];
        }, $this->getFilms());



        return $this->render('cinema/programmation.html.twig', [
            'programmation' => $programmation,
        ]);
    }

    #[Route('/film/{id}', name: 'cinema_film_detail')]
    public function filmDetail(int $id): Response
    {
        $film = null;

        foreach ($this->getFilms() as $f) {
            if ($f['id'] === $id) {
                $film = $f;
                break;
            }
        }
        if (!$film) {
            throw $this->createNotFoundException('Film non trouvé');
        }
        return $this->render('cinema/film_detail.html.twig', [
            'film' => $film,
        ]);
    }

    private function getFilms(): array
    {
        return [
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
                'image_affiche' => 'https://placehold.co/100',
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
                'image_affiche' => 'https://placehold.co/100',
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
                    'image_affiche' => 'https://placehold.co/100',
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
    }
}
