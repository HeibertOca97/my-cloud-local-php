<section>
  <div class="container-f mx-auto box-body">
    <div class="box-form">
      <?php
        if($_GET){
          if(!is_array($_GET["res"])){
            echo '<a href="./index.php">Cargar nuevamente</a>';
            echo $_GET["res"];
          }else{
            echo '<a href="./index.php">Cargar nuevamente</a>';
            echo $_GET["res"];
          }
        }
        else{
        ?>
      <form action="./server.php" method="POST" enctype="multipart/form-data">
        <div>
          <input id="up-file" type="file" name="image">
          <label for="up-file"  class="btn-w1"><i class="fas fa-search"></i> Seleccionar archivo</label>
        </div>
        <button type="submit" class="btn-w2"><i class="fas fa-cloud-upload-alt"></i> Save file</button>
      </form>
      <?php } ?>
    </div>

    <div class="box-picture">
      <h3><i class="far fa-folder-open"></i> Mis archivos</h3>
      <div class="box-list-file">
        <?php for($i = 0; $i < 9; $i++) {?>
          <picture>
            <img src="https://restcountries.eu/data/hnd.svg">
          </picture>
        <?php } ?>
      </div>
    </div>
  </div>
</section>