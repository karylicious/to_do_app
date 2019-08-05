<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> WishList </title>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"></script>
        
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">    
        <link href = "https://fonts.googleapis.com/css?family=Lobster" rel = "stylesheet">
        <link rel = "stylesheet" href = "http://localhost/ci/static/style.css">
    </head>

    <body>        
        <div class = "container-fluid" >
            <div class = "row effectShadow">                
                <div id = "topDiv">
                    <div class = "centered"> WishList </div>
                </div>              
            </div>
            <div class = "container-fluid" >            
                <div class = "row" style = "margin-top:80px;">
                    <div class = "col-sm-2" style="text-align: center;">
                        <img src = "https://image.freepik.com/free-icon/user_318-123134.jpg" height ="100px" width="100px"/>
                        <br><br>
                        <p style = "font-weight: bold;"> <?php echo  $user . " (owner)"; ?> </p>
                    </div>
                    <div class = "col-sm-9">
                        <h1> <?php echo  $list["title"]; ?> </h1> 
                        <p style = "font-style: italic;"> <?php echo  $list['description']; ?> </p> 
                    </div> 
                </div>
            </div>
            <div style = "height: 70vh;">
                <?php             
                if ( $items != false ) {
                    for ( $index = 0; $index < count ( $items ); $index++ ) {
                        echo '<div id = "divItemArea" class = "row effectShadow">'; 
                        echo '<div class = "col-sm-2">'; 
                        echo '<img src = "https://www.freeiconspng.com/uploads/no-image-icon-15.png" height = "150px" width = "150px"  />'; 
                        echo '</div>'; 
                        echo '<div class = "col-sm-5" style = "margin-top:50px;">'; 
                        echo '<p id = "p_itemTitle">' . $items[ $index ][ "item_title" ] .' - &pound' . $items[ $index ][ "item_price" ] . '</p>'; 
                        echo '<p>Purchase it from <a href = "' . $items[ $index ][ "item_url" ] .'">' . $items[ $index ][ "item_url" ] .'</a> </p>'; 
                        echo '<p>Priority: ' . $items[ $index ][ "priority_name" ] .'</p>';                          
                        echo '<br>'; 
                        echo '</div>';         
                        echo '</div><br>'; 
                    }
                }
                else {
                    echo "There is no items in this list.";
                }
                ?>
            </div>
        </div>
    </body>
</html>