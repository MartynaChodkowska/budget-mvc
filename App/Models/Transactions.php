<?php

namespace App\Models;

use PDO;
use \Core\View;


/**
 * Transactions model
 */

 class Transactions extends \Core\Model
 {
    	
	/**
     * Class constructor
	 *
	 * @param array $data Initial property values
     *
     * @return void
     */
    public function __construct($data = [])
	{
		foreach($data as $key => $value){
			$this->$key = $value;
		};
	}   

    /**
     * Save the transaction model with the current property values
     * 
     * @return boolean  True if the transaction was saved, false otherwise
     */
    public function save()
    {
        $this->validate();

        if(empty($this->errors)){

            $sql = 'INSERT INTO transactions (userId, amount, transactionGroup, transactionType, comment) 
                    VALUES (:userId, :amount, :transactionGroup, :transactionType, :comment)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':transactionGroup', $this->selectMenu, PDO::PARAM_STR);
            $stmt->bindValue(':transactionType', $this->transactionType, PDO::PARAM_STR);
            $stmt->bindValue(':comment', $this->comment, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }


    /**
     * Validate current property values, adding validation error messages to the errors array property
     *
     * @return void
     */
	public function validate()
    {
        //Amount
        if ($this->amount == ''){
            $this->errors[] = 'Transaction amount is required';
        }

        //date
        if ($this->date == ''){
            $this->errors[] = 'Transaction date is required';
        }

        //category
        if ($this->selectMenu == ''){
            $this->errors[] = 'Transaction category is required';
        }
    }
 }