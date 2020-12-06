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

  // get unique chars
  preg_match_all('/[a-zA-Z]/', str_replace(array("\n", " "), "",$duty_row), $unique_chars);

  // make array unique
  $unique_chars = array_unique($unique_chars[0]);

  // sort array
  // sort($unique_chars); // in this case not needed

  // calculate sum
  $result += count($unique_chars);
}

echo "The Result is: ".$result."\n";
