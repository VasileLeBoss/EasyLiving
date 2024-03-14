<?php
abstract class ConnexionDB 
{
    // Informations de connexion
    protected static $dbHost = 'localhost';
	protected static $dbName = 'vb_gsb_2';
	protected static $maConnexion;           //singleton à partir de $monPDO ;
    protected static $typeInstance ;    //type d'instance
	protected $monPDO ; // ne peut pas être statique car PDO n'est pas statique

    abstract protected function __construct(); // crée la connexion
    abstract public static function ouvreConnexion();


	public function get_monPDO() //
	{
		return $this->monPDO;
	}
}

?>