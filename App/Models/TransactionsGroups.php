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

    /**
     * save edited category
     * 
     * @return boolean  True if the category was saved, false otherwise 
     */
    public function save()
    {
        $this->validate();

        if(empty($this->errors)){
        
            $sql = 'UPDATE transactiongroups
                    SET name= :name
                    WHERE id= :id';
            
            $db = static::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->newCategory, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->categoryId, PDO::PARAM_INT);

            return $stmt->execute();
        }
        return false;
    }

     /**
     * Validate new category value, adding validation error messages to the errors array property
     *
     * @return void
     */
	public function validate()
    {
        if($this->newCategory == ''){
            $this->errors[] = 'new category name is required';
        }
    }

    /**
     * remove category from database
     * 
     * @return void
     */
    public function delete()
    {     
            $sql = 'DELETE FROM transactiongroups
                    WHERE id= :id';
            
            $db = static::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $this->categoryId, PDO::PARAM_INT);

            return $stmt->execute();
      
    }

    /**
     * save new category
     * 
     * @return boolean  True if the category was saved, false otherwise 
     */
    public function add()
    {
        $this->validate();

        if(empty($this->errors)){
        
            $sql = 'INSERT INTO transactiongroups (name, type)
                    VALUES (:name, :type)';
            
            $db = static::getDB();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->newCategory, PDO::PARAM_STR);
            $stmt->bindValue(':type', $this->selectType, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }
 }