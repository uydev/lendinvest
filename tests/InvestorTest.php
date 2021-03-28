<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Tranche;
use Lendinvest\Entity\Investor;
use Lendinvest\Entity\Investments;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class InvestorTest
 * @package Lendinvest\Tests
 */
final class InvestorTest extends TestCase
{
    /**
     * @var Investor
     */
    private $investor;

    /**
     * Setup the Loan and its tranches
     */
    protected function setUp(): void
    {
        $this->investor = new Investor(10001, 'Uner YILMAZ', 1000);
    }

    /**
     * Get full name of investor and check it matches what was initialized
     */
    public function testGetFullName()
    {
        self::assertEquals('Uner YILMAZ', $this->investor->getFullname());
    }

    /**
     * Get the amount in the virtual wallet for the investor and check it matches what was initialized
     */
    public function testGetVirtualWallet()
    {
        self::assertEquals(1000, $this->investor->getVirtualWallet());
    }

    /**
     * Set a new amount for the virtual wallet and check that the updates has occurred as expected
     */
    public function testSetVirtualWallet()
    {
        $this->investor->setVirtualWallet(5000);
        self::assertEquals(5000, $this->investor->getVirtualWallet());
    }

    /**
     * Add money to the virtual wallet and check that the addition has occurred as expected
     */
    public function testAddMoneyToWallet()
    {
        $this->investor->addMoneyToWallet(3000);
        self::assertEquals(4000, $this->investor->getVirtualWallet());
    }

    /**
     * Withdraw money from the virtual wallet and check that the withdrawal has occurred as expected
     */
    public function testWithdrawMoneyFromWallet()
    {
        $this->investor->withdrawMoneyFromWallet(500);
        self::assertEquals(500, $this->investor->getVirtualWallet());
    }

    /**
     * Make an investment and check that the investments object can be retrieved
     */
    public function testGetInvestments()
    {
        $loanTranche = new Tranche('A', new Loan(new DateTime("10/01/2020"), new DateTime("11/15/2020")), 3, 1000, 'open');
        $investment = new Investments(10000, $this->investor, $loanTranche, new DateTime("11/1/2020"));
        $this->investor->setInvestments($investment);
        self::assertEquals($investment, $this->investor->getInvestments());
    }
}
