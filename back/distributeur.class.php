<?php

require_once('inception.class.php');

Class Distributeur extends Inception
{
	public function __construct()
	{
		$this->pk = 'id_distributeur';
		$this->table_name = 'distributeurs';
		$this->fields = ['id_distributeur',
						'nom',
						'telephone',
						'adresse',
						'cpostal',
						'ville',
						'pays'];
	}
}