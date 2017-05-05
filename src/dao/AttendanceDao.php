<?php

namespace Ares\Dao;

/**
 * Class AttendanceDao
 * 考勤管理相关数据库操作
 */
class AttendanceDao extends BaseDao
{
    /**
     * 单例模式，返回唯一的实例化AttendanceDao对象
     * @param array $config
     * @return AttendanceDao
     */
    public static function getInstance($config = array())
    {

        if (empty(self::$instance)) {
            self::$instance = new AttendanceDao($config);
        }
        return self::$instance;
    }


    /**
     * 增量更新打卡数据
     * @param $record array
     */
    public function incrementalUpdateRecords($records = array())
    {
        $sql = "SELECT USERID, NAME FROM USERINFO";
        try {
            // 通过 ODBC 连接 Access 数据库
            $conn = odbc_connect("DRIVER={MDBTools};DBQ=/var/www/windows/att2000.mdb", '', '');

            // 查询 Access 数据库 USERINFO 表中的信息
            $result = odbc_exec($conn, $sql);
            if ($result) {
                while ($res = odbc_fetch_array($result)) {
                    $s = "INSERT INTO access_userinfo (user_id, user_name) VALUES ({$res['USERID']}, {$res['NAME']})";
                    $r = $this->dbh->exec($s);
                    if (!$r) {
                        echo "wrong!";
                        // TODO 事务回滚
                        die();
                    }
                }
            }
            odbc_close($conn);
        } catch (\PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    /**
     * 写入考勤状态
     */
    public function writeAttends($attends = array())
    {

    }

    /**
     * 更改打卡数据
     */
    public function updateRecord($userId, $date, $newRecord)
    {

    }


    /**
     * 更改考勤状态
     */
    public function updateAttend($userId, $date, $newAttend)
    {

    }
}
