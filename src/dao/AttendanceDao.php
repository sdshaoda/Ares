<?php
namespace Ares\Dao;

/**
 * Class AttendanceDao
 * 考勤管理相关数据库操作
 */
class AttendanceDao extends BaseDao
{
    /**
     * @param array $config
     * @return AttendanceDao
     */
    public static function getInstance($config = array())
    {

        if(empty(self::$instance)){
            self::$instance = new AttendanceDao($config);
        }
        return self::$instance;
    }

    /**
     *
     */
}
