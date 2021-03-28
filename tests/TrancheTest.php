<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Tranche;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Class TrancheTest
 * @package Lendinvest\Tests
 */
class TrancheTest extends TestCase
{
    /**
     * @var Tranche
     */
    private $tranche;

    /**
     * @var Loan
     */
    private $loan;

    /**
     * Setup the tranche and instantiate it
     */
    protected function setUp(): void
    {
        $startDate = new DateTime("10/01/2020");
        $endDate = new DateTime("11/15/2020");
        $this->loan = new Loan($startDate, $endDate);
        $this->tranche = new Tranche('A', $this->loan, 3, 1000, 'open');
    }

    /**
     * Get monthly interest rate for the tranche
     */
    public function testGetMonthlyInterestRate()
    {
        self::assertEquals(3, $this->tranche->getMonthlyInterestRate());
    }

    /**
     * Set monthly interest rate for the tranche
     */
    public function testSetMonthlyInterestRate()
    {
        $this->tranche->setMonthlyInterestRate(10);
        self::assertEquals(10, $this->tranche->getMonthlyInterestRate());
    }

    /**
     * Get the maximum available in the tranche
     */
    public function testGetMaximumAvailable()
    {
        self::assertEquals(1000, $this->tranche->getMaximumAvailable());
    }

    /**
     * Set the maximium available in the tranche
     */
    public function testSetMaximumAvailable()
    {
        $this->tranche->setMaximumAvailable(5000);
        self::assertEquals(5000, $this->tranche->getMaximumAvailable());
    }

    /**
     * Get the Loan that the tranche belongs to
     */
    public function testGetLoan()
    {
        self::assertEquals($this->loan, $this->tranche->getLoan());
    }

    /**
     * Get the status of the tranche
     */
    public function getTrancheStatus()
    {
        self::assertEquals('open', $this->getTrancheStatus());
    }
}
