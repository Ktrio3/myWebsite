<?php
$articles = [
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
