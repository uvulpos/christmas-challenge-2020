<?php

/*******************************************************************************

    @author   uVulpos - Tim Riedl <githubcontact@tim-riedl.de>
    @license  MIT - free with copyright notice
    @date     03.12.2020
    @url      https://adventofcode.com/2020/day/3

*******************************************************************************/

// get numbers from json file
$tree_map = explode("\n", file_get_contents(__DIR__."/map.txt"));

// if json file is not an array, just die hard ;)
if (!is_array($tree_map))
{ die("Json File not valid!\n"); }

function calcTrees(array $tree_map, int $x_speed = 3, int $y_speed = 1) {
  // define important variables
  $x_axis = 0;
  $y_axis = 0;
  $trees = 0;
  $tree_map_y_length = count($tree_map);
  $tree_map_x_length = strlen($tree_map[0]);


  foreach (range(0, ($tree_map_y_length - 1) ,$y_speed) as $y_axis) {
    // if x is out of range -> start at 1 / if last line or empty -> skip
    $tree_map_x_length = strlen($tree_map[$y_axis]);
    if ($tree_map_x_length < 1) { continue; }
    if ($x_axis >= $tree_map_x_length) { $x_axis = ($x_axis - $tree_map_x_length); }

    // check if there is a tree
    if ($tree_map[$y_axis][$x_axis] == "#") { $trees++; }
    $x_axis += $x_speed;
  }
  return $trees;
}

// print result
$route_1 = calcTrees($tree_map, 1, 1);
$route_2 = calcTrees($tree_map, 3, 1);
$route_3 = calcTrees($tree_map, 5, 1);
$route_4 = calcTrees($tree_map, 7, 1);
$route_5 = calcTrees($tree_map, 1, 2);
echo "Bäume Router 1: ".$route_1."\n";
echo "Bäume Router 2: ".$route_2."\n";
echo "Bäume Router 3: ".$route_3."\n";
echo "Bäume Router 4: ".$route_4."\n";
echo "Bäume Router 5: ".$route_5."\n";
echo "Ergebnis: ".($route_1*$route_2*$route_3*$route_4*$route_5)."\n";

/*

Output:
uvulpos@Timvpos:~/christmas-challenge/day03$ php challenge01.php
Bäume Router 1: 85
Bäume Router 2: 176
Bäume Router 3: 96
Bäume Router 4: 87
Bäume Router 5: 47
Ergebnis: 5872458240
uvulpos@Timvpos:~/christmas-challenge/day03$

*/
