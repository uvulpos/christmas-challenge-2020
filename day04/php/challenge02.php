<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     04.12.2020
    @url      https://adventofcode.com/2020/day/4

*******************************************************************************/

// get numbers from json file
$passports_passenger = explode("\n\n", file_get_contents(__DIR__."/passports.txt"));

// if json file is not an array, just die hard ;)
if (!is_array($passports_passenger))
{ die("Json File not valid!\n"); }

$counter = 0;
$count_valid_documents = 0;
$count_invalid_documents = 0;
$eye_colors = array("amb","blu","brn","gry","grn","hzl","oth");

foreach ($passports_passenger as $key => $passenger) {
  preg_match_all("/([a-zA-Z0-9]*):{1}([a-zA-Z0-9\#]*)/", $passenger, $regex_result);

  $regex_count = count($regex_result[0]);
  if ($regex_count == 8 or ($regex_count == 7 and !in_array("cid", $regex_result[1]))) {

    $passport_valid = true;
    foreach (range(0, count($regex_result[0]) - 1, 1) as $passport_value_index) {
      $passport_index = $regex_result[1][$passport_value_index];
      $passport_value = $regex_result[2][$passport_value_index];

      $valid = match(true) {
         str_contains($passport_index,"byr") => num_in_range($passport_value, 1920, 2002)
        ,str_contains($passport_index,"iyr") => num_in_range($passport_value, 2010, 2020)
        ,str_contains($passport_index,"eyr") => num_in_range($passport_value, 2020, 2030)
        ,str_contains($passport_index,"hgt") => validate_height($passport_value)
        ,str_contains($passport_index,"hcl") => is_hex_color($passport_value)
        ,str_contains($passport_index,"ecl") => in_array($passport_value, $eye_colors)
        ,str_contains($passport_index,"pid") => validate_id($passport_value, 9)
        ,default => true
      };

      if ($passport_valid !== true) { echo "INVALID1\n"; $count_invalid_documents++; break; }
    }
    if ($passport_valid === true) {
      $count_valid_documents++;
    }
  }
  else { echo "INVALID2\n"; $count_invalid_documents++; }
}

// print result
echo "Counter: ".$counter."\n";
echo "Valid : ".$count_valid_documents."\n";
echo "Invalid : ".$count_invalid_documents."\n";
echo "Sum : ".($count_valid_documents + $count_invalid_documents)."\n";

function validate_height(string $height): bool {
  preg_match_all("/([0-9]{2,3})(cm|in)/", $height, $regex_result);
  $length_unit  = $regex_result[1][0] ?? "cm";
  $length_value = $regex_result[2][0] ?? 0;
  if ($length_unit == "cm" and ($length_value >= 150 and $length_value <= 193))
  { return true; }
  elseif ($length_unit == "in" and ($length_value >= 59 and $length_value <= 76))
  { return true; }
  return false;
}

function print_bool($value): string
{ return (is_bool($value) and $value) ? "True" : "False"; }

function validate_id($number, $amount): bool
{ return is_numeric($number) and strlen($number) == $amount; }

function num_in_range($val, $min, $max): bool
{ return ($val >= $min && $val <= $max); }

function is_hex_color(string $value): bool
{ return 1 == preg_match("/#[0-9a-f]{6}/i", $value); }
