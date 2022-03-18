<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Models\Transactions;
use \App\Auth;
use \App\Date;

/**
 * Balance sheet controler
 */

 class Balancesheet extends Authenticated
 {
    
    private $action = NULL;
    
    /**
     * Before filter - called before each action method
     *
     * @return void
     */
    protected function before()
    {
        parent::before();
        
        $this->user = Auth::getUser();
    }

    /**
     * set action to display appropriate balancesheet headline
     */
    /*public static function setaction($actionToSet)
    {
        $action = $actionToSet;
        
    }*/

    /**
     * get action to display appropriate balancesheet headline
     */
    /*public static function getaction()
    {
        return $action;
    }*/

    /**
     * get current month data and pass it to getTransaction function to get rows from given period
     * 
     * @return void
     */
    public function currentmonthAction()
    {
        $start = Date::getfirstDayOfCurrentMonth();
        $end = Date::getLastDayOfCurrentMonth();
        
       //$this->setAction('current month');
        $this->getTransactions($start, $end);

    }

     /**
     * get previous month data and pass it to getTransaction function to get rows from given period
     * 
     * @return void
     */
    public function previousmonthAction()
    {
        $start = Date::getfirstDayOfPreviousMonth();
        $end = Date::getLastDayOfPreviousMonth();

        $this->getTransactions($start, $end);

    }

    /**
     * get current year data and pass it to getTransaction function to get rows from given period
     * 
     * @return void
     */
    public function currentyearAction()
    {
        $start = Date::getFirstDayOfCurrentYear();
        $end = Date::getLastDayOfCurrentYear();

        $this->getTransactions($start, $end);

    }

    /**
     * get previous year data and pass it to getTransaction function to get rows from given period
     * 
     * @return void
     */
    public function previousyearAction()
    {
        $_SESSION['title']="Previous year";
        $start = Date::getFirstDayOfPreviousYear();
        $end = Date::getLastDayOfPreviousYear();

        $this->getTransactions($start, $end);

    }

    /**
     * Get transactions with given data and pass it to the view
     * 
     * @param $start, $end string
     * 
     * @return void
     */
    public function getTransactions($start, $end)
    {
        $incomes = Transactions::getIncomes($start, $end);
        $totalIncomes = $this->getTotalIncomeAmount($incomes);
        $expenses = Transactions::getExpenses($start, $end);
        $totalExpenses = $this->getTotalExpenseAmount($expenses);

        View::renderTemplate('Balancesheet/balancesheet.html', [
            'incomes' => $incomes,
            'totalIncomes' => $totalIncomes,
            'expenses' => $expenses,
            'totalExpenses' => $totalExpenses
        ]);
    }

    /**
     * Get total amount of incomes rows
     * 
     * @param $incomes transaction model
     * 
     * @return mixed 0 if no incomes, float otherwise
     */
    public function getTotalIncomeAmount($incomes)
    {
        $totalIncomeAmount = 0;
        foreach($incomes as $income){
            $totalIncomeAmount+=$income->totalAmount;
        }
        return $totalIncomeAmount;
    }

     /**
     * Get total amount of expenses rows
     * 
     * @param $expenses transaction model
     * 
     * @return mixed 0 if no expenses, float otherwise
     */
    public function getTotalExpenseAmount($expenses)
    {
        $totalExpenseAmount = 0;
        foreach($expenses as $expense){
            $totalExpenseAmount+=$expense->totalAmount;
        }
        return $totalExpenseAmount;
    }
 }