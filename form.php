<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Pig Latin translator</title>

      <link rel="stylesheet" type="text/css" href="css/p2.css">
      
  </head>
    
  <body>
      
            <!--PHP starts -->
            <?php
      
                $usertext = $_GET['usertext'];
                $words = explode(' ', $usertext);

            ?>
            <!--PHP ends -->
      
      <h1>Pig Latin translator</h1>
      
      <form method='get' action='form.php'>

        <p id="directions">Type into the box below and your words will translate into Pig Latin.</p>
          
          <!-- Input text box -->
          <h2>Type text to translate here:</h2>
          <textarea name="usertext" rows="6" cols="70"><?php echo $usertext;?></textarea>
          
          <!-- Suffix -->
          <h2>Suffix:</h2>
            <input type="radio" name="suffix" value="ay" checked> "ay"<br>
            <input type="radio" name="suffix" value="a"> "a"<br>
          
          <!--Optional rules -->
          <h2>Optional rules:</h2>
            <input type="checkbox" name="threeletter" value="yes" checked> Words that are shorter than 3 characters are unchanged (Example: "be" = "be")<br><br><br>
          
          <input id="submit" type="submit" value="Translate">
          
            <!--PHP starts -->
            <?php
                // echo $usertext;
                foreach ($words as $word) {
                    if (isset($_GET['threeletter'])) {
                        if (strlen($word) > 3) {
                            $translatedword = substr($word, 1);
                            echo $translatedword . $word[0] . $_GET["suffix"] . ' '; 
                            } else {
                            echo $word . ' ';   
                        }
                    } else {
                        echo $word . $_GET["suffix"] . ' '; 
                    }
                }
            ?>
            <!--PHP ends -->
          
      </form>
      
  </body>
    
</html>