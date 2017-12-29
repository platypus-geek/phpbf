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

$bf = '+++[>+++++>+[>++<-]<-].';

$bfArray = [];
$bfArray[] = 0;
$whileCmd = [];
$openWhile = 0;
        
$bf = str_split ($bf);
foreach ($bf as $cmd) {

    if ($cmd === '[') {
        $openWhile ++;
        $whileCmd[$openWhile] = '';
        
        continue;
    }
    
    if ($cmd === ']') {
        $openWhile --;
        
        continue;
    }
    
    if ($openWhile > 0) {
        $whileCmd[$openWhile] .= $cmd;
        continue;
    }
    
    if (!empty($whileCmd)) {
        
        
    
        foreach ($whileCmd as $subBf) {
            $subBf = str_split($subBf);
            var_dump($bfArray, $subBf);
            while(current($bfArray) !==0) {
                foreach ($subBf as $subCmd) {
                    bfexec($bfArray, $subCmd);
                }
                echo current($bfArray);exit;
            }
        }
        continue;
    }

    
    bfexec($bfArray, $cmd);
}

var_dump($bfArray);
?>