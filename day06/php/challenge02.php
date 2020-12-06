<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     06.12.2020
    @url      https://adventofcode.com/2020/day/6

*******************************************************************************/

// get numbers from json file
$duty_list = explode("\n\n", file_get_contents(__DIR__."/list.txt"));

// if json file is not an array, just die hard ;)
if (!is_array($duty_list))
{ die("Json File not valid!\n"); }

$result = 0;

foreach ($duty_list as $key => $duty_row) {

  // count seats per row
  $seats = count(array_filter(explode("\n", $duty_row)));

  // get unique chars
  preg_match_all('/[a-zA-Z]/', str_replace(array("\n", " "), "",$duty_row), $unique_chars);

  // count chars
  $used_chars = array_count_values($unique_chars[0]);

  // if char amount is equal to seats -> count
  foreach ($used_chars as $char => $char_amount) {
    if ($char_amount == $seats and $char != " ") { $result++; }
  }
}

echo "The Result is: ".$result."\n";
