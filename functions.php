<?php
    //enable php to display any error
    ini_set('display_errors','1');
    
    //Student Name: Hoanh Vo
    //http://ecs.fullerton.edu/~cs431s24/hotel-app/
    //access database: ecs.fullerton.edu/~cs431s24/phpMyAdmin/

     

    //function executes the query ===================================================================================
    //the function open conection to database and run the parameter query
    function executeQuery($query)
    {
        
    //==insert into the database======
    //connecting to the database ============================
        @$db = new mysqli('localhost:9000', 'root', 'root', 'test');

        if (mysqli_connect_errno()) {
            echo "<p>Error: Could not connect to database.<br/>
                Please try again later.</p>";
            exit;
        }

        $result = mysqli_query($db, $query);
        echo "Query: ran successfully!";
        $db->close();
        return $result;  
    }


    //get meta data into multi--array========================
    function tranfertoArray($metadata)
    {
        //try catch the case that database is empty
        try
        {
            $allPhotoInfoCheck = mysqli_num_rows($metadata);
            if($allPhotoInfoCheck <= 0 )
            {
            throw new Exception("The database is empty!");
            }
        }
        catch(Exception $e)
        {
        echo 'Message: '.$e->getMessage();
        // exit; When the data is empty -> print out the mesage and keep running the scrip 
        }
        
        $i = 0; //for inserting into multiarray
        //mysqli_fetch_assoc get data in each row and insert into array $row
        //$row['name']; $row['date']
        while($row = mysqli_fetch_assoc($metadata))
        {
        //create a-combine-array of the photo and the info array
        $multArrayRooms[$i] = $row; //store all the data from database
        $i++;
        } 
        return  $multArrayRooms;                                              
    }

     //rendering rooms array to webpage======================================================================
     function render_room_array($array){
        for($row = 0; $row < count($array); $row++){         
          echo "
                <tr class='gradeX'>
                <td>".$array[$row]['roomNumber']."</td>
                <td>".$array[$row]['roomType']."</td>
                <td>".$array[$row]['available']."</td>
                <td>".$array[$row]['status']."</td>
                <td>$".$array[$row]['ratePerDay']."</td>
                </tr>             
              ";
        }
    }
     //rendering 7days rooms array to webpage======================================================================
     function render_7dayroom_array($array){
         //variables for printout next 7 days 
    
     $week = 0;
     $week_first_date = date('Y-m-d',strtotime("-".(0-$week). " days"));    
        for($row = 0; $row < count($array); $row++){         
          echo "
                <tr class='gradeX'>
                <td>".$array[$row]['roomNumber']."</td>";
                for($j = 0; $j <=6; $j++)
                {
                    $temp_date = date('Y-m-d',strtotime($week_first_date."+".$j." days"));
                                                   
                    if($array[$row]['checkinDate'] <=  $temp_date &&  $temp_date <= $array[$row]['checkoutDate'] )
                   {
                    echo "<td>".$array[$row]['firstName']."</td>";
                   }else
                   {
                    echo "<td> </td>";
                   }
                }   
            echo "</tr>";    
        }
    }
    function render_search_array($array){
   
        for($row = 0; $row < count($array); $row++){         
            echo "
                <tr class='gradeX'>
                <td>".$array[$row]['firstname']."</td>
                <td>".$array[$row]['lastname']."</td>
                <td>".$array[$row]['roomNumber']."</td>
                <td>".$array[$row]['phone']."</td>
                <td>".$array[$row]['address']."</td>
                <td>".$array[$row]['checkinDate']."</td>
                <td>".$array[$row]['checkoutDate']."</td>
                </tr>
                "; 
        }
    }

    function render_daily_array($array){
   
        for($row = 0; $row < count($array); $row++){         
            echo "
                <tr class='gradeX'>
                    <td>".$array[$row]['roomNumber']."</td>
                    <td>".$array[$row]['firstname']." ".$array[$row]['lastName']."</td>
                    <td>".$array[$row]['checkinDate']."</td>
                    <td>".$array[$row]['checkoutDate']."</td>
                    <td>".$array[$row]['paymentMade']."</td>
                </tr>
                "; 
        }
    }

    function render_daily_total_array($array){
        $total_earned = 0;
        for($row = 0; $row < count($array); $row++){         
                $total_earned = $total_earned + $array[$row]['paymentMade'];
        }
        echo "
        <tr class='gradeX'>
            <td>".$total_earned."</td>
        </tr>
        ";
    }

    //rendering guests array to webpage======================================================================
     function render_guests_array($array){
        for($row = 0; $row < count($array); $row++){         
          echo "
                 <tr class='gradeX'>
                <td>".$array[$row]['firstName']."</td>
                <td>".$array[$row]['lastName']."</td>
                <td>".$array[$row]['phone']."</td>
                <td>".$array[$row]['address']."</td>
                <td>".$array[$row]['email']."</td>
                <td>".$array[$row]['stateID']."</td>
                <td>".$array[$row]['licensePlate']."</td>
                </tr>      
              ";
        }
    }

    //render current stay to webpage==========================================================================
    function render_total_array($array){
          for($row = 0; $row < count($array); $row++){         
            echo "
                <tr class='gradeX'>
                    <td>".$array[$row]['firstName']." ".$array[$row]['lastName']."</td>
                    <td>".$array[$row]['checkinDate']."</td>
                    <td>".$array[$row]['checkoutDate']."</td>
                    <td>".$array[$row]['roomType']."</td>
                    <td>".$array[$row]['roomNumber']."</td>
                    <td>".$array[$row]['ratePerDay']."</td>
                </tr>
                "; 
        }

    }
    //function for total pay
    //function render_totalpay_array($array){
    //    $total_day = 0;
   //     $total_pay = 0;
   //     //total pay
   //     for($row = 0; $row<count(array);$row++){
  //          $total_day = $array[$row]['checkinDate'] -> diff($array[$row]['checkoutDate'])
  //          $total_pay = $total_day -> days * $array[$row]['ratePerDay']
    //    }
    //    echo "
    //    <tr class='gradeX'>
    //        <td>".$total_pay."</td>
    //    ";
  //  }
    
    //function to count balance
    //balance = length of stay * ratePerDay - paymentMade.
    function render_balance_array($array){
        //$balance = 0;
        //balance
        for($row =0; $row<count(array);$row++){
            //the date from sql will be string
            $date1 = $array[$row]['checkinDate'];
            $date2 = $array[$row]['checkoutDate'];
            //convert from MySQL datetime to php format
                $diff = abs(strtotime($date1)-strtotime($date2));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                //total days
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                //find out the total_charge
                $PerDay = $array[$row]['ratePerDay'];
                $total_charge = $days * $PerDay;
           
            //total_day->days only come out the days
            $payment = $array[$row]['paymentMade']
            $balance = $total_charge-$payment;
              echo "
                <tr class='gradeX'>
                    <td>".$total_charge."</td>
                    <td>".$array[$row]['paymentMade']."</td>
                    <td>".$balance."</td>
                </tr>
                ";
        }

    }

?>
