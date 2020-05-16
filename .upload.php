
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8"> 
        <meta name="description" content=""> 
        <meta name="author" content="Joshua Neizer">  
        <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
        <link rel="stylesheet" type="text/css" href="A3.css"> 
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="shortcut icon" href="https://images.baxterboo.com/global/images/products/large/dog-emoji-car-window-decal-7839.png">
        <title>Dog ML Model.</title> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

        <script>   
            $(window).on('beforeunload', function() {
                "<?php $server['ip'] = "192.168.2.64"; 	// IP des Servers
                $server['sshport'] = 22;   		// SSH Port (Standart: 22)
                $server['user'] = "pi"; 		// Benutzername
                $server['pw'] = "room355"; 		// Passwort des Benutzers

                $command = "cd /home/pi/html/.MLApp && sudo rm " . substr($fileName, 0, -4) . " -R";
           

                // ab hier wenn m�glich nichts mehr veraendern
                if($ssh = ssh2_connect($server['ip'], $server['sshport'] )) {
                    if(ssh2_auth_password($ssh, $server['user'], $server['pw'])) {
                        $stream = ssh2_exec($ssh, $command);
                        stream_set_blocking($stream, true);
                        $data = '';
                        while($buffer = fread($stream, 4096)) {
                            $data .= $buffer;
                        }
                        fclose($stream);
                        print $data;
                    }else {
                        echo "Fehler: Es konnte keine Verbindung zum ausgew&auml;hlten Server hergestellt werden. Benutzername oder Passwort falsch.";
                    }
                }else {
                        echo "Fehler: Es konnte keine Verbindung zum ausgew&auml;hlten Server hergestellt werden. Server-IP oder SSH Port falsch.";
                } ?>"
            });
            
            
        </script>
    </head>
    <!-- onload="displayPic('<?php echo substr(basename($_FILES["fileToUpload"]["name"]), 0, -4) . "/" . basename($_FILES["fileToUpload"]["name"]); ?>')" -->
    <body id='one'>
        <div id ="top">
            <div id = "banner-cover">  
                <div id = "titlebar">
                    <div style="padding-left: 0px; padding: 25px 0px 0px 20px; float: left; color: black; font-weight: bold; font-size: 40px;">Dog ML Model.</div> 
                    <table class="tb">
                        <tr>
                            <td class="titlebar"><a class ="titlebar" href="http://192.168.2.64/.MLApp">Home</a></td>
                            <td class="titlebar"><a class ="titlebar" href="#two">Results</a></td>
                            <td class="titlebar"><a class ="titlebar" href="#one">Top</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="mainContainer">
        <h1 style="font-size: 90px;font-weight: 300;margin-top: 40px;text-transform: uppercase;letter-spacing: 43px;">breed analyzer</h1>
            <div class="imageHolder"><?php echo "<img src='DogInfoFolders/". substr(basename($_FILES["fileToUpload"]["name"]), 0, -4) . "/" . basename($_FILES["fileToUpload"]["name"]) . "' style='box-shadow: 3px 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border: 4px solid black; width: 700px;'>";  ?></div>
            <h1 style="padding-top: 20px; text-transform: uppercase; letter-spacing: 2px;">Results</h1>
            <div class="doggyResult" style="margin-top: -10px; letter-spacing: 2px;  text-transform: uppercase;">
                <span class="dogName" style="font-size: 19px; font-weight: bold; color: grey;">Breed Match</span>
                <span class="dogPercent" style="font-size: 19px; font-weight: bold; color: grey;">Breed Percent</span>
            </div>
            <?php
                $target_dir = "";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        echo "";//"File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "<br>";//"The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

                $server['ip'] = "192.168.2.64"; 	// IP des Servers
                $server['sshport'] = 22;   		// SSH Port (Standart: 22)
                $server['user'] = "pi"; 		// Benutzername
                $server['pw'] = "room355"; 		// Passwort des Benutzers

                $fileName = basename( $_FILES["fileToUpload"]["name"]);  

                $command = " sh ~/html/.MLApp/script.sh ". $fileName ." ". substr($fileName, 0, -4); 
           

                // ab hier wenn m�glich nichts mehr veraendern
                if($ssh = ssh2_connect($server['ip'], $server['sshport'] )) {
                    if(ssh2_auth_password($ssh, $server['user'], $server['pw'])) {
                        $stream = ssh2_exec($ssh, $command);
                        stream_set_blocking($stream, true);
                        $data = '';
                        while($buffer = fread($stream, 4096)) {
                            $data .= $buffer;
                        }
                        fclose($stream);
                        print $data;
                    }else {
                        echo "Fehler: Es konnte keine Verbindung zum ausgew&auml;hlten Server hergestellt werden. Benutzername oder Passwort falsch.";
                    }
                }else {
                        echo "Fehler: Es konnte keine Verbindung zum ausgew&auml;hlten Server hergestellt werden. Server-IP oder SSH Port falsch.";
                }

                $textFile = "DogInfoFolders/" . substr($fileName, 0, -4) . "/" . substr($fileName, 0, -4) . "_New.txt";
                $myfile = fopen($textFile, "r") or die("Unable to open file!");               
                if ($myfile) {
                    while (($line = fgets($myfile)) !== false) {
                        $line = explode (" ", $line);
                        echo "<div class='doggyResult'>" . "<span class='dogName'>" . "<a class='dogName' target='_blank' href='https://www.google.com/search?q=" . join( " ", array_slice($line, 0, -1)) . " Dog'>" . join( " ", array_slice($line, 0, -1)) . "</a>" .'</span>' . "<span class='dogPercent'>" . array_values(array_slice($line, -1))[0] . "</span>" . "</div>";
                    }
                    echo "\r\n" . nl2br("<br>");
                    echo nl2br("<br>");
                    echo nl2br("<br>");
                    fclose($myfile);
                } else {
                    // error opening the file.
                } 
            ?>
        <div id="two"></div>
        </div>
        
        
        
            
        <script>
          // Select all links with hashes
            $('a[href*="#"]')
              // Remove links that don't actually link to anything
              .not('[href="#"]')
              .not('[href="#0"]')
              .click(function(event) {
                // On-page links
                if (
                  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                  && 
                  location.hostname == this.hostname
                ) {
                  // Figure out element to scroll to
                  var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                  // Does a scroll target exist?
                  if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                      scrollTop: target.offset().top
                    }, 1000, function() {
                      // Callback after animation
                      // Must change focus!
                      var $target = $(target);

                    });
                  }
                }
      });

      $(window).scroll(function () {
  var s = $(window).scrollTop(),
        d = $(document).height(),
        c = $(window).height();
        scrollPercent = (s / (d-c)) * 100;
        var position = scrollPercent/100;
        console.log(position)
   $("#top").attr('style', "background: rgba(255, 255, 255, " + position + ");");

});
          //# sourceURL=pen.js


        </script>
        
    </body>
</html>
