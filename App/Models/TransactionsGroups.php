<?php

namespace App\Models;

use PDO;
use \Core\View;

/**
 * Transactions groups model
 */

 class TransactionsGroups extends \Core\Model
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
     * Get incomes Groups
     * 
     * @return mixed rows with group id and name, false otherwise
     */
    public static function getIncomesGroups()
    {
        $sql = 'SELECT id, name 
                FROM  transactiongroups
                WHERE type =:type';
        
        $db = static::getDB();
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':type', 'Income', PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get expenses Groups
     * 
     * @return mixed rows with group id and name, false otherwise
     */
    public static function getExpensesGroups()
    {
        $sql = 'SELECT id, name 
                FROM  transactiongroups
                WHERE type =:type';
        
        $db = static::getDB();
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':type', 'Expense', PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }

       /**
     * get transactions groups
     * 
     * @return rows with group id, name and type 
     */
    public static function getAllGroups()
    {
        $sql = 'SELECT * FROM transactiongroups';
        
        $db = static::getDB();
        
        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
 }