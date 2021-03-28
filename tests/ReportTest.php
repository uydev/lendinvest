<?php
namespace Lendinvest\Tests;

use Lendinvest\Entity\Investor;
use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Report;
use Lendinvest\Entity\Tranche;
use Lendinvest\Entity\MakeInvestment;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class ReportTest
 * @package Lendinvest\Tests
 */
class ReportTest extends TestCase
{
    protected function setUp(): void
    {
        $startDate = new DateTime("10/01/2020");
        $endDate = new DateTime("11/15/2020");
        $loan = new Loan($startDate, $endDate);
        $tranche = new Tranche('A', $loan, 3, 1000, 'open');
        $this->investor1 = new Investor(10001, 'Investor1', 1000);
        $investment1 = new MakeInvestment($this->investor1, $tranche, 1000, new DateTime("10/03/2020"));
        $investment1->makeInvestment();
    }

    /**
     * Tests Investor 1 and returns virtual wallet amount
     * after the return on investment has been added
     */
    public function testInvestor1()
    {
        $report = new Report();
        $report->calculate();
        self::assertEquals(1028.06, $this->investor1->getVirtualWallet());
    }
}
