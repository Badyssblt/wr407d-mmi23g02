<?php

namespace App\Controller;

use App\Repository\LieuRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class HomeController extends AbstractController
{
    #[Route('/{_locale}', name: 'app_voiture_catalogue', requirements: ['_locale' => 'fr|en'], defaults: ['_locale' => 'fr'])]
    public function index(VoitureRepository $voitureRepository, Request $request, LieuRepository $lieuRepository): Response
    {
        $ville = $request->query->get('ville');
        $keyword = $request->query->get('keyword');


        $voitures = $voitureRepository->findByFilters($ville, $keyword);
        $lieux = $lieuRepository->findDistinctVilles();


        return $this->render('home/index.html.twig', [
            'voitures' => $voitures,
            'villes' => $lieux
        ]);
    }
}
