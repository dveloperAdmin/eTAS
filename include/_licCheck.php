<?php
// session_start();
include "_dbConnect.php";

$myFile = fopen("../src/license.lic", 'r');
$id = "";
for ($i = 1; $i <= 29; $i++) {
    $id .= fgetc($myFile);
}
fclose($myFile);

$theData = file("../src/license.lic");
$id_key = $theData[1];
$db_code = "";
$active_key = sqlsrv_fetch_array(sqlsrv_query($conn, "select * from activationKeyDetails where keyId ='$id_key'"));
if ($active_key != "") {
    $db_code = $active_key['activationKey'];
}

if (password_verify($id, $db_code)) { 
    $ac_date = substr($id, 4, 2) . substr($id, 8, 2) . substr($id, 12, 2) . substr($id, 26, 3);
    $m_date = ($ac_date / 7);
    $date = substr($m_date, 0, 4) . "-" . substr($m_date, 4, 2) . "-" . substr($m_date, 6, 2);

    if (date("Y-m-d") <= $date) {
        $ac_user = substr($id, 16, 2) . substr($id, 20, 2) . substr($id, 24, 2);
        $users = (($ac_user / 12) - 57);
        $nunber_of_emp = sql_num_rows($conn, "select * from employeeDetails");

        $acivation_key_expiry = $active_key['dateOfExpire']->format("Y-m-d");
        $activation_no_of_user = $active_key['noOfUsers'];
        if ($acivation_key_expiry == $date) {
            if ($activation_no_of_user == $users) {
                if ($nunber_of_emp >$users) {
                    $_SESSION['icon_ad'] = 'warning';
                    $_SESSION['status_ad'] = 'Employee Overloaded';
                    header("location: license-About-Ui");
                    exit(); // Add an exit after header to stop script execution
                }
            } else {
                $_SESSION['icon_ad'] = 'warning';
                $_SESSION['status_ad'] = 'Employee Overloaded......';
                header("location: license-About-Ui");
                exit();
            }
        } else {
            $_SESSION['icon_ad'] = 'warning';
            $_SESSION['status_ad'] = 'License Date Expired....... ';
            header("location: license-About-Ui");
            exit();
        }
    } else {
        $_SESSION['icon_ad'] = 'Info';
        $_SESSION['status_ad'] = 'License Date Expired';
        header("location: license-About-Ui");
        exit();
    }
} else {
    session_unset();
    session_destroy();
    header("location: index?i=3");
    exit();
}
?>