<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     02.12.2020
    @url      https://adventofcode.com/2020/day/2

*******************************************************************************/

// get numbers from json file
$list_passwords = json_decode(file_get_contents(__DIR__."/passwords.json"), true);

// if json file is not an array, just die hard ;)
if (!is_array($list_passwords))
{ die("Json File not valid!\n"); }

// define counter
$password_valid = 0;
$password_invalid = 0;

foreach ($list_passwords as $password_index => $password_row) {

  // define variables to create more readable code
  $password_amount  = $password_row['amount'];
  $password_key     = $password_row['key'];
  $password_value   = $password_row['value'];

  // get min and max value from policy
  list($match1, $match2) = explode("-", $password_amount);

  if (
        // if policy numbers are not integers -> invalid
        (0 != intval($match1) and 0 != intval($match2)) and
        // if policy key matches with string position -> valid
        (
          $password_value[(intval($match1) - 1)] == $password_key xor
          $password_value[(intval($match2) - 1)] == $password_key
        )
  )
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
uvulpos@Timvpos:~/christmas-challenge/day02$ php challenge02.php
428 passwords are valid
572 passwords are invalid
That makes a total of 1000 passwords
uvulpos@Timvpos:~/christmas-challenge/day02$

*/
