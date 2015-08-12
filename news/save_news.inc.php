<?php
$title = $news->clearStr($_POST['title']);
$category = $news->clearInt($_POST['category']);
$description = $news->clearStr($_POST['description']);
$source = $news->clearStr($_POST['source']);
if (isset($_POST['title']) and isset($_POST['category']) and isset($_POST['description']) and isset($_POST['source'])) {
  if (!$news->saveNews($title, $category, $category, $source)) {
    $errMsg = "Ошибка при добавлении новости!";
  } else {
      header("Location: news.php");
  }
} else $errMsg = "Заполните все поля формы!";