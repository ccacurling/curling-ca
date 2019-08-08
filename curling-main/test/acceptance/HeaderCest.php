<?php 

class HeaderCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeElement('.header-grey');
    }
}
