<?php

function runSql($sql, $params = [], $returnLastInsertedId = false) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);

    if ($returnLastInsertedId) {
        return $conn->lastInsertId();
    }

    return $stmt;
}

function execSql($sql, $params = []) {
    runSql($sql, $params);
}

function fetchSql($sql, $params = []) {
    return runSql($sql, $params)->fetch(PDO::FETCH_ASSOC);
}

function fetchSqlAll($sql, $params = []) {
    return runSql($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
}