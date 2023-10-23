<?php





function main(): int
{
    static $count = 0;

    if ($count++ <100)
    main(main());
    return 0;
}

exit(main());
