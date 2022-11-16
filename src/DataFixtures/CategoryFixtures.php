<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $listNom = json_decode(file_get_contents('data/Category.json', FILE_USE_INCLUDE_PATH));
        foreach ($listNom as $categoryName) {
            CategoryFactory::createOne(['name' => $categoryName->name]);
        }
    }
}
