<?php

namespace Ares\Dao;

/**
 * Class UserDao
 * 现在暂时不做
 */
class UserDao extends BaseDao
{
    /**
     * @param array $config
     * @return UserDao
     */
    public static function getInstance($config = array())
    {

        if (empty(self::$instance)) {
            self::$instance = new UserDao($config);
        }
        return self::$instance;
    }

    /**
     * 创建新部门
     */
    public function createDepartment()
    {
    }

    /**
     * 获取部门信息
     */
    public function getAllDepartmentInfos()
    {
    }

    /**
     * 创建新用户
     */
    public function createUser()
    {

    }

    /**
     * 登录验证
     * @param $username
     * @param $password
     * @return mixed
     */
    public function loginCheck($username, $password)
    {
        $sql = 'SELECT * FROM `user_userprofile` WHERE `username`=:username AND `password`=:password';
        $password = md5($password);
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            if ($stmt->execute()) {
                $users = $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                $users = false;
            }
        } catch (\PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $users;
    }


    /**
     * 获取所有用户的信息
     * @return array
     */
    public function getAllUserInfos()
    {
        $sql = 'SELECT d.name AS department_name, u.id, u.username, u.name, u.sex, u.position
FROM `department` AS d
INNER JOIN `user_userprofile` AS u
ON d.id=u.department_id;';
        try {
            $stmt = $this->dbh->query($sql);
            $userInfos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $userInfos;
    }
}
