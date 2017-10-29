<?php
$articles = [
	[
    "title" => "Symlink Attack",
    "subtitle" => "Systems Security, Fall 2017",
    "author" => "Kevin Dennis",
    "date" => "October 29th, 2017",
    "file" => "./md/symlink_attack.md",
    "downloads" => ["Setuid Program" => "setuid_program.c", "Python Script" => "symlink_attack.py"]
  ],
  [
    "title" => "Hidden Program (Warmup)",
    "subtitle" => "Exploitation Challenge, Pwn2win 2017",
    "author" => "Kevin Dennis",
    "date" => "October 23rd, 2017",
    "file" => "./md/pwn2win_2017_hidden.md",
    "downloads" => ["Hidden Program C Code" => "pwn2win_2017_hidden.c"]
  ],
  [
    "title" => "Shia Labeouf-off!",
    "subtitle" => "Web Challenge, CSAW 2017",
    "author" => "Kevin Dennis",
    "date" => "October 16th, 2017",
    "file" => "./md/csaw_2017_shia.md",
    "downloads" => []
  ],
];

function get_article_list($offset)
{
  global $articles;
  return array_slice ($articles, $offset, 10);
}

function get_article($post)
{
  global $articles;
  return $articles[$post];
}

?>
