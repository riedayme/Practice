
<li class="c-sidebar__item">
    <a class="c-sidebar__link <?php if($this->uri->segment(1)=="app" and empty($this->uri->segment(2)) or $this->uri->segment(2) == 'dashboard'){echo "is-active";}?>" href="<?php echo base_url('app/dashboard') ?>">
        <i class="fa fa-fire u-mr-xsmall"></i>Dashboard
    </a>
</li>

<h4 class="c-sidebar__title"><?php echo $this->lang->line('first_app'); ?></h4>

<li class="c-sidebar__item">
    <a class="c-sidebar__link <?php if($this->uri->segment(2)=='quote_post' or $this->uri->segment(2)=='quote_post' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/quote_post') ?>">
        <i class="fa fa-fire u-mr-xsmall"></i><?php echo $this->lang->line('post_quote'); ?>
    </a>
</li>
