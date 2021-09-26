<?php
function compareStrangeMath($a,$b) {
    //Получаем количество цифр в
    $len1 = strlen($a);
    $len2 = strlen($b);
    
    //Если длина чисел разная то добавляем нули меньшему числу
    //до равной длины. После этого обычное сравнение будет работать
    //и для странной математики

    //Переменная wasIncreased для того случая, когда переменные после добавления
    //нулей окажутся равны (12 и 120), в случае их равенства должна быть меньше
    //та переменная, которая была увеличена     

    //Добавление нулей для меньшего числа
    if ($len1 > $len2) {
        $b *= pow(10, $len1 - $len2);
        $wasIncreased = 1;
    }
    elseif(($len1 < $len2))  {
        $a *= pow(10, $len2 - $len1);
        $wasIncreased = 2;
    }

    if ($a > $b) 
        return 1;
    elseif ($a < $b)
        return 2;
    else
        return $wasIncreased;
}

function findElem($mass,$k,$n) {
    //Простой поиск от начала до конца
    //Наверняка как-то можно использовать закономерности странной математики
    //для более оптимального поиска или же для нахождения элемента по индексу.
    //Я пытался вывести такую формулу, 
    //но она не работала для всех входных данных.
    for($i = 0; $i < $n; $i++) {
        if ($mass[$i] == $k ) 
            return $i + 1;
        
    }
    return -1;
}

function quickSort($mass){
    //Стандартная быстрая сортировка за исключением своей функции сравнения
    $len = count($mass);

    if ($len <= 1)
        return $mass;

    $first = $mass[0];
    $left = array();
    $right = array();

    for ($i = 1; $i < $len; $i++) {
        if (compareStrangeMath($first,$mass[$i]) == 1)
            $left[] = $mass[$i];
        else
            $right[] = $mass[$i];
    }

    $left = quickSort($left);
    $right = quickSort($right);

    return array_merge($left, array($first), $right);
            
}


//Получаем количество элементов
$n = $_GET["N"];
//Получаем элемент который нужно искать
$k = $_GET["K"];


//Создаем неотсортированный массив
for($i = 0; $i < $n; $i++) {
    $mass[] = $i + 1;
}
//Сортировка по правилам странной математики
$mass = quickSort($mass);

//Поиск необходимого элемента
echo findElem($mass,$k,$n);


?>