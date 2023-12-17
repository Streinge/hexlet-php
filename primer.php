<?php
$staples = '())(';
$i = 0;
echo $staples[$i]."\n";
echo $staples[$i + 1]."\n";
if ($staples[$i] === '(' && $staples[$i + 1] === ')') {
    $staples = substr_replace($staples, '', $i, 2);
}
echo $staples;