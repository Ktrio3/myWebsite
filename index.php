<?php include("header.php");?>
<?php include("articles.php");?>
<?php
  if($_GET["offset"])
    $offset = $_GET["offset"];
  else
    $offset = 0;

  $list_of_articles = get_article_list($offset);
?>

<!-- Page Header -->
<header class="masthead">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>CTF Blog</h1>
          <span class="subheading">Recent CTF write-ups and beyond</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <p>Below are some of my CTF write-ups. A full list can be found
        on my github <a href="https://github.com/Ktrio3/ctf_writeups">here</a>.
      </p>
      <?php foreach($list_of_articles as $key => $article):?>
        <div class="post-preview">
          <a href="post.php?post=<?php echo $offset + $key; ?>">
            <h2 class="post-title">
              <?php echo $article['title']; ?>
            </h2>
            <h3 class="post-subtitle">
              <?php echo $article['subtitle']; ?>
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#"><?php echo $article['author']; ?></a>
            on <?php echo $article['date']; ?></p>
        </div>
        <hr>
      <?php endforeach;?>
      <!-- Pager -->
      <div class="clearfix">
        <a class="btn btn-secondary float-right" href="index.php?offset=<?php echo $offset + 10; ?>">Older Posts &rarr;</a>
      </div>
    </div>
  </div>
</div>
<?php include("footer.php");?>
