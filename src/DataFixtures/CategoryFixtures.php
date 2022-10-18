<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $listNom = json_decode(file_get_contents('data/Category.json', FILE_USE_INCLUDE_PATH));
        foreach ($listNom as $categoryName) {
            CategoryFactory::createOne(['name' => $categoryName->name]);
        }
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
        // TODO: Implement getDependencies() method.
    }
}
