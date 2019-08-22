<?php 

use \Codeception\Util\Locator;

class NavbarCest {
    public function _before(AcceptanceTester $I) {
    }

    // tests
    public function tryToTest(AcceptanceTester $I) {
        $I->amOnPage('/');
        NavbarCest::_testTopNav($I);
    }

    private static function _testTopNav(AcceptanceTester $I) {
        $I->see('CURLING CANADA', '.nav-menu-top .nav-menu-top-left-wrapper .menu-item');
        $I->see('ABOUT CURLING', '.nav-menu-top .nav-menu-top-left-wrapper .menu-item');
        $I->see('OUR ORGANIZATION', '.nav-menu-top .nav-menu-top-left-wrapper .menu-item');

        $I->see('TICKETS', '.nav-menu-top .nav-menu-top-right-wrapper .menu-item');
        $I->see('SHOP', '.nav-menu-top .nav-menu-top-right-wrapper .menu-item');
        $I->see('SEARCH', '.nav-menu-top .nav-menu-top-right-wrapper .menu-item');
        $I->see('DONATE', '.nav-menu-top .nav-menu-top-right-wrapper .menu-item');
        $I->see('FR', '.nav-menu-top .nav-menu-top-right-wrapper .menu-item');
    }
}
