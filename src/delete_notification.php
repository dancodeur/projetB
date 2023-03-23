<?php

include("function/f_notification.php");

$id_message=$_GET['id'];

notification_delete($id_message);
