<?php

function bfexec(&$bfArray, $cmd) 
{
    switch($cmd) {
        case '+':
            $currentKey = key($bfArray);
            $bfArray[$currentKey]++;
            break;
        case '-':
            $currentKey = key($bfArray);
            $bfArray[$currentKey]--;
            break;
        case '>':
            $next = next($bfArray);
            if ($next === false) {
                $bfArray[] = 0;
            }
            break;
        case '<':
            $prev = prev($bfArray);
            if ($prev === false) {
                array_unshift($bfArray, 0);
            }
            break;
        case '.':
            echo current($bfArray);
            break;
    }
}

$bf = '+++[>+++++>+[>++<-]<<-].';


$bfArray = [];
$bfArray[] = 0;

$bf = str_split ($bf);
for ($i = 0; $i < count($bf); $i++)
{
    $cmd = $bf[$i];
    if ($cmd === '[') {
        continue;
    }
    
    if ($cmd === ']' && current($bfArray) !==0) {
        $loop = 1;
        while ($loop > 0) {
            $i--;
            $cmd = $bf[$i];
            if ($cmd === '[') {
                $loop--;
            } else if ($cmd === ']') {
                $loop++;
            }
        }
        continue;
    }
    
    bfexec($bfArray, $cmd);
}
