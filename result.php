<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laba 5</title>
    <link media="all" rel="stylesheet" href="styles.css">
    <link media="all" rel="stylesheet" href="calculator.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic" type="text/css">
        <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
    <style>
      body {
        margin: 0;
        color: #7e7e7e;
        font: 17px/1.412 "Istok Web", "Arial", "Helvetica", sans-serif;
        background: #f9f9f9;
        overflow-y: scroll;
        min-width: 320px;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: none;
      }
    </style>
  </head>
  <body class="home-page">
    <div id="wrapper">
      <header id="header">
        <div class="panel">
          <div id='header-container' class="container">
            <strong class="logo"><a href="#">Laba 5</a></strong>
            <ul>
              <li><a href="#">Home</a></li>
            </ul>
          </div>
        </div>
        <div class="hero">
          <div class="img">
            <div class="s1">
              <div class="s2" style="background: url('images/banner.jpg') no-repeat 0 0; background-size: cover; width: 100%; height: 300px; display:flex; justify-content: center; align-items: center; color: #fff;">
                <h1>Лабораторное работа №5</h1>
              </div>
            </div>
          </div>

        </div>
        <div class="navigation">
          <nav>
            <ul>
              <li><a href="index.php">Поиск</a></li>
              <li class="active"><a href="#">Результаты поиска</a></li>
              <li><a href="#">Пункт 3</a></li>
              <li><a href="#">Пункт 3</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div id="main">

        <div id='var-7' class="container">
          <h1 class="hide">Разультаты поиска</h1>
          <div class="holder">
            <!-- Form login -->


            <div class="login-wrapper__each login-wrapper__each-2">
              <?php
              require_once __DIR__ . "/vendor/autoload.php";

              // Данные из формы запроса
              $name = $_POST['name'];
              $start_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];
              $author = $_POST['author'];
              ?>
              <div id="results-name" class="hide"><?php print $name . ',' . $author . ',' . $start_date . ',' . $end_date;?></div>

              <h2>Разультаты поиска (<?php print ($name == 'all' ? '' : $name) . ' ' . ($author == 'all' ? '' : $author) . ' ' . $start_date . '-' . $end_date; ?>)</h2>

              <?php
              try {
                $connection = new MongoClient();

                $db = $connection->dbforlab;
                $collection = $db->literature;

                $search1 = array();
                $search2 = array();
                $search3 = array();
                $search4 = array();
                
                if (isset($name) && $name !== 'all' && !empty($name)) {
                  $search2 = array('name' => $name);
                }
                if (isset($author) && $author !== 'all' && !empty($author)) {
                  $search3 = array('author' => $author);
                }
                if (!empty($start_date) && !empty($end_date)) {
                  $search4 = array('year' => array('$gt' => $start_date, '$lt' => $end_date));
                }
                
                $search = array_merge($search1, $search2, $search3, $search4);
                $stmt = $collection->find($search);
                ?>

                <table>
                  <thead>
                    <tr>
                      <td>Название</td>
                      <td>ISBN</td>
                      <td>Издание</td>
                      <td>Год выхода</td>
                      <td>Кол-во страниц</td>
                      <td>Автор</td>
                      <td>Тип издания</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($stmt as $row) { ?>
                      <tr>
                        <td><?php print($row['name']); ?></td>
                        <td><?php print($row['ISBN']); ?></td>
                        <td><?php print($row['publisher']); ?></td>
                        <td><?php print($row['year']); ?></td>
                        <td><?php print($row['quantity']); ?></td>
                        <td><?php print($row['author']); ?></td>
                        <td><?php print($row['literature']); ?></td>
                      </tr>

                    <?php } ?>

                  </tbody>
                </table>


              </div>

              <?php
              $stmt = null;
              $pdo = null;
            } catch (PDOException $e) {
              //выводим ошибку
              print "Error!: " . $e->getMessage() . "<br/>";
            }
            ?>






           

          </div>
        </div>
      </div>
      <footer id="footer">
        <ul>
          <li>© Copyright 2021 Maxim</li>
        </ul>
      </footer>
    </div>
    <script src="scripts.js"></script>
  </body>
</html>
