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

$count_valid_documents = 0;
$count_invalid_documents = 0;

foreach ($passports_passenger as $key => $passenger) {
  preg_match_all('/(([a-zA-Z0-9]*:{1}))/', $passenger, $given_keys);

  if (count($given_keys[2]) == 8 or (count($given_keys[2]) == 7 and !in_array('cid:', $given_keys[2])))
  { $count_valid_documents++; }
  else
  { $count_invalid_documents++; }
}


// print result
echo "Valid : ".$count_valid_documents."\n";
echo "Invalid : ".$count_invalid_documents."\n";
echo "Sum : ".($count_valid_documents + $count_invalid_documents)."\n";
