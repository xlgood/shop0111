<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 21:47
 */

namespace Admin\Model;


class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel{
    /**
     * DB connect
     *
     * @access public
     *
     * @return resource connection link
     */
    public function connect()
    {
        // TODO: Implement connect() method.
        echo 'connect..';
        exit;
    }

    /**
     * Disconnect from DB
     *
     * @access public
     *
     * @return viod
     */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect..';
        exit;
    }

    /**
     * Free result
     *
     * @access public
     * @param resource $result query resourse
     *
     * @return viod
     */
    public function free($result)
    {
        // TODO: Implement free() method.
        echo 'free..';
        exit;
    }

    /**
     * Execute simple query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return resource|bool query result
     */
    public function query($sql, array $args = array())
    {
        //得到实际传过来的参数
        $parms = func_get_args();
        return M()->execute($this->buildSql($parms));
    }

    /**
     * Insert query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false last insert id
     */
    public function insert($sql, array $args = array())
    {
        $parms = func_get_args();
        $sql = array_shift($parms);
        $table_name = array_shift($parms);
        $sql = str_replace('?T',$table_name,$sql);
        $parms = array_shift($parms);
        $values = '';
        foreach($parms as $k=>$v){
            $values .= $k.'='."'$v'".',';
        }
        $sql = str_replace('?%',$values,$sql);
        //最后执行的sql
        $last_sql = rtrim($sql,',');
        $model = M();
        $result = $model->execute($last_sql);
        if($result===false){
            return false;
        }else{
            //返回最后插入的id
            return $model->getLastInsID();
        }
    }

    /**
     * Update query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false affected rows
     */
    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo 'update..';
        exit;
    }

    /**
     * Get all query result rows as associated array
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo 'getAll..';
        exit;
    }

    /**
     * Get all query result rows as associated array with first field as row key
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo 'getAssoc..';
        exit;
    }

    /**
     * Get only first row from query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array
     */
    public function getRow($sql, array $args = array())
    {
        //得到实际传过来的参数
        $parms = func_get_args();
        //执行最后拼接成的sql
        $rows = M()->query($this->buildSql($parms));
        return empty($rows)?false:$rows[0];
//        echo($last_sql);
//        dump($sqls);
//        dump($parms);
//        exit;
    }

    /**
     * Get first column of query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array one level data array
     */
    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo 'getCol..';
        exit;
    }

    /**
     * Get one first field value from query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return string field value
     */
    public function getOne($sql, array $args = array())
    {
        $parms = func_get_args();
        $last_sql = $this->buildSql($parms);
        $rows = M()->query($last_sql);
        $valus = array_values($rows[0]);
        return $valus[0];
    }

    /**根据传过来的参数拼接sql
     * @param $parms  实际传过来的参数数组
     * @return string 最后可以执行的sql
     */
    private function buildSql($parms){
        //得到参数数组的第一个元素 也就是$sql的值
        $sql = array_shift($parms);
        //用正则表达式通过?F,?T,?N对$sql进行分割
        $sqls = preg_split('/\?[FTN]/',$sql);
        $last_sql = ''; //最终会拼接成可以执行的sql
        foreach($sqls as $k=>$v){
            $last_sql .= $v.$parms[$k];
        }
        return $last_sql;
    }
}