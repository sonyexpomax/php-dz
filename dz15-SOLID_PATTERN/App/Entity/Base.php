<?php
namespace App\Entity;
use App\DB\Connection;

abstract class Base
{
   /**
     * @return \mysqli
     */
    public function getConnection()
    {
         $dbHost = 'localhost';
         $dbUser = 'goods';
         $dbPassword = 'goods';
         $dbName = 'goods';
         return mysqli_connect(
            $dbHost,
            $dbUser,
            $dbPassword,
            $dbName
        );
    }

    abstract public function getTableName(): string ;

    abstract protected function checkFields(array $data): bool;

    /**
     * @return array
     */
    public function getMap():array{

        static  $StaticTableFields =[];
        if (isset($StaticTableFields[$this->getTableName()])){
            return $StaticTableFields;
        }
            $TableFields = [];
            $query = "SELECT * FROM {$this->getTableName()}";
            $result = mysqli_query($this->getConnection(), $query);
            $fields = mysqli_num_fields($result);
            for ($i = 0; $i < $fields; $i++) {
                $FieldInfo = mysqli_fetch_field_direct($result, $i);
                if ($FieldInfo->name != 'id') {
                    $TableFields[$FieldInfo->name] = $this->MysqliTypeFields[$FieldInfo->type];
                }
            }
            $StaticTableFields[$this->getTableName()] = $TableFields;
            return $TableFields;
    }
    protected $query1;
    public function __construct(\IConnection $query)
    {
         $this->query1 = $query;
    }

    /**
     * @param int|null $id
     * @return bool|\mysqli_result
     */
    public function get(int $id = null) {
        $where = '';
        if ($id > 0) {
            $where = ' WHERE id = '.$id;
        }
        $query = "SELECT * FROM {$this->getTableName()} $where";
        $result = $this->query1->query($query);
        //$result = Connection::getInstance()->query($query);
        //$result = mysqli_query($this->getConnection(), $query );
        return $result;
    }

    /**
     * @param array $data
     * @return bool|\mysqli_result
     */
    public function create(array $data) {
        if($this->checkFields($data)) {
            foreach ($data as &$val) {
                $val = mysqli_escape_string($this->getConnection(), $val);
            }
            $cols = implode(',', array_keys($data));
            $values = "'" . implode("','", $data) . "'";
            $query = "INSERT INTO {$this->getTableName()} ($cols) VALUES ($values)";
            //return mysqli_query($this->getConnection(), $query);
            //$result = Connection::getInstance()->query($query);
            $result = $this->query1->query($query);
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool|\mysqli_result
     */
    public function update(int $id, array $data) { /* Тут реализация */
        if($this->checkFields($data)) {
            $values = [];
            foreach ($data as $key => $val) {
                $val = mysqli_escape_string($this->getConnection(), $val);
                $values[] = "$key = '$val'";
            }
            $values = implode(',', $values);
            $query = "UPDATE {$this->getTableName()} SET $values WHERE id = $id;";
            //return mysqli_query($this->getConnection(),$query);
            //return Connection::getInstance()->query($query);
            return $this->query1->query($query);
        }
    }

    /**
     * @param int $id
     * @return bool|\mysqli_result
     */
    public function delete(int $id) {
       $query = "DELETE FROM {$this->getTableName()} WHERE id = $id";
       // return  Connection::getInstance()->query($query);
       //return mysqli_query($this->getConnection(), $query);
        return $this->query1->query($query);
    }
}



