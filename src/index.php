<?php
/**
 * Just an extra file that was used for further testing.
 * Will need to uncomment lines in MakeInvestment.php on
 * Line 55
 * Lines 84 - 87
 */
namespace Lendinvest;
require_once __DIR__ . '/../vendor/autoload.php';

use Lendinvest\Entity\Investor;
use Lendinvest\Entity\Loan;
use Lendinvest\Entity\Tranche;
use Lendinvest\Entity\Report;
use Lendinvest\Entity\MakeInvestment;
use DateTime;

$startDate = new DateTime("10/01/2020");
$endDate = new DateTime("11/15/2020");

//Initialize Loan
$loan = new Loan($startDate, $endDate);

//Initialize Tranches
$loanTrancheA = new Tranche('A', $loan, 3, 1000,  'open');
$loanTrancheB = new Tranche('B', $loan, 6, 1000,  'open');

//Initialize Investors
$investor1 = new Investor(10001, 'Investor1', 1000);
$investor2 = new Investor(10002, 'Investor2', 1000);
$investor3 = new Investor(10003, 'Investor3', 1000);
$investor4 = new Investor(10004, 'Investor4', 1000);

//Initialize the Investments
$investment1 = new MakeInvestment($investor1, $loanTrancheA,1000, new DateTime("10/03/2020"));
$investment2 = new MakeInvestment($investor2, $loanTrancheA,1, new DateTime("10/04/2020"));
$investment3 = new MakeInvestment($investor3, $loanTrancheB,500, new DateTime("10/10/2020"));
$investment4 = new MakeInvestment($investor4, $loanTrancheB,1100, new DateTime("10/25/2020"));

//Make Investment
$investment1->makeInvestment();
$investment2->makeInvestment();
$investment3->makeInvestment();
$investment4->makeInvestment();

$report = new Report();
$report->calculate();

echo "\nInvestor1 Wallet:" . $investor1->getVirtualWallet();
echo "\nInvestor2 Wallet:" . $investor2->getVirtualWallet();
echo "\nInvestor3 Wallet:" . $investor3->getVirtualWallet();
echo "\nInvestor4 Wallet:" . $investor4->getVirtualWallet();
echo "\n";
