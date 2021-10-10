<header class="header">
  <div class="navbar container-f mx-auto">
    <a href="<?php $this->route(""); ?>" class="logo-title">My Cloud local</a>  
  
    <nav>
        <a class="link-nav <?= $this->requestRoute("") ? 'link-active': '' ; ?>" href="<?php $this->route(""); ?>">Inicio</a>
        <a class="link-nav <?= $this->requestRoute("image") ? 'link-active': '' ; ?>" href="<?php $this->route("image"); ?>">Imagenes</a>
        <a class="link-nav <?= $this->requestRoute("video") ? 'link-active': '' ; ?>" href="<?php $this->route("video"); ?>">Videos</a>
        <a class="link-nav <?= $this->requestRoute("document") ? 'link-active': '' ; ?>" href="<?php $this->route("document"); ?>">Documentos</a>
    </nav>
  </div>
</header>