<?
require_once "INewsDB.class.php";

class NewsDB implements INewsDB {
  const DB_NAME = "../news.db";
  private $_db;

  function saveNews($title, $category, $description, $source) {
    $dt = time();
    $title = $this->_db->escapeString($title);
    $category = $this->_db->escapeString($category);
    $description = $this->_db->escapeString($description);
    $source = $this->_db->escapeString($source);
    $sql = "INSERT INTO msgs (title, category, description, source, datetime)
            VALUES ('$title', '$category', '$description', '$source', '$dt')";
    $result = $this->_db->exec($sql);
    return $result;
  }

  function getNews() {

  }

  function deleteNews($id) {

  }

  function __get($name) {
    if ($name == "db") {
      return $this->_db;
    }
    throw new Exception("Unkown property!");
  }

  function __construct() {
    $this->_db = new SQLite3(self::DB_NAME);
    if (is_file(self::DB_NAME) and filesize(self::DB_NAME) == 0) {
      $sql = "CREATE TABLE msgs(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                category INTEGER,
                description TEXT,
                source TEXT,
                datetime INTEGER
              )";
      $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
      $sql = "CREATE TABLE category(
                id INTEGER,
                name TEXT
              )";
      $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
      $sql = "INSERT INTO category(id, name)
              SELECT 1 as id, 'Политика' as name
              UNION SELECT 2 as id, 'Культура' as name
              UNION SELECT 3 as id, 'Спорт' as name ";
      $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

  }
  function __destruct() {
    unset($this->_db);
  }
}