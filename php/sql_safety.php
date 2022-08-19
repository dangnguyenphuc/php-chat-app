<?php
function safeQuery(mysqli $db, string $sql, array $params = []): ?array {
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result->fetch_all(MYSQLI_BOTH);
    }
    return null;
}

function getRes(mysqli $db, string $sql, array $params = []): ?array {
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result;
    }
    return null;
}

function numRows(mysqli $db, string $sql, array $params = []) {
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }
    $stmt->execute();
    $stmt->store_result();  
    $result = $stmt->num_rows;

    return $result;
}

function fetchAssoc(mysqli $db, string $sql, array $params = []) {
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result->fetch_assoc();
    }
    return null;
}

function allsafeQuery(mysqli $db, string $sql,array $bind =[], array $params = []): ?array {
    $bind_type ="";
    foreach($bind as $ch){
        $bind_type .=$ch;
    }
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param($bind_type, ...$params);
    }
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result->fetch_all(MYSQLI_BOTH);
    }
    return null;
}

function allFetchAssoc(mysqli $db, string $sql,array $bind =[], array $params = []) {
    $bind_type ="";
    foreach($bind as $ch){
        $bind_type .=$ch;
    }
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param($bind_type, ...$params);
    }
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result->fetch_assoc();
    }
    return null;
}

function allGetRes(mysqli $db, string $sql,array $bind =[], array $params = []){
    $bind_type ="";
    foreach($bind as $ch){
        $bind_type .=$ch;
    }
    $stmt = $db->prepare($sql);
    if ($params) {
        $stmt->bind_param($bind_type, ...$params);
    }
    $stmt->execute();
    if ($result = $stmt->get_result()) {
        return $result;
    }
    return null;
}