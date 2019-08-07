<?php 

class BasicCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Curling');  
    }
}
