<?php

namespace App\DataFixtures;

use App\Entity\Province;
use App\Data\ProvinceList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProvinceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ( ProvinceList::$provinces as $myProvince) {
            $province = new Province();
            $province->setName($myProvince['name']);
            $province->setSlug($myProvince['slug']);
            $manager->persist($province);

            $this->addReference('province_' . $myProvince['slug'], $province);
        }

        $manager->flush();
    }
}
