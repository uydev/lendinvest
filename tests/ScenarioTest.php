<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Tranche;
use Lendinvest\Entity\Investor;
use Lendinvest\Entity\MakeInvestment;
use Exception;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class ScenarioTest
 * @package Lendinvest\Tests
 */
final class ScenarioTest extends TestCase
{
    /**
     * @var Tranche
     */
    private $trancheA;

    /**
     * @var Tranche
     */
    private $trancheB;

    /**
     * Setup the Loan and its tranches
     */
    protected function setUp(): void
    {
        $startDate = new DateTime("10/01/2020");
        $endDate = new DateTime("11/15/2020");
        $loan = new Loan($startDate, $endDate);
        $this->trancheA = new Tranche('A', $loan, 3, 1000, 'open');
        $this->trancheB = new Tranche('B', $loan, 6, 1000, 'open');
    }

    /**
     *  Investor 1 receives 28.06
     *  when investing 1000
     *  from 10/03/2020 to 10/31/2020
     *  on Tranche A
     */
    public function testInvestor1CalculateROI()
    {
        $investor1 = new Investor(10001, 'Investor1', 1000);
        $investment1 = new MakeInvestment($investor1, $this->trancheA, 1000, new DateTime("10/03/2020"));
        $investment1->makeInvestment();
        self::assertEquals(28.06, $investor1->getInvestments()->calculateROI());
    }

    /**
     * Investor2 fails to invest 1 pound in tranche A since
     * investor1 has already invested and the maximum available on trancheA is now exceeded
     * @throws Exception
     */
    public function testInvestor2CannotInvestSinceTrancheAMaximumAllowedHasExceeded()
    {
        $investor1 = new Investor(10001, 'Investor1', 1000);
        $investment1 = new MakeInvestment($investor1, $this->trancheA, 1000, new DateTime("10/03/2020"));
        $investment1->makeInvestment();

        $investor2 = new Investor(10002, 'Investor2', 1000);
        $investment2 = new MakeInvestment($investor2, $this->trancheA, 1500, new DateTime("10/04/2020"));

        $expected = self::expectExceptionMessage("This exceeds the amount available on this tranche");

        $this->assertEquals($expected, $investment2->makeInvestment());
    }

    /** Investor 3 receives 21.29
     *  when investing 500
     *  from 10/03/2020 to 10/31/2020
     *  on Tranche B
     */
    public function testInvestor3CalculateROI()
    {
        $investor3 = new Investor(10003, 'Investor3', 1000);
        $investment3 = new MakeInvestment($investor3, $this->trancheB, 500, new DateTime("10/10/2020"));
        $investment3->makeInvestment();

        self::assertEquals(21.29, $investor3->getInvestments()->calculateROI());
    }

    /**
     * Investor 4 tries investing 1100 but cannot since its more than his virtual wallet
     * and the tranche is smaller
     * @throws Exception
     */
    public function testInvestor4InvestFailsCannotInvestMoreThanAvailableInWalletAndTrancheIsSmaller()
    {
        $investor4 = new Investor(10004, 'Investor4', 1000);
        $investment4 = new MakeInvestment($investor4, $this->trancheB, 1100, new DateTime("10/25/2020"));

        $expected = self::expectExceptionMessage("This exceeds the amount available on this tranche");

        $this->assertEquals($expected, $investment4->makeInvestment());
    }
}
