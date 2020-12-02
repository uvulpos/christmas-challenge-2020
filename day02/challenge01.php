<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     01.12.2020
    @url      https://adventofcode.com/2020/day/1

*******************************************************************************/

// get numbers from json file
$list_passwords = json_decode(file_get_contents(__DIR__."/passwords.json"), true);

// if json file is not an array, just die hard ;)
if (!is_array($list_passwords))
{ die("Json File not valid!\n"); }

// define counters
$password_valid = 0;
$password_invalid = 0;

foreach ($list_passwords as $password_index => $password_row) {

  // define variables to create more readable code
  $password_amount  = $password_row['amount'];
  $password_key     = $password_row['key'];
  $password_value   = $password_row['value'];

  // count how often this char appeared
  $regex_result = preg_match_all("[".$password_key."]", $password_value);

  // get min and max value from policy
  list($min, $max) = explode("-", $password_amount);

  // if char count match policy guidelines -> valid or invalid
  if ($regex_result >= intval($min) and $regex_result <= intval($max))
  { $password_valid++; }
  else
  { $password_invalid++; }

}

// print result
echo $password_valid." passwords are valid\n";
echo $password_invalid." passwords are invalid\n";
echo "That makes a total of " . ($password_valid + $password_invalid) . " passwords";
echo "\n";

/*

Output:
uvulpos@Timvpos:~/christmas-challenge/day02$ php challenge01.php
396 passwords are valid
604 passwords are invalid
That makes a total of 1000 passwords
uvulpos@Timvpos:~/christmas-challenge/day02$

*/
