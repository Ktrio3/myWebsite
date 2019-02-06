<?php
$articles = array(
	array(
    "title" => "Unlink",
    "subtitle" => "Pwnable.kr",
    "author" => "Kevin Dennis",
    "date" => "November 6th, 2017",
    "file" => "./md/pwnable.kr_unlink.md",
    "downloads" => array("Python Solution" => "pwnable.kr_unlink.py")
  ),
	array(
    "title" => "Symlink Attack",
    "subtitle" => "Systems Security, Fall 2017",
    "author" => "Kevin Dennis",
    "date" => "October 29th, 2017",
    "file" => "./md/symlink_attack.md",
    "downloads" => array("Setuid Program" => "setuid_program.c", "Python Script" => "symlink_attack.py")
  ),
  array(
    "title" => "Hidden Program (Warmup)",
    "subtitle" => "Exploitation Challenge, Pwn2win 2017",
    "author" => "Kevin Dennis",
    "date" => "October 23rd, 2017",
    "file" => "./md/pwn2win_2017_hidden.md",
    "downloads" => array("Hidden Program C Code" => "pwn2win_2017_hidden.c")
  ),
  array(
    "title" => "Shia Labeouf-off!",
    "subtitle" => "Web Challenge, CSAW 2017",
    "author" => "Kevin Dennis",
    "date" => "October 16th, 2017",
    "file" => "./md/csaw_2017_shia.md",
    "downloads" => array()
  ),
);

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
