<?php

namespace Anax\MVC;

use	\Anax\DI\IInjectionaware,
	\Anax\DI\TInjectable;

/**
 * Base class for Models
 *
 */

 class CDataBaseModel implements IInjectionaware
 {

 	use TInjectable;

 	/**
 	 *	Get the table name from the name of the model class
 	 *
 	 * @return string table name
 	 */

 	public function getSource()
 	{
 		return strtolower(implode('', array_slice(explode('\\', get_class($this)), -1)));
 	}


 	/**
 	 * Get all elements
 	 *
 	 * @return all elements in array
 	 */
 	public function findAll() 
 	{

 		// Sets selection criteria and table name
 		$this->db->select()->from($this->getSource());

 		// Execute the query
 		$this->db->execute();

 		// Sets the format we want the result delivered in
 		$this->db->setFetchModeClass(__CLASS__);

 		return $this->db->fetchAll();
 	}

 	/**
 	 * Get an element with the specified id
 	 *
 	 * @param the id of the object to search for
 	 *
 	 * @return
 	 */
 	public function find($id = null)
 	{

 		$this->db->select()->from($this->getSource())->where('id = ?');

 		// Execute the query
 		$this->db->execute([$id]);

 		// Populates the "$this"-object with data and returns it
 		return $this->db->fetchInto($this);
 	}

 	/**
 	 * Create a new row in the database table
 	 *
 	 * @param values (array) to be saved
 	 *
 	 * @return true or false depending on the success of the operation
 	 */
 	public function create($values)
 	{

 		$keys = array_keys($values);
 		$vals = array_values($values);

 		$this->db->insert($this->getSource(), $keys, $vals);

 		$result = $this->db->execute();

 		// Creates id property
 		$this->id = $this->db->lastInsertId();

 		return $result;
 	}

 	/**
 	 * Updates stored information
 	 * 
 	 * @param values (array) to be saved
 	 *
 	 * @return true or false depending on the success of the operation
 	 */
 	public function update($values)
 	{
 		//Removes 'id', since you should not update it
 		unset($values['id']);
		
		$keys = array_keys($values);
 		$vals = array_values($values);

 		// Adds the id value to the array, to be used in "WHERE id = ?"
	    $vals[] = $this->id;

 		$this->db->update($this->getSource(), $keys, 'id = ?');
 		
 		return $this->db->execute($vals);
 	}


 	/**
 	 * Insert a new user or Update an existing user
 	 *
 	 * @param
 	 *
 	 * @return 
 	 */
 	public function save($values = [])
 	{
 		// Adds values to the $this object (as properties)
 		$this->setProperties($values);

 		// Collects all properties from the $this object
 		$values = $this->getProperties();

 		if (isset($values['id']))
 		{
 			return $this->update($values);
 
 		} else {

 			return $this->create($values);
 		}
 	}


 	/**
 	 * Delete object from database
 	 *
 	 * @param user id
 	 *
 	 * @return 
 	 */
 	public function delete($id = null)
 	{

 		$this->db->delete($this->getSource(), 'id = ?');

 		return $this->db->execute([$id]);
 	}

 	/**
 	 * Build select part
 	 *
 	 * @param string showing which columns to select in the database
 	 *
 	 * @return $this (for chaining)
 	 */
 	public function query($columns = '*')
 	{
 		$this->db->select($columns)->from($this->getSource());
 
	    return $this;
 	}


 	/**
 	 * Build where part
 	 *
 	 * @param string with condition
 	 *
 	 * @return $this (for chaining)
 	 */
	public function where($condition)
	{
		$this->db->where($condition);

		return $this;
	}


	/**
	 * Build the +where part.
	 *
	 * @param string with condition
	 *
	 * @return $this (for chaining)
	 */
	public function andWhere($condition)
	{
		$this->db->andWhere($condition);

		return $this;
	}


	/**
	 * Execute query
	 *
	 * @param array with query
	 *
	 * @return the result
	 */
	public function execute($params = [])
	{
    	$this->db->execute($this->db->getSQL(), $params);
    	$this->db->setFetchModeClass(__CLASS__);
 
    	return $this->db->fetchAll();
	}


	/**
	 * Build delete query
	 *
	 * @param where statement
	 *
	 * @return $this (for chaining)
	 */
	public function deleteWhere($where = null)
	{
		$this->db->delete($this->getSource(), $where);

		return $this;
	}


	/**
 	 * Sets the object's properties
 	 *
 	 * @param key value array
 	 */
 	public function setProperties($values)
 	{
 		if (!empty($values)) {

			foreach ($values as $key => $value) {
				
				$this->$key = $value;
			}
 		}
 	}


	/**
     * Get the object's properties
     *
     * @return all the properties as array except di and db
     *
     */
    public function getProperties()
    {
        // Get the object's properties
        $properties = get_object_vars($this);

        // Removes the 'di' and 'db' properties
        unset($properties['di']);
        unset($properties['db']);

        return $properties;
    }

 }