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
        $id = $I->grabMultiple('.contacts');
        $I->assertSame('Aaaaaaaaaaaaaa, Albert', $id[0], 'Albert aaa');
        $I->assertSame('Aaaaaaaaaaaaaa, Jean', $id[1], 'Jean aaa');
        $I->assertSame('Bbbbbbbb, Byll', $id[2], 'Byll bbb');
        $I->assertSame('Bbbbbbbb, Etienne', $id[3], 'Etienne bbb');
    }
}
