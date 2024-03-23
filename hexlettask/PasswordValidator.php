<?php

namespace Hexlet\Php;

class PasswordValidator
{
    private $options;

    public function __construct(array $options = [])
    {
        $this->options['minLength'] = $options['minLength'] ?? 8;
        $this->options['containNumbers'] = $options['containNumbers'] ?? false;
    }

    public function validate($password)
    {
        $minLength = (strlen($password) >= $this->options['minLength']) ? [] : ['minLength' => 'too small'];
        if ($this->options['containNumbers'] === true) {
            $containNumbers = (strpbrk($password, "0123456789") === false)
                ? ['containNumbers' => 'should contain at least one number']
                : [];
        } else {
            $containNumbers = [];
        }
        return array_merge($minLength, $containNumbers);
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

