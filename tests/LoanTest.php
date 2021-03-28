<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Loan;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Class LoanTest
 * @package Lendinvest\Tests
 */
class LoanTest extends TestCase
{
    private $startDate;

    private $endDate;

    private $loan;

    /**
     * Setup everything and initialize the Loan object
     */
    protected function setUp(): void
    {
        $this->startDate = new DateTime("10/01/2020");
        $this->endDate = new DateTime("11/15/2020");
        $this->loan = new Loan($this->startDate, $this->endDate);
    }

    /**
     * Get the start date for the loan and check that it matches the expected start date
     */
    public function testGetStartDate()
    {
        self::assertEquals($this->startDate, $this->loan->getStartDate());
    }

    /**
     * Set the start date and check that the start date has been updated and matching the expected value
     */
    public function testSetStartDate()
    {
        $this->loan->setStartDate(new DateTime("01/01/2021"));
        self::assertEquals(new DateTime("01/01/2021"), $this->loan->getStartDate());
    }

    /**
     * Get the end date for the loan and check that it matches the expected end date
     */
    public function testGetEndDate()
    {
        self::assertEquals($this->endDate, $this->loan->getEndDate());
    }

    /**
     * Set the end date and check that the end date has been updated and matching the expected value
     */
    public function testSetEndDate()
    {
        $this->loan->setEndDate(new DateTime("01/02/2021"));
        self::assertEquals(new DateTime("01/02/2021"), $this->loan->getEndDate());
    }

}
