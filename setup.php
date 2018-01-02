<?php
    ob_start();
    $settings = json_decode(file_get_contents("php/.conf.json"), true);
    $ip = $settings['ip'];
    $sharefoldername = $settings['sharefoldername'];
    $username = $settings['username'];
    $password = $settings['password'];
    $location_id = $settings['location_id'];

    if($ip != "" || $sharefoldername != "" || $username != "" || $password != "" || $location_id != ""){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Setup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/removeDefault.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <div id="container">
        <div id="middleBody">
            <div id="top"></div>
            <div id="header">
                <div class="left logo">
                    <img class="left" src="image/logo.png" height="55px" width="160px">
                </div>
                <div class="right menuOptions">
                    <div class="menu">Setup</div>
                </div>
                <div class="clear"></div>
                <div class="allMenu">
                    <div class="menuContainer">
                        <div class="settings subMenu">
                            <form class="settingsForm" action="settings.php" method="post">
                                <div>Locations Details.</div><br/>
                                <div class="addInputArea afterClear">
                                    <?php
                                        include 'php/connection.php';
                                        $query = "SELECT id,name FROM locations WHERE deleted_at IS NULL";
                                        $result = $db->query($query);
                                        $opt = "<option value=\"\">Select Location</option>";
                                        while ($row = $result->fetch_assoc()) {
                                            $opt .= "<option value=".$row['id'].">".$row['name']."</option>";
                                        }
                                    ?>
                                    <select class="settingtextInput" name="location_id">
                                        <?php echo $opt; ?>
                                    </select>
                                </div>
                                <div>Network Drive Connection Details.</div><br/>
                                <div class="addInputArea afterClear">
                                    <input type="text" class="settingtextInput" name="ip" placeholder="IP Ex. 192.168.0.0" autocomplete="off" spellcheck="false" />
                                </div>
                                <div class="addInputArea afterClear">	
                                    <input type="text" class="settingtextInput" name="sharefoldername" placeholder="Shared Folder Name" autocomplete="off" spellcheck="false" />
                                </div>
                                <div class="addInputArea afterClear">
                                    <input type="text" class="settingtextInput" name="username" placeholder="Username" autocomplete="off" spellcheck="false" />
                                </div>
                                <div class="addInputArea afterClear">
                                    <input type="text" class="settingtextInput" name="password" placeholder="Password" autocomplete="off" spellcheck="false" />
                                </div>
                                <input class="button" type="submit" id="testConnection" value="Test Connection" name="testconnection" />
                                <input class="button hidden" type="submit" id="save" value="Save" name="addsaveto" />
                            </form>
                        <div class="loading hidden"><img src="image/loading.gif" width="35" height="35"></div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // settings menu
            var settingsForm = document.querySelector('.settingsForm');
            settingsForm.addEventListener( 'submit', settingsFormSubmitHandler, false );

            function settingsFormSubmitHandler( event )
            {
                event.preventDefault();
                var form = this;
                form.nextElementSibling.classList.remove( 'hidden' ); // loading gif visible
                var settingsBlock = this.parentNode.parentNode; // changing height of div
                settingsBlock.style.height = bufferHeight( settingsBlock )+'px';
                var location_id = form.querySelector('select[name="location_id"]').value;
                var ip = form.querySelector('input[name="ip"]').value;
                var username = form.querySelector('input[name="username"]').value;
                var password = form.querySelector('input[name="password"]').value;
                var sharefoldername = form.querySelector('input[name="sharefoldername"]').value;
                
                var request = new XMLHttpRequest();
                request.open( 'POST','php/settings.php');
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                request.onerror = function( event ){
                    // display error
                };
                
                request.onreadystatechange = function(){
                    if( request.readyState === 4 && request.status === 200 ){
                        var response = JSON.parse( request.response );
                        if( response.hasOwnProperty( "error" ) ){
                            form.nextElementSibling.classList.add( 'hidden' );
                            settingsBlock.style.height = bufferHeight( settingsBlock )+'px';
                            document.title = response.error;
                            // show error dialog box
                            alert( 'Error : '+response.error );
                        }
                        else{
                            // hiding loading gif
                            form.nextElementSibling.classList.add( 'hidden' );
                            // making height zero of div
                            form.parentNode.parentNode.classList.remove('block');
                            form.parentNode.parentNode.classList.add('zeroHeight');
                            form.parentNode.parentNode.style.cssText = "";
                            form.reset();
                            window.location = "index.php"
                        }
                    }
                };
                request.send("cmd=save&ip="+ip+"&username="+username+"&password="+password+"&sharefoldername="+sharefoldername+"&location_id="+location_id+"");
            }

            // settings menu
            var testConnection = document.querySelector('#testConnection');
            testConnection.addEventListener( 'click', testConnectionSubmitHandler, false );

            function testConnectionSubmitHandler( event )
            {
                event.preventDefault();
                var form = this.parentNode;
                form.nextElementSibling.classList.remove( 'hidden' ); // loading gif visible
                var settingsBlock = this.parentNode.parentNode.parentNode.parentNode; // changing height of div
                settingsBlock.style.height = bufferHeight( settingsBlock )+'px';
                var location_id = form.querySelector('select[name="location_id"]').value;
                var ip = form.querySelector('input[name="ip"]').value;
                var username = form.querySelector('input[name="username"]').value;
                var password = form.querySelector('input[name="password"]').value;
                var sharefoldername = form.querySelector('input[name="sharefoldername"]').value;
                var request = new XMLHttpRequest();
                request.open( 'POST','php/settings.php');
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                request.onerror = function( event ){
                    // display error
                };
                
                request.onreadystatechange = function(){
                    if( request.readyState === 4 && request.status === 200 ){
                        var response = JSON.parse( request.response );
                        if( response.hasOwnProperty( "error" ) ){
                            form.nextElementSibling.classList.add( 'hidden' );
                            settingsBlock.style.height = bufferHeight( settingsBlock )+'px';
                            document.title = response.error;
                            // show error dialog box
                            alert( 'Error : '+ response.error );
                        }
                        else{
                            console.log(response);
                            // hiding loading gif
                            form.nextElementSibling.classList.add( 'hidden' );
                            form.querySelector('#save').classList.remove('hidden');
                            alert(response.data);
                        }
                    }
                };
                request.send("cmd=test&ip="+ip+"&username="+username+"&password="+password+"&sharefoldername="+sharefoldername+"&location_id="+location_id+"");
            }
            function bufferHeight( elt, container ){
                container = container || document.body;
                var tempElt = elt.cloneNode( true );
                tempElt.classList.remove('zeroHeight');
                tempElt.style.cssText = "position:fixed; top:0px; left:0px";
                container.appendChild( tempElt );
                var height = tempElt.offsetHeight;
                container.removeChild( tempElt );
                return height;
            }
        </script>
    </body>
</html>