<?php

if(isset($_POST['generate'])) {

    $passGenerate = md5($_POST['passGenerate']);

    echo $passGenerate;

}