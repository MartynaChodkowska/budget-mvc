<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\TransactionsGroups;

/**
 * Categories controller
 */

class Categories extends Authenticated
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
      * Show categories panel page
      *
      *@return void
      */
      public function panelAction()
      {
          View::renderTemplate('Categories/panel.html');
      }

    /**
     * Get transactions categories and pass it to categories review
     * 
     * @return void
     */
      public function reviewAction()
      {
          $incomesCategories = TransactionsGroups::getIncomesGroups();
          $expensesCategories = TransactionsGroups::getExpensesGroups();

          View::renderTemplate('Categories/review.html',[
              'incomesCategories'   => $incomesCategories,
              'expensesCategories'  => $expensesCategories
          ]);
      }

}