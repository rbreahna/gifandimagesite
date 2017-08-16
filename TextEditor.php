<?php
date_default_timezone_set('Europe/Bucharest');

class Database {
	private $DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
	private $DB_USER = 'root';
	private $DB_PASSWORD = '';
	private $DB_NAME = 'camagru';
	private $DB_HOST = "mysql:host=localhost;charset=utf8";
    private static $instance = null;
    private $pdo;
    private function __construct()
    {
    	try 
    	{
        $this->pdo = new PDO($this->DB_DSN, $this->DB_USER, $this->DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		catch(PDOException $e)
		{
		echo "Something went wrong  ";
		echo $e->getMessage();
		}
    }

    public static function get()
    {
        if(is_null(self::$instance))
        self::$instance = new Database();
        return self::$instance;
    }

    public function getPDO()
    {
    	return $this->pdo;
    }
}


class TextEditor
{
private $db;

    function __construct()
    {
        $this->db = Database::get();
    }

	public function getText($id)
	{
		$result = $this->db->getPDO()->prepare("SELECT tag_text FROM texts WHERE tag_id = :tag_id");
		$result->execute(array("tag_id"=>$id));
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$text = $row['tag_text'];
		return($text);
	}

	public function setText($id, $text)
	{
		$result = $this->db->getPDO()->prepare("UPDATE texts SET tag_text = :tag_text, c_time = now(3) WHERE tag_id = :tag_id");
		$result->execute(array("tag_id"=>$id, "tag_text"=>$text));
	}
}
?>