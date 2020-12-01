<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     01.12.2020
    @url      https://adventofcode.com/2020/day/1

*******************************************************************************/

// get numbers from json file
$list_numbers = json_decode(file_get_contents(__DIR__."/numbers.json"), true);

// if json file is not an array, just die hard ;)
if (!is_array($list_numbers))
{ die("Json File not valid!\n"); }

foreach ($list_numbers as $key => $list_number) {

  // if number is not numeric -> skip that
  if (!is_numeric($list_number) or intval($list_number) == 0)
  { continue; }

  // calculate difference to 2020
  $number_2_2020 = 2020 - $list_number;

  // search number in array -> if exists calculate result and die even harder!
  if (in_array($number_2_2020, $numbers))
  { die($list_number." * ".$number_2_2020." = ".($list_number * $number_2_2020)."\n"); }

}

/*

Output:
uvulpos@Timvpos:~/christmas-challenge/day01$ php challenge01.php
399 * 1621 = 646779
uvulpos@Timvpos:~/christmas-challenge/day01$

This was the answer :D

*/
