<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title;?></title>
  <meta charset="UTF-8">
  <?php echo load_csss($this->config, $csss);?>
  <link rel="shortcut icon" href="<?php echo $this->config->item('static_url'); ?>favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript">
    var BASE_URL = '<?php echo $this->config->item('base_url');?>';
    var STATICS_URL  = '<?php echo $this->config->item('static_url');?>';
    var MODULOS_JSON = JSON.parse('<?php echo $menu; ?>');
    var ITEMS_JSON = JSON.parse('<?php echo $items; ?>');
    var DATA = JSON.parse('<?php echo $data; ?>');
    var CSRF = "<?php echo $this->config->item('csrf_val'); ?>";
    var CSRF_KEY = '<?php echo $this->config->item('csrf_token_name'); ?>';
  </script>
</head>
<body>
  <label id="defaultTargetMensajes"></label>
  <!-- Inicio modal -->
  <button type="button" class="btn btn-primary btn-lg oculto" data-toggle="modal" data-target="#modal-container" id="btnModal">Launch demo modal</button>
  <div class="modal fade" id="modal-container" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin modal -->
  <div id="app"></div>
  <!-- Handlebars Templates -->
  <script id="template" type="text/x-handlebars-template">
    {{> header}}
    {{> breadcrumb}}
    {{> contenido}}
    {{> footer}}
  </script>
  <script id="header-template" type="text/x-handlebars-template">
    <header>
      <a href="{{BASE_URL}}">Inicio</a>
      <a href="{{BASE_URL}}ayuda">Ayuda</a>
      <a href="{{BASE_URL}}login/ver" class="pull-right">Pepe Valdivia</a>
      <a href="{{BASE_URL}}login/cerrar" class="pull-right">Cerrar Sesión</a>
    </header>
  </nav>
  <!-- Fin Header -->
  </script>
  <script id="breadcrumb-template" type="text/x-handlebars-template">
    <nav>
      <h1><i class="fa fa-map-marker h1" aria-hidden="true"></i>Gestor de Ubicaciones</h1>
      {{{menuModulos}}}
    </nav>
  </script>
  <script id="contenido-template" type="text/x-handlebars-template">
    <div id="body-app" class="row">
      <aside class="col-md-2">
        {{{menuSubModulos}}}
      </aside>
      <section class="col-md-10" id="workspace">
        <!-- Inicio Yield-->
        {{> yield}}
        <!-- Fin Yield-->
      </section>
    </div>
  </script>
  <script id="footer-template" type="text/x-handlebars-template">
    <footer>
      <p>Powered by: <a href="http://softweb.pe/">Software Web Perú</a> © 2011-2018 </p>
    </footer>
  </script>
