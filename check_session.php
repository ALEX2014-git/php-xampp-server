<?php
session_start();


if(isset($_SESSION['username'])) {

    echo json_encode(array("username" => $_SESSION['username']));
} else {

    echo json_encode(array("username" => null));
}
?>