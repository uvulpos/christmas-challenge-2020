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

$highest_seat_id = 0;

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

  // replace chars to numbers
  str_replace_multi($row_string, array('F' => 0, 'B' => 1));
  str_replace_multi($col_string, array('L' => 0, 'R' => 1));

  // binary to int
  $row_num = bindec($row_string);
  $col_num = bindec($col_string);

  // calculate seat-id
  $seat_id = ($row_num * 8 + $col_num);

  // get highest seat-id
  if ($seat_id > $highest_seat_id)
  { $highest_seat_id = $seat_id; }
}
echo "Sitz-ID: ".$highest_seat_id."\n";

function array_arraycount($array, $arraycount) {
  foreach ($array as $validate_array)
  { if (count($validate_array) != $arraycount) { return false; } }
  return true;
}

function str_replace_multi(string &$replace_string, array $replacewith) {
  foreach ($replacewith as $replace_basis => $replace_withchar) {
    $replace_string = str_replace($replace_basis, $replace_withchar, $replace_string);
  }
}
