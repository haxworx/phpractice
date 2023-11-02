<?php



function main(): int
{
    $txt = "";

    $words = explode("\n", file_get_contents('words.txt'));

    for ($i = 0; $i < 10; $i++) {
       $word = $words[random_int(0, count($words)-1)];
        $txt .= sprintf("%s ", $word); 
    }
    printf("%s\n", $txt);

    return 0;
}

exit(main());
