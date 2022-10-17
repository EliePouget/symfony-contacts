<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function webPageTitle(ControllerTester $I): void
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
        ContactFactory::createMany(5);
        $I->amOnPage('/contact');
        $I->seeNumberOfElements('.contacts', 5);
    }

    public function firstLinkUsable(ControllerTester $I): void
    {
        ContactFactory::createOne(['firstname' => 'Joe', 'lastname' => 'Aaaaaaaaaaaaaa']);
        ContactFactory::createMany(4);
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->click('Aaaaaaaaaaaaaa, Joe');
        $I->seeCurrentRouteIs('app_contact_id', ['id' => 1]);
        $I->seeResponseCodeIsSuccessful();
    }

    public function contactsShort(ControllerTester $I): void
    {
        ContactFactory::createOne(['firstname' => 'Etienne', 'lastname' => 'Bbbbbbbb']);
        ContactFactory::createOne(['firstname' => 'Albert', 'lastname' => 'Aaaaaaaaaaaaaa']);
        ContactFactory::createOne(['firstname' => 'Jean', 'lastname' => 'Aaaaaaaaaaaaaa']);
        ContactFactory::createOne(['firstname' => 'Byll', 'lastname' => 'Bbbbbbbb']);
        $I->amOnPage('/contact');
        $lastnames = $I->grabMultiple('.lastname');
        $firstnames = $I->grabMultiple('.firstname');
        $I->assertSame('Aaaaaaaaaaaaaa, Albert', $lastnames[0].', '.$firstnames[0], 'Albert aaa');
        $I->assertSame('Aaaaaaaaaaaaaa, Jean', $lastnames[1].', '.$firstnames[1], 'Jean aaa');
        $I->assertSame('Bbbbbbbb, Byll', $lastnames[2].', '.$firstnames[2], 'Byll bbb');
        $I->assertSame('Bbbbbbbb, Etienne', $lastnames[3].', '.$firstnames[3], 'Etienne bbb');
    }

    public function orderBySearch(ControllerTester $I): void
    {
        ContactFactory::createOne(['firstname' => 'Etenne', 'lastname' => 'Labarre']);
        ContactFactory::createOne(['firstname' => 'Test', 'lastname' => 'White']);
        ContactFactory::createOne(['firstname' => 'Henry', 'lastname' => 'Test']);
        ContactFactory::createOne(['firstname' => 'Lou', 'lastname' => 'World']);
        $I->amOnPage('/contact?search=te');
        $lastnames = $I->grabMultiple('.lastname');
        $firstnames = $I->grabMultiple('.firstname');
        $I->assertSame('Labarre, Etenne', $lastnames[0].', '.$firstnames[0]);
        $I->assertSame('Test, Henry', $lastnames[1].', '.$firstnames[1]);
        $I->assertSame('White, Test', $lastnames[2].', '.$firstnames[2]);
        $I->seeNumberOfElements('.contacts', 3);
    }
}
