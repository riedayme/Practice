<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>

<div class="col-md-12 u-p-zero">

 <div class="c-card c-card--responsive h-100vh u-p-zero">
  <div class="c-card__header c-card__header--transparent o-line">
   <?php echo $this->lang->line('welcome_message').' '. APP_NAME; ?>
  </div>
  <div class="c-card__body">

   <div class="c-table-responsive">
    anda berhasil menghubungkan template dashboard ui dengan codeigniter
   </div>

  </div>
 </div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>
