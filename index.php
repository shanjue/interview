<!DOCTYPE html>
<?php include('confs/config.php'); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body{
        text-align: center;
        width:700px;
        border: 4px solid #ffff;
        background: #efefef;
        padding: 20px;
        position: absolute;
        top:10%;
        left:25%;
      }
      h2{
        margin: 0;
        padding: 0;
        border-bottom:1px solid black;
        line-height: 60px;
        margin-bottom: 30px;
      }
      h2 span{
        color:red;
      }
      table{
        border: 2px solid black;
        padding: 5px;
      }
      table th{
        border: 1px solid black;
      }
      table tr{
        margin: 5px;
      }
      table td{
        text-align: center;
        background: lightgreen;
        padding:5px 40px;
      }
      .alert{
        background-color: red;
      }
      .up{
        color: red;
      }
      .show-info span{
        color: red;
      }
    </style>
  </head>
  <body>


    <h2>Hi User! You Have <span id="money"><?php
                    $result = mysqli_query($conn, "SELECT * FROM user_money");
                    $money = mysqli_fetch_assoc($result);
                    echo $money['money'];
                  ?></span> kyats.
   </h2>

     <table id="table">
       <thead>
         <tr>
           <th>No</th>
           <th>Item</th>
           <th>price</th>
           <th>we have</th>
         </tr>
       </thead>
       <tbody>
         <?php
         $item_result = mysqli_query($conn, "SELECT * FROM machine");
         while($item_row = mysqli_fetch_assoc($item_result)):
         ?>
           <tr>
             <td><?php echo $item_row['id'] ?></td>
             <td><?php echo $item_row['name'] ?></td>
             <td><?php echo $item_row['price'] ?></td>
             <td><?php echo $item_row['qty'] ?></td>
           </tr>
        <?php endwhile; ?>
       </tbody>

    </table>


   <div class="alert">
     <?php
     session_start();
     if (isset($_SESSION['err'])) {
       echo $_SESSION['err'];
     }
     ?>

   </div>
   <div class="show-info">
     You Choose <span id="qty">0</span> bottle of <span id="item">something</span>.
   </div>
   <div class="buy">
     <input type="text" id="item_number">
     <input type="text" id="qty">

     <?php
       $item_result = mysqli_query($conn, "SELECT * FROM machine");
       while($item_row = mysqli_fetch_assoc($item_result)):
     ?>
      <button type="button" id="<?php echo $item_row['id'] ?>" value="<?php echo $item_row['id'] ?>"><?php echo $item_row['name'] ?></button>
     <?php endwhile; ?>

   </div>

   <div class="number">
     <button type="button" name="button" id="number">1</button>
     <button type="button" name="button" id="number">2</button>
     <button type="button" name="button" id="number">3</button>
     <button type="button" name="button" id="number">4</button>
   </div>

   <div class="ok">
     <input type="button" value="OK">
   </div>





  </body>
  <script src="jquery.js"></script>
  <script>
    $(document).ready(function(){
      $(function(){




        alert("welcome vending machine");
      });
      <?php
        $item_result = mysqli_query($conn, "SELECT * FROM machine");
        while($item_row = mysqli_fetch_assoc($item_result)):
      ?>
        $(".buy #<?php echo $item_row['id'] ?>").click(function(){
          var item_number = $(this).val();
          var item_name = "<?php echo $item_row['name'] ?>";

          $(".buy button").removeClass("up");
          $(this).addClass("up");

          $(".buy #item_number").val(item_number);

          $(".show-info #item").html(item_name);
        });
      <?php endwhile; ?>


      $(".number #number").click(function(){
        var qty = $(this).html();
        $(".number button").removeClass("up");
        $(this).addClass("up");
        $(".show-info #qty").html(qty);
        $(".buy #qty").val(qty);

      });

      $(".ok input").click(function(){
         var item_number = $(".buy #item_number").val();
         var qty = $(".buy #qty").val();
         $.post('buy.php',{item_number:item_number,qty:qty},function(res){
           console.log(res.err);
           $("#table").load(location.href + " #table");
           $("#money").load(location.href + " #money");

         });
      });

    });
  </script>
</html>
