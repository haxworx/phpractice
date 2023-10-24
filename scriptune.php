<?php






function main(): int
{
    $text = file_get_contents('kjv.txt');
    $passages = explode("\n", $text);
    printf("%s\n", $passages[random_int(0, count($passages) -1)]);
    return 0;
}

exit(main());
