<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section>
  <div class="container-f mx-auto box-body">
    <div class="box-form">
      <form action="<?php $this->route("home/store"); ?>" method="POST" id="form-img" enctype="multipart/form-data">
        <div>
            <p id="status-file"></p>
          <input id="up-file" type="file" name="image">
          <label for="up-file"  class="btn-w1"><i class="fas fa-search"></i> Seleccionar archivo</label>
        </div>
        <button type="submit" class="btn-w2"><i class="fas fa-cloud-upload-alt"></i> Save file</button>
      </form>
      <div class="box-img">
          <img src="" id="box-img">
          <p class="name"></p>
          <p class="type"></p>
          <button id="btn-cancel" class="btn-w3">Quitar seleccion</button>
      </div>
    </div>

    <div class="box-picture">
      <h3><i class="far fa-folder-open"></i> Mis archivos</h3>
      <div class="box-list-file">
        <?php if(count($images) > 0) {?>
            <?php foreach($images as $item) {?>
          <picture>
              <img src="<?php $this->storage($item->url); ?>">
          </picture>
            <?php } ?>
        <?php } else{?>
            <p>Por el momento no hay ningun registro</p>
        <?php } ?>
      </div>
    </div>
  </div>
</section>

<script src="<?php $this->assets("src/js/app.js"); ?>"></script>
<?php $this->template("layouts.partials.footer"); ?>
<?php $this->template("layouts.partials.endHTML"); ?>