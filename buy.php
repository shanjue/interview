<?php
  include('confs/config.php');

  $item_number = $_POST['item_number'];
  $qty = $_POST['qty'];

  session_start();

  switch ($item_number) {
    case '1':
      coke();
      break;

    case '2':
      pepsi();
    break;

    case '3':
      milktea();
      break;

    case '4':
      orangejuice();
      break;

    case '5':
      Coffee();
      break;

    default:
      // code...
      break;
  }
  function coke(){

    global $conn;
    global $qty;

    $coke_result = mysqli_query($conn, "SELECT * FROM machine WHERE id=1");
    $coke_row = mysqli_fetch_assoc($coke_result);

    $result_money = mysqli_query($conn,"SELECT * FROM user_money ");
    $user_money = mysqli_fetch_assoc($result_money);

    if($coke_row['qty'] > 0 && $user_money['money'] >= 100){

      $afterqty = $coke_row['qty']-$qty;
      mysqli_query($conn, "UPDATE machine SET qty='$afterqty' WHERE id=1");

      $left_money = $user_money['money'] - ($coke_row['price']*$qty);
      mysqli_query($conn, "UPDATE user_money SET money=$left_money");

      echo json_encode(["err"=>0]);
    }else{
      $_SESSION['err'] = "Sorry You Can't Buy it.";
    }


    header("location:index.php");

  }

  function pepsi(){

    global $conn;
    global $qty;

    $pepsi_result = mysqli_query($conn, "SELECT * FROM machine WHERE id=2");
    $pepsi_row = mysqli_fetch_assoc($pepsi_result);

    $result_money = mysqli_query($conn,"SELECT * FROM user_money ");
    $user_money = mysqli_fetch_assoc($result_money);

    if($pepsi_row['qty'] > 0 && $user_money['money'] >= 200){

      $afterqty = $pepsi_row['qty']-$qty;
      mysqli_query($conn, "UPDATE machine SET qty='$afterqty' WHERE id=2");

      $left_money = $user_money['money'] - ($pepsi_row['price']*$qty);
      mysqli_query($conn, "UPDATE user_money SET money=$left_money");
      unset($_SESSION['err']);
    }else{
      $_SESSION['err'] = "Sorry You Can't Buy it.";
    }


    header("location:index.php");

  }

  function milktea(){

    global $conn;
    global $qty;

    $milktea_result = mysqli_query($conn, "SELECT * FROM machine WHERE id=3");
    $milktea_row = mysqli_fetch_assoc($milktea_result);

    $result_money = mysqli_query($conn,"SELECT * FROM user_money ");
    $user_money = mysqli_fetch_assoc($result_money);

    if($milktea_row['qty'] > 0 && $user_money['money'] >= 250){

      $afterqty = $milktea_row['qty']-$qty;
      mysqli_query($conn, "UPDATE machine SET qty='$afterqty' WHERE id=3");

      $left_money = $user_money['money'] - ($milktea_row['price']*$qty);
      mysqli_query($conn, "UPDATE user_money SET money=$left_money");
      unset($_SESSION['err']);
    }else{
      $_SESSION['err'] = "Sorry You Can't Buy it.";
    }


    header("location:index.php");

  }

  function orangejuice(){

    global $conn;
    global $qty;

    $orangejuice_result = mysqli_query($conn, "SELECT * FROM machine WHERE id=4");
    $orangejuice_row = mysqli_fetch_assoc($orangejuice_result);

    $result_money = mysqli_query($conn,"SELECT * FROM user_money ");
    $user_money = mysqli_fetch_assoc($result_money);

    if($orangejuice_row['qty'] > 0 && $user_money['money'] >= 300){

      $afterqty = $orangejuice_row['qty']-$qty;
      mysqli_query($conn, "UPDATE machine SET qty='$afterqty' WHERE id=4");

      $left_money = $user_money['money'] - ($orangejuice_row['price']*$qty);
      mysqli_query($conn, "UPDATE user_money SET money=$left_money");
      unset($_SESSION['err']);
    }else{
      $_SESSION['err'] = "Sorry You Can't Buy it.";
    }


    header("location:index.php");

  }

  function Coffee(){

    global $conn;
    global $qty;

    $coffee_result = mysqli_query($conn, "SELECT * FROM machine WHERE id=5");
    $coffee_row = mysqli_fetch_assoc($coffee_result);

    $result_money = mysqli_query($conn,"SELECT * FROM user_money ");
    $user_money = mysqli_fetch_assoc($result_money);

    if($coffee_row['qty'] > 0 && $user_money['money'] >= 400){

      $afterqty = $coffee_row['qty']-$qty;
      mysqli_query($conn, "UPDATE machine SET qty='$afterqty' WHERE id=5");

      $left_money = $user_money['money'] - ($coffee_row['price']*$qty);
      mysqli_query($conn, "UPDATE user_money SET money=$left_money");
      unset($_SESSION['err']);
    }else{
      $_SESSION['err'] = "Sorry You Can't Buy it.";
    }


    header("location:index.php");

  }
?>
