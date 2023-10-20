<?php







function main(): int
{
    $words = explode("\n", file_get_contents('words.txt'));
    printf("%s\n", $words[random_int(0, count($words) -1)]);
    $originals = [];
    foreach ($words as $word) {
        if (empty($word)) continue;
        if (array_key_exists($word, $originals)) {
            $originals[$word]++;
        } else {
            $originals[$word] = 1;
        }
    }
    foreach ($originals as $key => $count) {
        echo "$key => $count\n";
        if ($count > 1) exit(1);
    }
    return 0;
}

exit(main());
