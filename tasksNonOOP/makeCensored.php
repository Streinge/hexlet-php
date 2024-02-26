<?php

namespace Hexlet\Php\MakeCensored;

function makeCensored(string $text, array $stopWords): string
{
    $words = explode(' ', $text);
    foreach ($stopWords as $stop) {
        $new_text = [];
        if (in_array($stop, $words)) {
            foreach ($words as $word) {
                ($stop === $word) ? $new_text[] = '$#%!' : $new_text[] = $word;
            }
            $words = $new_text;
        }         
    }
    $result  = implode(' ', $new_text);
    return $result;
}
$sentence = 'When you play the game of thrones, you win or you die';
echo makeCensored($sentence, ['die', 'play']);
// => When you $#%! the game of thrones, you win or you $#%!
