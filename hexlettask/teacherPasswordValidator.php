<?php

namespace Hexlet\Php;

class PasswordValidator
{
    // Это решение учителя: интересно как задаются значения по умолчанию в виде константы
    // И еще в реальной разработке надо использовать функции для работы с длинным строками
    // BEGIN
    private const OPTIONS = [
        'minLength' => 8,
        'containNumbers' => false
    ];

    private $options;

    public function __construct(array $options = [])
    {
        $this->options = array_merge(self::OPTIONS, $options);
    }

    public function validate(string $password): array
    {
        $errors = [];
        if (mb_strlen($password) < $this->options['minLength']) {
            $errors['minLength'] = 'too small';
        }

        if ($this->options['containNumbers']) {
            if (!$this->hasNumber($password)) {
                $errors['containNumbers'] = 'should contain at least one number';
            }
        }

        return $errors;
    }
    // END

    private function hasNumber(string $subject): bool
    {
        return strpbrk($subject, '1234567890') !== false;
    }
}


$validator = new PasswordValidator();
$errors1 = $validator->validate('qwertyui');
echo "должен быть пустой массив \n";
var_dump($errors1); // []

$errors2 = $validator->validate('qwerty');
echo "должно быть TRUE \n";
var_dump(['minLength' => 'too small'] === $errors2); // true

$errors3 = $validator->validate('another-password');
echo "должен быть пустой массив \n";
var_dump($errors3); // []



$validator = new PasswordValidator([
    'containNumbers' => true
]);
$errors1 = $validator->validate('qwertya3sdf');
echo "должен быть пустой массив \n";
var_dump($errors1); //[]

$errors2 = $validator->validate('qwerty');
echo "должно быть TRUE \n";
var_dump(['minLength' => 'too small', 'containNumbers' => 'should contain at least one number'] === $errors2); // true

$errors3 = $validator->validate('q23ty');
echo "должно быть TRUE \n";
var_dump(['minLength' => 'too small'] === $errors3); //true


$validator = new PasswordValidator([
    'containNumberz' => null
]);
$errors1 = $validator->validate('qwertya3sdf');
echo "должен быть пустой массив \n";
var_dump($errors1); // []

$errors2 = $validator->validate('qwerty');
echo "должно быть TRUE \n";
var_dump(['minLength' => 'too small'] === $errors2); // true

