<?php

/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=76; */

/**
 * Style tab template.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>


<div class="control-group">

  <legend>Color</legend>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'vector-color',
      'title' => 'Shape Color'
  )); ?>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'stroke-color',
      'title' => 'Line Color'
  )); ?>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'select-color',
      'title' => 'Selected Color'
  )); ?>

</div>

<div class="control-group">

  <legend>Opacity</legend>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'vector-opacity',
      'title' => 'Shape Opacity'
  )); ?>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'select-color',
      'title' => 'Selected Opacity'
  )); ?>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'stroke-opacity',
      'title' => 'Line Opacity'
  )); ?>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'image-opacity',
      'title' => 'Image Opacity'
  )); ?>

</div>

<div class="control-group">

  <legend>Size</legend>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'stroke-width',
      'title' => 'Line Width'
  )); ?>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'point-radius',
      'title' => 'Point Radius'
  )); ?>

</div>

<div class="control-group">

  <legend>Image</legend>

  <?php echo $this->partial(
    'index/underscore/helpers/_text_input.php', array(
      'name' => 'point-image',
      'title' => 'Point Image'
  )); ?>

</div>