<!-- 
    
2. Užduotis

Sukurkite katalogų ir failų išvedimui skirtą internetinę sistemą.

+ 1. Užkrovus pirmą puslapį turi būti atvaizduojamas tam tikro katalogo turinys (jame esantys katalogai ir failai).
+ 2. Paspaudus ant katalogo turi atsidaryti (tame pačiame puslapyje) to katalogo turinys (katalogai ir failai).

Paspaudus ant failo atliekami tokie veiksmai:

- 3. jei failas .txt, .php, .ini naujame lange atsidaro text area kurioje galima koreguoti failą ir jį išsaugoti

- 4. Visame failų sąraše taip pat turi būti mygtukai - redaguoti, ištrinti  (mygtukas redaguoti turi atlikti tą patį ką ir paspaudus ant failo pavadinimo), paspaudus mygtuką ištrinti failas ištrinamas.

- 5. Po failų sąrašu turi būti atvaizduota forma skirta sukurti naują katalogą (katalogas sukuriamas esamame kataloge).

+ 6. Padarykite taip, kad failų sąraše atitinkamiem failam būtų įdėtos skirtingos piktogramos.

- 7. Puslapio viršuje turi būti paieškos laukelis kuriame įvedus failo pavadinimą rekursinių funkcijų pagalba būtų atliekama failų paieška serveryje.

-->





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-lg mb-3" style="background-color: #c3e49a;">
      <div class="container-fluid">
        <a class="navbar-brand h1 ps-3" href="#">File Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
          aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <img src="img/home.svg" alt="" width="40" height="34" class="d-inline-block align-text-top">
              </a>
            </li>
          </ul>
          <form class="d-flex pe-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <div class="ms-4">
      <?php

      $child_dir="";
      function printDir($dir){
        echo "<ul>";
        //$size=0;
        $result['size'] = 0;
        $result['count'] = 0;
        $d = opendir($dir);
       

        $child_dir="";

        while ($item = readdir($d)) {
          if ($item == '.' || $item == '..') {
            continue;
          }
          if (is_dir($dir . '/' . $item)) {       //folderis, tikrinam ar folderis
            //vaiksčioti per folderius
            $child_dir = "";
            if (isset($_GET['dir'])) {
                $child_dir = $_GET['dir'];
            }
            $base_dir = 'http://localhost/php/pask-8-nd/uzd-2.php?dir=' . $child_dir;
            echo "<li><a href=" . $base_dir . '/' . $item . "><img src='http://localhost/php/pask-8-nd/img/folder_icon.svg' style='width: 32px;'><b>$item</b></a>";
            echo "</li>";



          /*  
          $tmp=printDir($dir."/".$item);     //sub-folderis, tikrinam ar subb  - Rekursija
          
          $result['size']+=$tmp['size'];     //paima dydi, grazina i masyva
          $result['count']+=$tmp['count'];   //skaiciuoja failus, grazina i masyva
          */
  
          } else {   //tai failas  
               if (isset($_GET['dir'])) {
               $child_dir = $_GET['dir'];
               } 
            echo "<li>";
            // $item_write=fopen($d, "w"); //galime redaguoti failus (write)
            $ext = pathinfo($dir . "/" . $item, PATHINFO_EXTENSION);
            if ($ext == 'php') {             //pridedam ikona .php failams
              echo "<a href=content.php?dir=".$child_dir.'/'.$item." target='_blank' rel='noopener noreferrer'><img src='http://localhost/php/pask-8-nd/img/php.svg' style='width: 32px;'>$item</a>";


            }elseif($ext == 'txt'){

             // TEXT editor + set icon 
            echo "<a href=content.php?dir=".$child_dir.'/'.$item." target='_blank' rel='noopener noreferrer'><img src='http://localhost/php/pask-8-nd/img/txt_icon.png' style='width: 32px;'>$item</a>";

            }
            // echo $item;
            echo "</li>";
            $result['size'] += filesize($dir . "/" . $item); //pagrindinio katalogo dydis,
            $result['count']++; //is masyvo pasiemam duomenis
          }
        }
        closedir($d);
        echo "</ul>";
        return $result; //return grazinam dydi, bet gali grazinti tik viena, jei daugiau reiksmiu, naudojam masyva.
      }

      if (isset($_GET['dir'])) {
        $child_dir = $_GET['dir'];
      }

      $dir = 'C:/xampp/htdocs/php/pask-8-nd/test';
      $duom = printDir($dir . '/' . $child_dir);
      // printDir($dir);
      echo "<hr><h4>Katalogo dydis / failų skaičius: {$duom['size']} / {$duom['count']}</h4>";
      
      
  

      ?>
    </div>





    



    <table class="table">
      <thead>
        <tr>
          <th scope="col">Type</th>
          <th scope="col">Name</th>
          <th scope="col">Date</th>
          <th scope="col">Size</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Folder</td>
          <td>Documents</td>
          <td>2022</td>
          <td>230 b</td>
          <td>Edit | Delete</td>
        </tr>

    </table>
  </div>
</body>

</html>