<?php


function main(): int
{
    $bytes = file_get_contents('file.xml');
    if ($bytes === false) return 1;

    $xml = new SimpleXMLElement($bytes);

    $json = json_encode($xml, true);

    print $json;

    return 0;
}

exit(main());
