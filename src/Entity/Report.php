<?php
namespace Lendinvest\Entity;

/**
 * Class Report
 * @package Lendinvest\Entity
 */
class Report
{
    //This includes the array of investors and their investments
    private $investments = [];

    /**
     * Report constructor.
     */
    public function __construct()
    {
        $this->investments = Investments::$instances;
    }

    /**
     * Calculate Return On Investment
     * Display onscreen report
     */
    public function calculate()
    {
        foreach ($this->investments as $key => $investment) {
            $this->investments[$key]->calculateROI();
            echo "\n-------------------------------------------------------------";
            echo "\nInvestor Name:" . $investment->getInvestor()->getFullname();
            echo "\nWallet:" . $this->investments[$key]->getInvestor()->getVirtualWallet();
            echo "\nInvestment Amount:" . $this->investments[$key]->getAmount();
            echo "\nDate of Investment:" . $this->investments[$key]->getDate()->format('m-d-Y');
            echo "\nTranche invested in:" . $this->investments[$key]->getTranche()->getTrancheId();
            echo "\nMonthly Interest Rate:" . $this->investments[$key]->getTranche()->getMonthlyInterestRate() . '%';
            echo "\nLoan active from:" . $this->investments[$key]->getTranche()->getLoan()->getStartDate()->format('m-d-Y') .
                " to " . $this->investments[$key]->getTranche()->getLoan()->getStartDate()->format('m-d-Y') ." (mm/dd/YYYY)";
            echo "\n";
        }
    }
}
