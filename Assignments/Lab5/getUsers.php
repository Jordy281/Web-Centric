//  This will return all users in the database in a table

<?php
    //connect to database
    require_once('../mysqli_connect');
    
    //Define query
    $query="SELECT firstName, lastName, email, password, streetAddress, postalCode, DOB, gender FROM users";
    
    //execute query
    $response= @msqli_query($dbc, $query);
    
    //print graph
    if($response){
        echo '<table class="tg">
            <tr>
                <th class="tg-9hbo">id</th>
                <th class="tg-9hbo">First Name<br></th>
                <th class="tg-9hbo">Last Name<br></th>
                <th class="tg-9hbo">Email</th>
                <th class="tg-9hbo">Password</th>
                <th class="tg-9hbo">Address<br></th>
                <th class="tg-9hbo">Postal Code<br></th>
                <th class="tg-9hbo">DOB<br></th>
                <th class="tg-9hbo">Gender</th>
            </tr>';

        while($row=mysqli_fetch_array($response)){
            echo '<tr><td align="left">'.
            $row[id].'</td><td align="left">'.
            $row[firstName].'</td><td align="left">'.
            $row[lastName].'</td><td align="left">'.
            $row[email].'</td><td align="left">'.
            $row[password].'</td><td align="left">'.
            $row[streetAddress].'</td><td align="left">'.
            $row[postalCode].'</td><td align="left">'.
            $row[DOB].'</td><td align="left">'.
            $row[gender].'</td></tr>';
        }
        echo '</table>';
    }else{
        echo 'No query';
        echo mysqli_error($dbc);
    }
    
    //close connection
    mysqli_close($dbc);
    
?>