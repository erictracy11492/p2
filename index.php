<?php require('Form.php');
use DWA\Form; ?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Pig Latin translator</title>

      <link rel="stylesheet" type="text/css" href="css/p2.css">
      
  </head>
    
  <body>
      
      <h1>Pig Latin translator</h1>
      
      <form method='get' action='index.php'>

        <p id="directions">Type into the box below and your words will translate into Pig Latin.</p>
          
          <!-- Input text box -->
          <h2>Type text to translate here:</h2>
          <p id="beforewarning">*Letters and spaces only</p>
          <textarea name="usertext" rows="6" cols="70"></textarea>
          
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
                $form = new Form($_GET);
                
                if ($form->isSubmitted()) {
                    
                    #Retrieve data from form
                    $usertext = $form->get('usertext', ''); //$_GET
                    $words = explode(' ', $usertext);
                    
                    #Validate - example uses 'required,' I would like to use 'alpha'
                    $errors = $form->validate([
                        'usertext' => 'alpha'
                    ]);
                    
                    if (empty($errors)) {
                        foreach ($words as $word) {
                            $translatedword = substr($word, 1);
                            $vowels = str_split('aeiou');
                            //if (in_array($translatedword, $vowels))
                            if (isset($_GET['threeletter'])) {
                                if (strlen($word) > 3) {
                                    if (in_array($word[0], $vowels)) {
                                        echo $word . 'w' . $_GET["suffix"] . ' ';
                                    } else {
                                        echo $translatedword . $word[0] . $_GET["suffix"] . ' '; 
                                    }
                                        } else {
                                            echo $word . ' ';   
                                        }
                            } else {
                                if (in_array($word[0], $vowels)) {
                                    echo $word . 'w' . $_GET["suffix"] . ' ';
                                } else {
                                    echo $translatedword . $word[0] . $_GET["suffix"] . ' ';  
                                }
                            }
                        }
                    }
                }
            ?>
            <!--PHP ends -->
   
            <!-- error display -->
            <?php if (!empty($errors)) : ?>
                <div class='afterwarning'>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?=$error?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif ?>
          
      </form>
      
  </body>
    
</html>