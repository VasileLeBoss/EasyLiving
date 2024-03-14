<?php
class ConnexionDB_lecture extends ConnexionDB 
{
    // Informations de connexion
    private  static $dbUser = 'lecture';
    private  static $dbPassword = 'd7h7WbQ7UMb75k';



    protected function __construct() // crée la connexion
    {
        // Data Source Name
        $dsn = 'mysql:dbname='.self::$dbName . ';host=' . self::$dbHost;

        
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
            self::$maConnexion=new ConnexionDB_lecture();   
			self::$typeInstance = 'lecture';
        }
		else 
		{
			if(self::$typeInstance != 'lecture') // si ce n'est pas lecture
			{
				self::$maConnexion = null; // détruit l'instance existante
				self::$maConnexion=new ConnexionDB_lecture();   // recrée en lecture
				self::$typeInstance = 'lecture';
			}
		}
        return self::$maConnexion;
    }
}