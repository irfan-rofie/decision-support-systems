<?php

function grade_convert($ranking) {
    if ($ranking > 0.85) {
        $grade = 'A';
    } elseif ($ranking > 0.75) {
        $grade = 'B';
    } elseif ($ranking > 0.65) {
        $grade = 'C';
    } elseif ($ranking > 0.50) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }
    return $grade;
}

function level_convert($level){
    if ($level == 0) {
        return "HRD";
    } else if ($level == 1) {
        return "Supervisor";
    } else {
        return "Manager";
    }
}
?>

