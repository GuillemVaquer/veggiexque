<?php

namespace App\Controller;

use App\Repository\ProvinceRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class InitialController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function root(Request $request): RedirectResponse
    {
        $locale = $request->getPreferredLanguage(['ca', 'es']) ?? 'ca';

        return $this->redirectToRoute('app_home', [
            '_locale' => $locale,
        ]);
    }
    #[Route('/{_locale}', name: 'app_home')]
    public function index(ProvinceRepository $provinceRepository, TranslatorInterface $translator): Response
    {
        $sentences = [
            'home.sentence.1',
            'home.sentence.2',
            'home.sentence.3',
            'home.sentence.4',
            'home.sentence.5',
            'home.sentence.6',
            'home.sentence.7',
            
        ];

/*
*/            
        
        $sentence = $sentences[array_rand($sentences)];
        $sentence = $translator->trans($sentence, domain: 'messages');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'InitialController',
            'sentence' => $sentence,
            'provinces' => $provinceRepository->findAll()
        ]);
    }

    #[Route('/{_locale}/contact', name: 'app_contact')]
    public function contact(ProvinceRepository $provinceRepository): Response
    {
            return $this->render('contact/contact.html.twig', [
            'controller_name' => 'InitialController',
            'provinces' => $provinceRepository->findAll()
        ]);
    }

    #[Route('/{_locale}/blog', name: 'app_blog')]
    public function blog(ProvinceRepository $provinceRepository): Response
    {
            return $this->render('blog/blog.html.twig', [
            'controller_name' => 'InitialController',
            'provinces' => $provinceRepository->findAll()
        ]);
    }

    #[Route('/{_locale}/search', name: 'app_search')]
    public function search(Request $request, RestaurantRepository $restaurantRepository, ProvinceRepository $provinceRepository): Response
    {
        $query = $request->query->get('q', '');

        $restaurants = $restaurantRepository->searchByQuery($query);

        return $this->render('search/show-search.html.twig', [
            'query' => $query,
            'restaurants' => $restaurants,
            'provinces' => $provinceRepository->findAll(),
        ]);
    }

    #[Route('/{_locale}/restaurants/vegetarians/{province}', name: 'app_restaurants_by_province')]
    public function show_province(string $province, ProvinceRepository $provinceRepository, RestaurantRepository $restaurantRepository): Response
    {

        $provinceEntity = $provinceRepository->findOneBy(['slug' => $province]);

        if (!$provinceEntity) {
        throw $this->createNotFoundException('Province not found');
        }

        $restaurantsInProvince = $restaurantRepository->findBy(['province' => $provinceEntity]);

        return $this->render('search/show-province.html.twig', [
            'province' => $provinceEntity,
            'provinces' => $provinceRepository->findAll(),
            'restaurants' => $restaurantsInProvince
        ]);
    }
}
