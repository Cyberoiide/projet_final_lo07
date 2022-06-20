
<!-- ----- début viewInsertParent -->

<?php 
require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
      include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

      // var_dump($results);
    ?> 

    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <h2>Ajout d'une union</h2>
        <input type="hidden" name='action' value='lienUnionCreated'>  
        <!-- Champs pour le choix de l'homme -->  
        <label for="id_homme">Sélectionnez un homme : </label><select class="form-control" id="id_homme" name="id_homme">
            <?PHP
            foreach ($results as $individu){
                if ($individu['sexe']=='H')
                    echo "<option value=" . $individu['id'] . ">" . $individu['nom'] . " : " . $individu['prenom'] . "</option>";
            }
            ?>
        </select><br>
        
        <!-- Champs pour le choix de la femme -->  
        <label for="id_femme">Sélectionnez une femme : </label><select class="form-control" id="id_femme" name="id_femme">
            <?PHP
            foreach ($results as $individu){
                if ($individu['sexe']=='F')
                echo "<option value=" . $individu['id'] . ">" . $individu['nom'] . " : " . $individu['prenom'] . "</option>";
              }
            ?>
        </select><br>
        
        <!--Champs pour choisir le type d'union-->
        <label for="type">Sélectionnez un type d'union : </label><select class="form-control" id="type" name="type">
            <option value='COUPLE'>COUPLE</option>
            <option value='SEPARATION'>SEPARATION</option>
            <option value='PACS'>PACS</option>
            <option value='MARIAGE'>MARIAGE</option>
            <option value='DIVORCE'>DIVORCE</option>
        </select><br>
        
        <!--Champs pour choisir la date de l'union-->
        <label for="date">Date (AAAA-MM-JJ) ? </label><input class="form-control" type="text" name='date' size='75' value=''><br> 
        
        <!--Champs pour choisir le lieu de l'union-->
        <label for="lieu">Lieu ? </label><input class="form-control" type="text" name='lieu' size='75' value=''><br>
        
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
  </div>
  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewInsertParent -->