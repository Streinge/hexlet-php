<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Carbon\Carbon;

class Booking
{
    private $busy = [];

    public function book($strDate1, $strDate2)
    {
        $date1 = Carbon::create($strDate1);
        $date2 = Carbon::create($strDate2);
        var_dump($date1 == $date2);
        $busy[] = [$strDate1, $strDate2];
        $this->busy = $busy;
        

        return $this;
    }
}

$booking = new Booking();

var_dump($booking);
var_dump($booking->book('11-11-2008', '11-11-2008'));
