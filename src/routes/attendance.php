<?php


// 个人考勤记录
$app->get('/record/person', function ($request, $response, $args) {

    return $this->view->render('attendance/record_person.html', array());
});

// 个人出勤记录
//$app->get('/attend/person', function ($request, $response, $args) {
//    return $this->view->render('attend_person.html', array());
//});

// 综合考勤记录
$app->get('/record/all', function ($request, $response, $args) {
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
    return $this->view->render('attendance/input_record.html', array());
});

// 出勤信息修改
$app->get('/edit/attendance', function ($request, $response, $args) {
    return $this->view->render('attendance/edit_attendance.html', array());
});

$app->get('/apply/leave', function($request, $response, $args){
    return $this->view->render('attendance/leave_apply.html', array());
});

