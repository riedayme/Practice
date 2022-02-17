<?php  
if ($this->session->flashdata('create')) {
 if ($this->session->flashdata('create') == '1') {
  ?>

  <div class="c-alert c-alert--info alert alert-automatic">
   <i class="c-alert__icon fa fa-info-circle"></i> Create Success
   <button class="c-close" data-dismiss="alert" type="button">&times;</button>
  </div>

  <?php
 }elseif ($this->session->flashdata('create') == 'failed') {
  ?>

  <div class="c-alert c-alert--danger alert">
   <i class="c-alert__icon fa fa-info-circle"></i> Create Failed
   <button class="c-close" data-dismiss="alert" type="button">&times;</button>
  </div>

  <?php
 }
}
?>

<?php  
if ($this->session->flashdata('edit')) {
 if ($this->session->flashdata('edit') == '1') {
  ?>

  <div class="c-alert c-alert--info alert alert-automatic">
   <i class="c-alert__icon fa fa-info-circle"></i> Update Success
   <button class="c-close" data-dismiss="alert" type="button">&times;</button>
  </div>

  <?php
 }elseif ($this->session->flashdata('edit') == 'failed') {
  ?>

  <div class="c-alert c-alert--danger alert">
   <i class="c-alert__icon fa fa-info-circle"></i> Update Failed
   <button class="c-close" data-dismiss="alert" type="button">&times;</button>
  </div>

  <?php
 }
}
?>

<?php  
if ($this->session->flashdata('delete')) {
 if ($this->session->flashdata('delete') == '1') {
  ?>

  <div class="c-alert c-alert--info alert">
   <i class="c-alert__icon fa fa-info-circle"></i> Delete Success
   <button class="c-close" data-dismiss="alert" type="button">&times;</button>
  </div>

  <?php
 }elseif ($this->session->flashdata('delete') == 'failed') {
  ?>

  <div class="c-alert c-alert--danger alert">
   <i class="c-alert__icon fa fa-info-circle"></i> Save Failed
   <button class="c-close" data-dismiss="alert" type="button">&times;</button>
  </div>

  <?php
 }
}
?>
