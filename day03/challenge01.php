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

  // in range because this way I can increase / decrease the speed
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
echo "Bäume: ".calcTrees($tree_map)."\n";

/*

Output:
uvulpos@Timvpos:~/christmas-challenge/day03$ php challenge01.php
Bäume: 176
uvulpos@Timvpos:~/christmas-challenge/day03$

*/
