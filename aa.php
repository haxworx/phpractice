<?php




function main(array $args): int
{
    $matrix = [];

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $j++) {
            for ($k = 0; $k < 10; $k++) {
                $matrix[$i][$j][$k] = $i * $j * $k;
            }
        }
    }

    print_r($matrix);

    printf("%d\n", $matrix[1][2][3]);

    return 0;
}

exit(main($argv));
