<li class="c-sidebar__item">
 <a class="c-sidebar__link <?php if($this->uri->segment(1)=="app" and empty($this->uri->segment(2)) or $this->uri->segment(2) == 'dashboard'){echo "is-active";}?>" href="<?php echo base_url('app/dashboard') ?>">
  <i class="fa fa-fire u-mr-xsmall"></i>Dashboard
 </a>
</li>

<h4 class="c-sidebar__title">First App</h4>

<li class="c-sidebar__item">
 <a class="c-sidebar__link <?php if($this->uri->segment(2)=='crud_multiple' or $this->uri->segment(2)=='crud_multiple' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/crud_multiple') ?>">
  <i class="fa fa-fire u-mr-xsmall"></i> Crud Multiple
 </a>
</li>
