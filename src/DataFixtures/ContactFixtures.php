<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ContactFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ContactFactory::createMany(150, function () {
            $res = [];
            if (ContactFactory::faker()->boolean(90)) {
                $res = ['category' => CategoryFactory::random()];
            }

            return $res;
        });
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
        // TODO: Implement getDependencies() method.
    }
}
