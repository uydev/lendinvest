<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Investments;
use Lendinvest\Entity\MakeInvestment;
use Lendinvest\Entity\Investor;
use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Tranche;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Class MakeInvestmentTest
 * @package Lendinvest\Tests
 */
class MakeInvestmentTest extends TestCase
{
    /**
     * @var Investments
     */
    private $investment;

    /**
     * @var Investor
     */
    private $investor;

    /**
     * @var Tranche
     */
    private $tranche;

    /**
     * @var MakeInvestment
     */
    private $makeInvestment;

    /**
     * Setup the tranche and instantiate it
     */
    protected function setUp(): void
    {
        $startDate = new DateTime("10/01/2020");
        $endDate = new DateTime("11/15/2020");
        $loan = new Loan($startDate, $endDate);
        $this->tranche = new Tranche('A', $loan, 3, 10000, 'open');
        $this->investor = new Investor(10001, 'Investor1', 1000);
        $this->investment = new Investments(1000, $this->investor, $this->tranche, new DateTime("10/03/2020"));
        $this->makeInvestment = new MakeInvestment($this->investor, $this->tranche, 1000.0, new DateTime("10/03/2020"));
    }

    /**
     * Get the investor and check that it matches what was created
     */
    public function testGetInvestor()
    {
        self::assertEquals($this->investor, $this->makeInvestment->getInvestor());
    }

    /**
     * Get the tranche and check that it matches what was created
     */
    public function testGetTranche()
    {
        self::assertEquals($this->tranche, $this->makeInvestment->getTranche());
    }

    /**
     * Get the amount and check that it matches the expected value
     */
    public function testGetAmount()
    {
        self::assertEquals(1000.0, $this->makeInvestment->getAmount());
    }
}
