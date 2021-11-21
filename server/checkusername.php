<?php
$takenUsernames = array("darknon123", "root", "test", "darknon1234");
sleep(1);
if (!in_array($_GET["username"], $takenUsernames)) {
    echo "okay";
} else {
    echo "denied";
}
