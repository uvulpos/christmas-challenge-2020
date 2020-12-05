<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     05.12.2020
    @url      https://adventofcode.com/2020/day/5

*******************************************************************************/

// get numbers from json file
$boarding_pass_array = explode("\n", file_get_contents(__DIR__."/seats.txt"));

// if json file is not an array, just die hard ;)
if (!is_array($boarding_pass_array))
{ die("Json File not valid!\n"); }

// define important variables
$used_seats = array();

foreach ($boarding_pass_array as $boarding_pass) {

  // if string is not valid -> skip pass
  if (strlen($boarding_pass) != 10)
  { continue; }

  // get col, row seperated from from string
  preg_match_all('/([F|B]{7})([L|R]{3})/', $boarding_pass, $boarding_position);

  // if regex unvalid match
  if (count($boarding_position) != 3 or !array_arraycount($boarding_position, 1))
  { continue; }

  $row_string = $boarding_position[1][0];
  $col_string = $boarding_position[2][0];

  // replace chars to numbers to get binary string
  str_replace_multi($row_string, array('F' => 0, 'B' => 1));
  str_replace_multi($col_string, array('L' => 0, 'R' => 1));

  // convert binary to int
  $row_num = bindec($row_string);
  $col_num = bindec($col_string);

  // cache seats
  $used_seats[$row_num][] = $col_num;
}

foreach ($used_seats as $key => $seats_row) {

  // sorts array recusive
  sort($seats_row);

  // if array count is different to seat number max - seat number min
  // -> there is somthing free in betwen
  if (count($seats_row) != (end($seats_row) - $seats_row[0]) + 1) {
    echo "Seat-ID: ".($key * 8 + missing_number($seats_row))." is missing!\n";
  }
}

// calculate missing number
function missing_number(array $numbers): int {
  $need_numbers = range($numbers[0],max($numbers));
  $differences = array_diff($need_numbers, $numbers);
  return reset($differences) ?? 0;
}

// function to check if regex returned right amount of matches
function array_arraycount($array, $arraycount) {
  foreach ($array as $validate_array) {
    if (count($validate_array) != $arraycount) { return false; }
  }
  return true;
}

// replaces multiple chars to value
function str_replace_multi(string &$replace_string, array $replacewith) {
  foreach ($replacewith as $replace_basis => $replace_withchar) {
    $replace_string = str_replace($replace_basis, $replace_withchar, $replace_string);
  }
}
