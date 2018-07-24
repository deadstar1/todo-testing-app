<!--TODO: (d0ne)show information message or inform the user when the record he/she wants to delete/edit/view does not exist-->
<!--https://stackoverflow.com/questions/44305738/deleting-record-if-it-exists-in-php-pdo-->
<!--https://www.codediesel.com/php/reading-raw-post-data-in-php/-->
<!-- http://coreymaynard.com/blog/creating-a-restful-api-with-php/-->
<!--(cascadingdelete)https://stackoverflow.com/a/1905480/4097674-->
<?php
class Crud{
    protected $serverName;
    protected $userName;
    protected $password;
    protected $conn;
    protected $sql;
    public $stmt;
    protected  $dbName;
    public function __construct()
    {
        try{
            $this->serverName='localhost';
            $this->dbName='test';
            $this->userName='root';
            $this->password="";

            $this->conn=new PDO("mysql:host=$this->serverName;dbname=$this->dbName",$this->userName,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "error: ". $e->getMessage();
        }
    }
    public function __destruct()
    {
    }
    public function dbQuery($query,$params,...$dbinfo):array {
        $result=$this->executeWithParams($query,$params);
        return $result;

    }
    //http://www.phpfunctionoftheday.com/php-pdo-dynamic-parameter-binding/
    private function executeWithParams($query,$params):array {
        if(empty($query)){
            throw new Exception('SQL STATEMENT IS MISSING');
        }
        else if(!is_array($params)){
            throw new Exception('PARAMS IS NOT AN ARRAY');
        }
        $this->stmt=$this->conn->prepare(($query));

        foreach($params as $param=> &$value){
            $this->stmt->bindParam($param,$value);
        }
        $this->stmt->execute();
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        //the fetch and rowcount should be returned
        $records='nothing to display';
        try{
            $records=$this->stmt->fetchAll();
        }
        catch (PDOException $e){
            //
        }
        $rowcount=$this->stmt->rowCount(); //tells if the record exist.
        echo $rowcount;
        $columnCount=$this->stmt->columnCount();
        $results=array('record'=>$records,
            'rowcount'=>$rowcount,
            'columnCount'=>$columnCount);
        return $results;
    }

}

// https://stackoverflow.com/a/21361262/4097674
//mysqli->fetch_array vs mysqli->fetch_assoc

