<?php

$cv = $_GET['cv'];
header("Content-disposition: attachment; filename=".$_GET['name']);
header("content-type: x/y\n");
readfile("../filesCv/".$_GET['name']);



