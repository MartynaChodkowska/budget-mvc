<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Models\Transactions;
use \App\Auth;

/**
 * Budget controller
 * 
 * PHP version 7.0
 */

 class Transaction extends Authenticated
 {
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
      * Show the budget panel page
      *
      *@return void
      */
      public function panelAction()
      {
          View::renderTemplate('Transaction/panel.html');
      }

      /**
       * Show the add income page
       * 
       * @return void
       */
         public function addincomeAction()
        {
            View::renderTemplate('Transaction/addIncome.html');
        }

        /**
         * Show the add expense page
         * 
         * @return void
         */
        public function addexpenseAction()
        {
            View::renderTemplate('Transaction/addExpense.html');
        }

        /**
         * Save new transaction
         * 
         * @return void
         */
        public function createAction()
        {
            $transaction = new Transactions($_POST);

            if ($transaction->save())
            {
                $this->redirect('/');
            } else {
                View::renderTemplate('Transaction/panel', [
                    'transaction' => $transaction
                ]);
            }
        }

}