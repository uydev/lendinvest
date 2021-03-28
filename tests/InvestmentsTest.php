<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Investments;
use Lendinvest\Entity\Tranche;
use Lendinvest\Entity\Investor;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Class InvestmentsTest
 * @package Lendinvest\Tests
 */
class InvestmentsTest extends TestCase
{
    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var Tranche
     */
    private $tranche;

    /**
     * @var Investor
     */
    private $investor;

    /**
     * @var Investments
     */
    private $investment;

    /**
     * Setups everything, initialize the objects
     */
    protected function setUp(): void
    {
        $this->date = new DateTime("10/03/2020");
        $this->tranche = new Tranche('A', new Loan(new DateTime("10/01/2020"), new DateTime("11/15/2020")), 3, 1000,  'open');
        $this->investor = new Investor(10001, 'Uner YILMAZ', 1000);
        $this->investment = new Investments(1000, $this->investor, $this->tranche, $this->date);
    }

    /**
     * Get the investor and check if it matches the investor initialized in setup
     */
    public function testGetInvestor(){
        self::assertEquals($this->investor, $this->investment->getInvestor());
    }

    /**
     * Get the amount and check that it matches the investment amount
     */
    public function testGetAmount(){
        self::assertEquals(1000, $this->investment->getAmount());
    }

    /**
     * Get the date of investment and check that it matches the day of investment initialized in setup
     */
    public function testGetDate(){
        self::assertEquals($this->date, $this->investment->getDate());
    }

    /**
     * Get the tranches and check that it matches the tranche initialized
     */
    public function testGetTranche()
    {
        self::assertEquals($this->tranche, $this->investment->getTranche());
    }

    /**
     * Get the daily interest rate and check that is matches our expected value
     */
    public function testGetDailyInterestRate() {
        //For the investment we created for the month of October the number of days is 31
        $dailyInterestRate = $this->tranche->getMonthlyInterestRate()/31;
        self::assertEquals($dailyInterestRate, $this->investment->getDailyInterestRate());
    }

    /**
     * Calculate the return of investment and check that it matches our expected value
     */
    public function testCalculateROI()
    {
        self::assertEquals(28.06, $this->investment->calculateROI());
    }
}
