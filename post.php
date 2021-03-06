<?php error_reporting(E_ALL);
ini_set('display_errors', 1);?>
<?php include("header.php"); ?>
<?php include("articles.php");?>
<?php include("Parsedown.php");?>
<?php
  if(isset($_GET['post']) && !empty($_GET['post']))
    $post = $_GET["post"];
  else
    $post = 0;

  $article = get_article($post);
  $f = fopen($article['file'], 'r') or die("Unable to open post.");
?>

<!-- Page Header -->
<header class="masthead">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1><?php echo $article['title']; ?></h1>
          <h2 class="subheading"><?php echo $article['subtitle']; ?></h2>
          <span class="meta">Posted by
            <a href="#"><?php echo $article['author']; ?></a>
            on <?php echo $article['date']; ?></span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Post Content -->
<article>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php
        if(!empty($article['downloads']))
        {
          echo "<h3>Downloads</h3><ul>";
          foreach($article['downloads'] as $name => $link)
          {
            echo "<li><a href='downloads/$link'>$name</a></li>";
          }
          echo "</ul><hr>";
        }
        $Parsedown = new Parsedown();
        echo $Parsedown->text(fread($f,filesize($article['file'])));
        fclose($f);
        ?>
      </div>
    </div>
  </div>
</article>
<hr>
<?php include("footer.php"); ?>
