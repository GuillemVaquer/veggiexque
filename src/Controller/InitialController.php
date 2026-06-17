<?php

namespace App\Controller;

use App\Repository\ProvinceRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InitialController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProvinceRepository $provinceRepository): Response
    {
        $sentences = [
            "Perquè ja has menjat massa truita de patata",
            "Perquè apartar una anxova no és cuinar vegetarià",
            "Perquè la tonyina no és vegetal",
            "Perquè... \"I peix en menges?\"",
            "Perquè t'han servit el gazpatxo amb pernil després de dir que ets vegetarià",
            "Perquè hi ha gent que cuina vegetarià de qualitat",
            "Perquè no volem que tanquen més restaurants vegetarians!",
            "Perquè buscar \"vegetarià\" en google no és cap garantia"
        ];
        
        $sentence = $sentences[array_rand($sentences)];

        return $this->render('home/index.html.twig', [
            'controller_name' => 'InitialController',
            'sentence' => $sentence,
            'provinces' => $provinceRepository->findAll()
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(ProvinceRepository $provinceRepository): Response
    {
            return $this->render('contact/contact.html.twig', [
            'controller_name' => 'InitialController',
            'provinces' => $provinceRepository->findAll()
        ]);
    }

    #[Route('/blog', name: 'app_blog')]
    public function blog(ProvinceRepository $provinceRepository): Response
    {
            return $this->render('blog/blog.html.twig', [
            'controller_name' => 'InitialController',
            'provinces' => $provinceRepository->findAll()
        ]);
    }

    #[Route('/search', name: 'app_search')]
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

    #[Route('/restaurants/vegetarians/{province}', name: 'app_restaurants_by_province')]
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
