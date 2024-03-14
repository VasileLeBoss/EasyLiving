<?php
class ConnexionDB_ecriture extends ConnexionDB 
{
    // Informations de connexion
    private  static $dbUser = 'ecriture';
    private  static $dbPassword = 'k77UQ5M7h7dWbb';

    protected function __construct() // crée la connexion
    {
        // Data Source Name
        $dsn = 'mysql:dbname='.self::$dbName . ';host=' . self::$dbHost;

        // On appelle le constructeur de la classe PDO
        try
		{
			$this->monPDO = new PDO($dsn, self::$dbUser, self::$dbPassword );
			$this->monPDO->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
			$this->monPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$this->monPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $e) // si erreur de connexion
		{
            die($e->getMessage());
        }
    }

   public static function ouvreConnexion()
   {
        if (is_null(self::$maConnexion)) // si pas de connexion
		{
            self::$maConnexion=new ConnexionDB_ecriture();   
			self::$typeInstance = 'ecriture';
        }
		else // une connexion existe mais de quel type ?
		{
			if(self::$typeInstance != 'ecriture') // si ce n'est pas ecriture
			{
				self::$maConnexion = null; // détruit l'instance existante
				self::$maConnexion=new ConnexionDB_ecriture();   // recrée en ecriture
				self::$typeInstance = 'ecriture';
			}
		}
        return self::$maConnexion;
   }
 }