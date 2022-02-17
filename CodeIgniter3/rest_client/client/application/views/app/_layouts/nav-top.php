<a class="c-btn--custom c-btn--small c-btn c-btn--secondary u-mr-small" href="<?php echo base_url() ?>" target="_blank"> 
    <i class="fa fa-external-link"></i>
</a>

<div class="c-dropdown dropdown u-mr-small">
    <button class="c-btn c-btn--secondary c-btn--small dropdown-toggle u-pl-xsmall u-pr-xsmall" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-flag"></i>
    </button>

    <div class="c-dropdown__menu dropdown-menu" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
        <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('app/set_language/switch/english') ?>">English</a>
        <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('app/set_language/switch/indonesia') ?>">Indonesia</a>        
    </div>
</div>

<a class="c-btn--custom c-btn--small c-btn c-btn--danger c-btn--small" href="<?php echo base_url('') ?>"> 
 <i class="fa fa-sign-out"></i>
 <!-- LogOut -->
</a>
