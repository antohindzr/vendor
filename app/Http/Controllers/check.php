<?php

$input = $req->validate([
    'vendorID' => 'required|integer|gt:0',
    'serial' => 'required|string|min:10|max:10',
]);
$vendorID = $input['vendorID'];
$serialRaw = $input['serial'];

switch ($vendorID) {
    case 1:
        $maskPattern = '/(^[A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2}$)/';
        break;
    case 2:
        $maskPattern = '/(^[0-9]{1}[A-Z0-9]{2}[A-Z]{2}[A-Z0-9]{1}[(-|_|@)]{1}[A-Z0-9]{1}[a-z]{2}$)/';
        break;
    case 3:
        $maskPattern = '/(^[0-9]{1}[A-Z0-9]{2}[A-Z]{2}[A-Z0-9]{1}[(-|_|@)]{1}[A-Z0-9]{3}$)/';
        break;
}

preg_match($maskPattern, $serialRaw, $matches);