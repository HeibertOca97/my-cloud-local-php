<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section>
    <div class="container-f mx-auto box-body">
        <div class="box-form">
            <div class="box-video">
                <video controls autoplay>
                    <source src="" id="box-video">
                </video>
                <p class="name"></p>
                <p class="type"></p>
                <button id="btn-cancel" class="btn-w3">Quitar seleccion</button>
            </div>
            <form action="<?php $this->route("video/store"); ?>" method="POST" id="form-img" enctype="multipart/form-data">
                <div>
                    <p id="status-file"></p>
                    <input id="up-file" type="file" name="video">
                    <label for="up-file" id="btn-select" class="btn-w1"><i class="fas fa-search"></i> Seleccionar video</label>
                </div>
                <button type="submit" class="btn-w2"><i class="fas fa-cloud-upload-alt"></i> Save file</button>
            </form>
        </div>

        <div class="box-picture">
            <h3><i class="fas fa-film"></i> Mis videos</h3>
            <div class="box-list-file">
                <?php if (count($videos) > 0) : ?>
                    <?php foreach ($videos as $item) : ?>
                        <picture>
                            <video controls>
                                <source src="<?php $this->storage($item->url); ?>">
                            </video>
                            <div class="control-video">
                                <form action="<?php $this->route("video/destroy/$item->id"); ?>" method="POST" class="delete-video">
                                    <button class="btn-control"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </picture>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (count($videos) < 1) : ?>
                <p class="msg-register">Por el momento no hay ningun registro</p>
            <?php endif; ?>

            <?php if ($totalPage > $limitPage && $paginate == true) : ?>
                <nav class="box-link-page">
                    <a href="<?= $this->route('video/pag/1') ?>" class="link-all link-blue">Mostrar mas</a>
                </nav>
            <?php endif; ?>
            <?php if ($totalPage > $limitPage && $paginate == false) : ?>
                <nav class="box-link-page">
                    <a href="<?= $this->route('video/pag/1') ?>" class="link-page link-light"> &lt;&lt; </a>
                    <?php if ($pagActual > 1) : ?>
                        <a href="<?= $this->route('video/pag/' . ($pagActual - 1)) ?>" class="link-page link-light"> &lt; </a>
                    <?php else : ?>
                        <span class="link-page link-disabled"> &lt; </span>
                    <?php endif; ?>
                    <span class="link-page link-light"> .. </span>

                    <?php for ($i = 0; $i < $pagLink; $i++) : ?>
                        <?php if ($pagActual == ($i + 1)) : ?>
                            <span class="link-page link-blue"><?= ($i + 1) ?></span>
                        <?php else : ?>
                            <a href="<?= $this->route('video/pag/' . ($i + 1)) ?>" class="link-page link-light"><?= ($i + 1) ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <span class="link-page link-light"> .. </span>
                    <?php if ($pagActual < $pagLink) : ?>
                        <a href="<?= $this->route('video/pag/' . ($pagActual + 1)) ?>" class="link-page link-light"> &gt; </a>
                    <?php else : ?>
                        <span class="link-page link-disabled"> &gt; </span>
                    <?php endif; ?>
                    <a href="<?= $this->route('video/pag/' . $pagLink) ?>" class="link-page link-light"> &gt;&gt; </a>
                </nav>
            <?php endif; ?>

        </div>
    </div>
</section>

<script src="<?php $this->assets("src/js/video.js"); ?>"></script>
<?php $this->template("layouts.partials.footer"); ?>
<?php $this->template("layouts.partials.endHTML"); ?>