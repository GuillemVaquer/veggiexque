<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Entity\Province;
use App\Data\RestaurantList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RestaurantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ( RestaurantList::$restaurants as $myRestaurant ){
            $restaurant = new Restaurant;

            $restaurant->setName($myRestaurant['name']);
            $restaurant->setPhone($myRestaurant['phone']);
            $restaurant->setAddress($myRestaurant['address']);
            $restaurant->setPicture('/media/restaurants/' . $myRestaurant['slug'] . '.webp');
            $restaurant->setWebsite($myRestaurant['website']);
            $restaurant->setValidated(true);
            $restaurant->setCreatedAt(new \DateTime());
            $restaurant->setUpdatedAt(new \DateTime());
            $restaurant->setSlug($myRestaurant['slug']);

            $province = $this->getReference('province_' . $myRestaurant['province'], Province::class);
            $restaurant->setProvince($province);

            $restaurant->setCity(null); //igual, però per ara no hi han
            $manager->persist($restaurant);


        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProvinceFixtures::class];
    }
}
