<?php
include_once 'basicIncludes.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

$aflID = $data->aflID;
$klantID = $data->klantID;

$query = "
SELECT * FROM stream
WHERE klantID = ? and AflID = ?
  AND d_eind >= NOW() - INTERVAL 30 SECOND
ORDER BY StreamID DESC
LIMIT 1;
";

$stream = fetchSql($query, [$klantID, $aflID]);

if ($stream) {
    $query = "
    UPDATE stream SET d_eind = NOW()
    WHERE StreamID = ?;
    ";
    runSql($query, [$stream['StreamID']]);
} else {
    $query = "
    INSERT INTO stream (klantID, AflID, d_start, d_eind)
    VALUES (?, ?, NOW() - INTERVAL 5 SECOND, NOW());
    ";
    runSql($query, [$klantID, $aflID]);
}
echo json_encode($stream);
?>