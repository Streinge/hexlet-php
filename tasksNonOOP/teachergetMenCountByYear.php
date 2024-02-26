<?php
// Здесь есть лаконичная проверка ключа перед записью туда данных
namespace App\Users;

// BEGIN
function getMenCountByYear(array $users)
{
    $menfolk = array_filter($users, fn($user) => $user['gender'] === 'male');

    $years = array_map(fn($user) => date('Y', strtotime($user['birthday'])), $menfolk);

    return array_reduce($years, function ($acc, $year) {
        // в правой части после знака равно, проверяется наличие ключа
        // если его нет то с помощью ?? устанавливается значение по умолчанию
        $acc[$year] = ($acc[$year] ?? 0) + 1;

        return $acc;
    }, []);
}
// END