<?php

namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function webPageTitle(ControllerTester $I):void
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
    }
    public function responseHTTPIs200(ControllerTester $I): void
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIs(200);
    }

    public function allElementsInLi(ControllerTester $I): void
    {
        $I->amOnPage('/contact');
        $I->seeNumberOfElements('li', 195);
    }
}
