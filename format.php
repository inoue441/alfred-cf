<?php
if (count($argv) < 2) {
    die('CSVファイルを指定してください');
}

$path = $argv[1];
if (!file_exists($path)) {
    die('CSVファイルが見つかりません');
}

$fp = new SplFileObject($path);
$fp->setFlags(SplFileObject::READ_CSV);

$items = [];
foreach ($fp as $row) {
    if ($fp->key() === 0 || $fp->eof()) {
        continue;
    }

    $items[] = [
        'number' => $row[0],
        'title' => sprintf("#%d %s", $row[0], $row[7]),
        'subtitle' => sprintf("#%d %s", $row[0], $row[7]),
        'arg' => $row[0],
        'count' => 0,
        'modified' => null,
    ];
}

echo json_encode(compact('items'), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
