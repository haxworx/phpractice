<?php



function main(): int
{
    $codes = [
        100 => 'continue',
        101 => 'switching protocols',
        103 => 'early hints',
        200 => 'ok',
        201 => 'created',
        202 => 'accepted',
        204 => 'no content',
        301 => 'permenent redirect',
        302 => 'temporary redirect',
        303 => 'see other',
        404 => 'not found',
        410 => 'gone',
        500 => 'internal server error',
        503 => 'service unavailable',
    ];

    foreach ($codes as $code => $explain) {
        printf("%d:\t%s\n", $code, $explain);
    } 

    return 0;
}

exit(main());
