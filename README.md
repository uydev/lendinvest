# LendInvest Coding Test  
Thank you for your interest in LendInvest. In this stage of the recruitment journey, you're going to code (the fun part!).  

## Exercise  
At LendInvest we think everyone should have the opportunity to invest in property, which is why we’re looking to disrupt the status quo. This involves lending and investing without the banks. Mortgages simplified! We connect people who want to invest their money, with investments to those who want to borrow.  
One of the important parts of our business is to give our investors a way to invest in a loan and earn a return (monthly interest payment).  

## Model
- Each of our loans has a start date and an end date. 
- Each loan is split into multiple tranches. 
- Each tranche has a different monthly interest percentage. 
- Also, each tranche has a maximum amount available to invest. So once the maximum is reached, further investments can't be made in that tranche. 
- As an investor, I can invest in a tranche at any time if the loan is still open, if the maximum available amount is not reached and I have enough money in my virtual wallet. 
- At the end of the month we need to calculate the interest each investor is due to be paid.

## Scenario
- Given a loan (start 01/10/2020 end 15/11/2020). 
- Given the loan has 2 tranches called **A** and **B** **3%** and **6%** monthly interest rate) each with **1,000** pounds amount available. 
- Given each investor has **1,000** pounds in their virtual wallet. 
- **Investor 1** would like to invest **1,000** pounds on the tranche **A** on **03/10/2020**: this is allowed and the software should go on without errors. 
- **Investor 2** would  like to invest **1** pound on the tranche **A** on **04/10/2020**: the maximum amount for the tranche A is 1000 so investor 2 should not be allowed to invest 
- **Investor 3** would like to invest **500** pounds on the tranche **B** on **10/10/2020**: this is allowed and the software should go on without errors 
- **Investor 4** would like to invest **1,100** pounds on the tranche **B** **25/10/2020**: the investor 4 does not have enough money to invest the requested amount, and the tranche is smaller than the amount requested. 
- On **01/11/2020** the system runs the interest calculation for the period **01/10/2020** -> **31/10/2020**: 
    - **Investor 1** receives **28.06** pounds in their wallet 
    - **Investor 3** receives **21.29** pounds in their wallet

## What we care about  
Working code is not our only priority, we aim to write maintainable, clear to read and testable code. So please:
- Use **OOP** at your best and implement it keeping **SOLID** principles in mind, using - if necessary and appropriate - design patterns, inheritance and all the nice features that **OOP** makes available and may serve your purpose, **without over-engineering** your solution 
- Write **unit tests,** we use PHPUnit, but feel free to use the tool you’re most familiar with. 
- Write **tests** for the provided **scenarios

## How you can solve the challenge:
- We don’t need interactions with any database, don’t bother with it  
- Use plain php, this challenge is about software design, OOP and coding style not about knowledge of a specific framework  


## Some Hints for the coding challenge:  

#### The investor earnings are calculated as follows:

```  
Daily interest rate = Interest rate / Days in a month
```

```
Invested period interest rate = Daily interest rate * Days invested 
```

```
Earned interest = Invested amount / 100 * Invested period interest rate (1)
(1) for instance, for investor1 it’s from the 3/10/2020 (included) to the end of month, so 31/10/2020
```

## How to send us the challenge  
Please, don’t publish your solution on Github, Bitbucket etc. Rather create a Git bundle and send it via email (this is important to us):  

#### The command to create a Git bundle for a `master` branch is :

```
git bundle create lendinvest-test-YOURNAME.bundle master  
```
#### To clone it  (may you want to double check everything is bundled):
```  
git clone lendinvest-test-YOURNAME.bundle  -b master
``` 
