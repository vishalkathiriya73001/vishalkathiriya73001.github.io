<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$json_file = '100.json';
$json_data = file_get_contents($json_file);
$data = json_decode($json_data, true);
if ($data === null) {
    die('Failed to decode JSON data');
}
// print_r($data);

foreach ($data['data'] as $entry) {
    $avatar = $entry['avatar'];
    $filename = pathinfo($avatar, PATHINFO_FILENAME);
    $url = "https://socialbook.io/api/core_user/trend?user_stat_user_id=$filename&date_range=now-2y&channel=instagram";

    $json_data = file_get_contents($url);
    $filename = $filename . '.json';
    if ($json_data === false) {
        die('Failed to fetch JSON data from URL');
    }
    $save_path = __DIR__ . '/' . $filename;
    print_r($save_path);
    print_r("\n\n");
    if (file_put_contents($save_path, $json_data) !== false) {
        echo "File saved successfully: $save_path";
    } else {
        echo "Error saving file.";
    }
}

?>
