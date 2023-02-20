<?php
function setConnect(){
    $conn = mysqli_connect("127.0.0.1", "jasom", "2156513", "bdWE");
    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }
    
    return $conn;
}
function checkAccount($login, $password){
    $conn = setConnect();

    $sql = "SELECT * FROM accounts WHERE name = '$login' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        $_SESSION['id'] = $data["id"];
        $_SESSION['name'] = $data["name"];
        $_SESSION['role'] = $data["role"];
        $_SESSION['logged'] = true;
        mysqli_close($conn);
        return true;
    } else {
        mysqli_close($conn);
        return false;
    }
}

function addButton(){
    return '
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Добавить мероприятие
    </button>
    
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создание</h5>
            </div>
            <div class="modal-body">

            <form action="" method="post">
            <div class="row mb-3">
            <label for="inputMainText" class=" col-sm-4 col-form-label">Заголовок</label>
            <div class="col-sm-10">
                <input type="text" class="mainText form-control" id="inputMainText" name="title">
            </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-4 col-form-label">Текст</label>
                <div class="col-sm-10">
                <input type="text" class="secondText form-control" id="inputText" name="text">
            </div>
            </div>
            <div class="row mb-3">
            <label for="inputUrl" class="col-sm-4 col-form-label">Изображение</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUrl" name="image">
            </div>
            </div>
    
            <div class="row mb-3">
            <label for="hrefReg" class="col-sm-4 col-form-label">Ссылка на регистрацию</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hrefReg" name="link">
            </div>
            </div>
            <br>

            <button type="submit" class="btn btn-primary" id="submitCreate" name="buttonEvent"> Отправить </button>
        </form>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
    
        </div>
        </div>
    </div>
    ';
}

function exitAccount(){
    session_destroy();
}

function checkAmountEvent(){
    $conn=setConnect();
    $sql = "SELECT * FROM events";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_num_rows($result);
}

function showEvent(){
    $conn=setConnect();
    $sql = "SELECT * FROM events where actual=1 order by id DESC";
    $result = mysqli_query($conn, $sql);
    $output ="";
    foreach ($result as $row) {
        $output=$output.'<div class="card col-4" style="width: 18rem;">
        <img src="'.$row["image"].'" class="card-img-top" alt="...">
        <div class="card-body">
            <div>
            <h5 class="card-title">'.$row["title"].'</h5>
            <p class="card-text">'.$row["text"].'</p></div>
                <a href="'.$row["link"].'"
            class="btn btn-primary">Записаться</a>
        </div>
        </div>
        ';
    }
    return $output;
}

function addEvent($title,$text,$image,$link){
    $conn=setConnect();
    $sql = 'insert into events(title,`text`,image,link,actual,account_id)
    values ("'.$title.'", "'.$text.'", "'.$image.'", "'.$link.'", true, '.$_SESSION["id"].')';
    if(mysqli_query($conn, $sql)){
        //success
        mysqli_close($conn);
        return true;
    }
    else{
        //failed
        mysqli_close($conn);
        return false;
    }
}
?>