<?php
/**
 * 考勤管理中的相关路由
 */

// 个人考勤记录
$app->get('/record/person', function ($request, $response, $args) {
    // TODO 无查询参数，默认获取200条最近的个人考勤数据；分页，根据查询参数 page 切换页面
    return $this->view->render('attendance/record_person.html', array());
});

// 个人出勤记录
//$app->get('/attend/person', function ($request, $response, $args) {
//    return $this->view->render('attend_person.html', array());
//});

// 综合考勤记录
$app->get('/record/all', function ($request, $response, $args) {
    if (!empty($_GET['date'])) {
        // TODO 获取当日所有的考勤数据
        return $this->view->render('attendance/record_all.html', array());
    } elseif (!empty($_GET['staff'])) {
        // TODO 无查询参数，获取200条最近的某人的考勤数据；分页，根据查询参数 page 切换页面
        return $this->view->render('attendance/record_all.html', array());
    }

    // TODO 获取200条最近考勤数据
    return $this->view->render('attendance/record_all.html', array());
});

// 综合出勤记录
//$app->get('/attend/all', function ($request, $response, $args) {
//    return $this->view->render('attend_all.html', array());
//});

// 考勤申请
$app->get('/attendance/apply', function ($request, $response, $args) {
    return $this->view->render('attendance/attendance_apply.html', array());
});

// 考勤审核
$app->get('/attendance/verify', function ($request, $response, $args) {
    return $this->view->render('attendance/attendance_verify.html', array());
});

// 打卡信息录入
$app->get('/input/record', function ($request, $response, $args) {
    // TODO 导入数据，写入到数据库，生成原始考勤信息；需要同时保存原始数据和修改数据
    return $this->view->render('attendance/input_record.html', array());
});

// 出勤信息修改
$app->get('/edit/attendance', function ($request, $response, $args) {
    // TODO 修改考勤信息
    return $this->view->render('attendance/edit_attendance.html', array());
});

// 请假申请
$app->get('/apply/leave', function ($request, $response, $args) {
    return $this->view->render('attendance/leave_apply.html', array());
});

$app->post('/apply/leave', function ($request, $response, $args) {
    // TODO 将申请写入数据库
    return $this->view->render('attendance/leave_apply.html', array());
});

// 加班申请
$app->get('/apply/overtime', function ($request, $response, $args) {
    return $this->view->render('attendance/overtime_apply.html', array());
});

$app->post('/apply/overtime', function ($request, $response, $args) {
    // TODO 将申请写入数据库
    return $this->view->render('attendance/overtime_apply.html', array());
});

// 外出办公申请
$app->get('/apply/travel', function ($request, $response, $args) {
    return $this->view->render('attendance/travel_apply.html', array());
});

$app->post('/apply/travel', function ($request, $response, $args) {
    // TODO 将申请写入数据库
    return $this->view->render('attendance/travel_apply.html', array());
});

// 补卡申请
$app->get('/apply/remedy', function ($request, $response, $args) {
    return $this->view->render('attendance/remedy_apply.html', array());
});

$app->post('/apply/remedy', function ($request, $response, $args) {
    // TODO 将申请写入数据库
    return $this->view->render('attendance/remedy_apply.html', array());
});
