<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section>
  <div class="container-f mx-auto box-body">
    <div class="box-form">
        <div class="box-img">
            <img src="" id="box-img">
            <p class="name"></p>
            <p class="type"></p>
            <button id="btn-cancel" class="btn-w3">Quitar seleccion</button>
        </div>
      <form action="<?php $this->route("image/store"); ?>" method="POST" id="form-img" enctype="multipart/form-data">
        <div>
            <p id="status-file"></p>
          <input id="up-file" type="file" name="image">
          <label for="up-file" id="btn-select"  class="btn-w1"><i class="fas fa-search"></i> Seleccionar imagen</label>
        </div>
        <button type="submit" class="btn-w2"><i class="fas fa-cloud-upload-alt"></i> Save file</button>
      </form>
    </div>

    <div class="box-picture">
      <h3><i class="far fa-folder-open"></i> Mis imagenes</h3>
      <div class="box-list-file">
        <?php if(count($images) > 0) {?>
            <?php foreach($images as $item) {?>
          <picture>
              <img src="<?php $this->storage($item->url); ?>">
              <div class="control-img">
                    <a href="<?php $this->storage($item->url); ?>" download class="btn-control"><i class="fas fa-cloud-download-alt"></i></a>
                    <form action="<?php $this->route("image/destroy/$item->id"); ?>" method="POST" class="delete-img">
                        <button class="btn-control"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
          </picture>
            <?php } ?>
        <?php } ?>
      </div>
      <?php if(count($images) < 1) {?>
      <p class="msg-register">Por el momento no hay ningun registro</p>
      <?php } ?>
    </div>
  </div>
</section>

<script src="<?php $this->assets("src/js/app.js"); ?>"></script>
<?php $this->template("layouts.partials.footer"); ?>
<?php $this->template("layouts.partials.endHTML"); ?>