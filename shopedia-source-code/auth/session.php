<?php
include("config.php");

if(!isset($_SESSION)){
    session_start();
}

date_default_timezone_set('Asia/Singapore');

if (!isset($_SESSION['login_user'])) {
    // echo 
    //     '<script type="text/javascript">
    //       window.location = "/auth/login.php"
    //     </script>';
    header("Location:../auth/login.php");
    exit();
} else {
    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db, "select email from users where email = '$user_check' ");
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    $login_session = $row['email'];
}

function randomId($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "Just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one min ago";
        } else {
            return "$minutes mins ago";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hr ago";
        } else {
            return "$hours hrs ago";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "a wk ago";
        } else {
            return "$weeks wks ago";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "a mth ago";
        } else {
            return "$months mths ago";
        }
    }
    //Years
    else {
        if ($years == 1) {
            return "one yr ago";
        } else {
            return "$years yrs ago";
        }
    }
}
