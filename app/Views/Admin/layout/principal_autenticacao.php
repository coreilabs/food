<!DOCTYPE html>
<html lang="en">

<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delivery | <?= $this->renderSection('titulo'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= site_url('admin/'); ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= site_url('admin/'); ?>vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= site_url('admin/'); ?>css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= site_url('admin/'); ?>images/favicon.png" />

<!-- Essa Section renderizará os estilos específicos da View que estender este layout -->

    <?= $this->renderSection('estilos'); ?>
</head>

<body>
  <div class="container-scroller">

  
            <!-- Essa Section renderizará os conteudos específicos da View que estender este layout -->

            <?= $this->renderSection('conteudo'); ?>
    

  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= site_url('admin/'); ?>vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?= site_url('admin/'); ?>js/off-canvas.js"></script>
  <script src="<?= site_url('admin/'); ?>js/hoverable-collapse.js"></script>
  <script src="<?= site_url('admin/'); ?>js/template.js"></script>
  <!-- endinject -->
</body>

</html>
