<?php




enum Cheeses
{
    case BLUE;
    case GREEN;
}

function main(): int
{
    printf("%d %d\n", Cheeses::BLUE, Cheeses::GREEN);
    return 0;
}


exit(main());
