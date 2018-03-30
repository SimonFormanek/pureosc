<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo MODULE_NAVBAR_LANGUAGES_SELECTED_LANGUAGE; ?></a>
<?php
  if (!isset($lng) || (isset($lng) && !is_object($lng))) { 
    include_once('includes/classes/language.php');
    $lng = new language;
  }
  if (count($lng->catalog_languages) > 1) {
?>
    <ul class="dropdown-menu">
<?= $usu5_multi->links_list() ?></ul>
<?php
}
  ?>
</li>    