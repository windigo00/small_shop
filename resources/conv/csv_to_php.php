<?php
if ($file = fopen($argv[1], 'r')) {
    $out = '<?php

return [
';
    while ($line = fgetcsv($file)) {
        $key = str_replace('\'', '\\\'', $line[0]);
        $val = str_replace('\'', '\\\'', $line[1]);

        $out .= "    '{$key}' => '{$val}',\n";
    }
    fclose($file);
    $filename = str_replace('.csv', '.php', $argv[1]);
    file_put_contents($filename, $out .'
];
');
}