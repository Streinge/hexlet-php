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
    public $busy = [];

    public function book($strBegin, $strEnd)
    {
        $dateBegin = Carbon::create($strBegin);
        $dateEnd = Carbon::create($strEnd);
        if ($dateEnd->lessThanOrEqualTo($dateBegin)) {
            return false;
        }

        if (!$this->busy) {
            $this->busy[] = [$dateBegin, $dateEnd];
            return true;
        }
        $result = [];
        foreach ($this->busy as $period) {
            $condition1 = $dateBegin->lessThanOrEqualTo($period[0]) && $dateEnd->lessThanOrEqualTo($period[0]);
            $condition2 = $period[1]->lessThanOrEqualTo($dateBegin) && $period[1]->lessThanOrEqualTo($dateEnd);
            if ($condition1 || $condition2) {
                $result = [$dateBegin, $dateEnd];
            } else {
                return false;
            }
        }
        $this->busy[] = $result;
        return true;
    }
}

$booking = new Booking();
echo "Должно быть FALSE\n";
$result0 = $booking->book('10-11-2008', '05-11-2008');
var_dump($result0);//false
echo "Должно быть TRUE\n";
$result1 = $booking->book('11-11-2008', '13-11-2008');
var_dump($result1); //true
echo "Должно быть FALSE\n";
$result2 = $booking->book('12-11-2008', '12-11-2008');
var_dump($result2); //false
echo "Должно быть FALSE\n";
$result3 = $booking->book('10-11-2008', '12-11-2008');
var_dump($result3); //false
echo "Должно быть FALSE\n";
$result4 = $booking->book('12-11-2008', '14-11-2008');
var_dump($result4);//false
echo "Должно быть TRUE\n";
$result5 = $booking->book('10-11-2008', '11-11-2008');
var_dump($result5);
echo "Должно быть FALSE\n";
$result55 = $booking->book('12-11-2008', '13-11-2008');
var_dump($result55);//false
echo "Должно быть FALSE\n";
$result6 = $booking->book('13-11-2008', '13-11-2008');
var_dump($result6);//false
echo "Должно быть TRUE\n";
$result7 = $booking->book('13-11-2008', '14-11-2008');
var_dump($result7);//true
echo "Должно быть FALSE\n";
$result8 = $booking->book('08-11-2008', '18-11-2008');
var_dump($result8);//false
echo "Должно быть TRUE\n";
$result9 = $booking->book('08-05-2008', '18-05-2008');
var_dump($result9);//true
echo "Должно быть FALSE\n";
$result10 = $booking->book('09-05-2008', '10-05-2008');
var_dump($result10);//false
echo "Должно быть FALSE\n";
$result11 = $booking->book('08-05-2008', '20-05-2008');
var_dump($result11);//false
echo "Должно быть FALSE\n";
$result12 = $booking->book('07-05-2008', '18-05-2008');
var_dump($result12);//false
echo "Должно быть FALSE\n";
$result13 = $booking->book('08-05-2008', '18-05-2008');
var_dump($result13);//false
echo "Должно быть FALSE\n";
$result14 = $booking->book('08-05-2008', '18-11-2008');
var_dump($result14);//false
