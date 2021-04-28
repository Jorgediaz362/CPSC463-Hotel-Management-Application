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
        @$db = new mysqli('mariadb', 'cs431s24', 'eiY2ahm1', 'cs431s24');

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

    //rendering guests array to webpage======================================================================
     function render_guests_array($array){
        for($row = 0; $row < count($array); $row++){         
          echo "
                 <tr class='gradeX'>
                <td>".$array[$row]['firstname']."</td>
                <td>".$array[$row]['lastname']."</td>
                <td>".$array[$row]['stateID']."</td>
                <td>".$array[$row]['phone']."</td>
                <td>".$array[$row]['email']."</td>
                <td>".$array[$row]['address']."</td>
                <td>".$array[$row]['licensePlate']."</td>
                </tr>      
              ";
        }
    }

?>
