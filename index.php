<?php

function getCurrentYear()
{
    return (int) substr(date('Y-m-d'), 0, 4);
}

// Вызов функции
print_r(getCurrentYear());
