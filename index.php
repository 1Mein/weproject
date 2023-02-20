<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <script src="js/script.js" defer></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normilize.css">
  <link rel="stylesheet" href="css/reset.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/we-logo.jpg" type="image/png">
  <title>We - Главная</title>
</head>

<?php
  include('php\functions.php');
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST["buttonLogin"])){
      if(checkAccount($_POST["login"],$_POST["password"])){
        echo $_SESSION["id"]." connection is success";
      }
      else{
?>
<style>
  <?php
    echo "
      #inputEmail3 {
        border: 2px solid red;}
      #inputPassword3{
        border: 2px solid red;
      }" 
  ?>
</style>
<?php
      }
    }
    if(isset($_POST["buttonExit"])){
      exitAccount();
      echo '<script type="text/javascript">window.location.href = "http://localhost:3000/6/index.php";</script>';
    }
    if(isset($_POST["buttonEvent"])){
      if(addEvent($_POST["title"],$_POST["text"],$_POST["image"],$_POST["link"])){
        echo 'data success added';
      }
      else{
        echo 'fail add data';
      }
      echo '<script type="text/javascript">window.location.href = "http://localhost:3000/6/index.php";</script>';
    }
  }
?>



<body data-bs-spy="scroll" data-bs-target="#navigation">
  <div class="container-fluid">
    <nav class="navbar fixed-top" id="navigation">
      <div class="container-fluid brandMg">
        <a class="navbar-brand" href="#"><img src="img/we-logo.jpg" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
          </div>
          <div class="offcanvas-body" id="navApp">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" id="Main" aria-current="page" href="#">Главная</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#news">Мероприятия</a></li>

              <li class="nav-item"><a class="nav-link" href="#">Набор в команду</a></li>

              <li class="nav-item"><a class="nav-link" href="#">О нас</a></li>
              <br>
              <br>
              <li>
                <?php
                  if(isset($_SESSION["logged"]) && $_SESSION["logged"]==true){
                    echo '<form action="" method="post"><button type="submit" class="btn btn-primary" name="buttonExit">Выйти</button></form>';
                  }
                  else{
                    echo '<div class="loginhidden">
                    <p>
                      <a class="btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        Войти в аккаунт
                      </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">
                        <form action="" method="post">
                          <div class="row mb-3">
                            <div class="errorOut"></div>
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Логин</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputEmail3" name="login">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Пароль</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputPassword3" name="password">
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary" id="Login" name="buttonLogin">Войти</button>
                        </form>
                      </div>
                    </div>
                  </div>';
                  }
                ?>
              </li>
            </ul>

          </div>
        </div>
      </div>

    </nav>

    //carousel

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="black"></div>
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="img/carouselFirst.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>Рост</h5>
            <p>Мы стремимся создать комьюнити в котором будем вместе расти и помогать друг другу</p>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="img/carouselSecond.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption  d-md-block">
            <h5>Атмосфера</h5>
            <p>В нашей команде царит инженерная, дружная атмосфера</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/carouselThird.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>Активность</h5>
            <p>Мы являемся организаторами многих масштабных мероприятий, проходивших в SDU</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Следующий</span>
      </button>
    </div>


    <div class="container news row" id="news">
      <span> Мероприятия </span>

      <?php
        echo showEvent();
      ?>

    </div>


    <div class="forButton">
      <?php
        if(isset($_SESSION["logged"]) && $_SESSION["logged"]==true){ //&& $_SESSION["role"]
          echo addButton();
        }
      ?>
    </div>

  </div>


</body>

</html>