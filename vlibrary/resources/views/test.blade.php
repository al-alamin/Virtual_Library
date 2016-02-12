<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>



</head>
<body>


  <h2>Add new book to your collection</h2>
  <form action="http://localhost/laravel/vlibrary/public/index.php/addbook" method="POST" class="form-horizontal">
  
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <br> <br>
    <button type="submit" id="submit" class="btn btn-default">Add This Book</button>

  </form>
  <?php
  	echo "in test controller with value " ;

  	var_dump($namee);
  	foreach ($namee as $user) {
                    //    echo $user->Name . "<br>" ;
                        var_dump($user);

                         echo $user ;                      
                         
                        
                    }
  ?>


</body>
</html>
