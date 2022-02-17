<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>


<div class="container-fluid">   
    <div class="row">

        <div class="col-12">
            <form action="<?php echo ($update == true) ? base_url('app/crud/process_update/'.$biodata['id']) : base_url('app/crud/process_create') ?>" class="row" method="post" enctype="multipart/form-data">

                <div class="col-12 col-xl-9 col-lg-9 u-p-zero">

                    <div class="c-card c-card--responsive h-100vh u-p-zero">
                        <div class="c-card__header c-card__header--transparent o-line">
                            <button class="c-btn c-btn--info" name="publish" type="submit" title="publish">
                                <i class="fa fa-save" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="c-card__body u-p-small">

                            <div class="c-field u-mb-small">
                                <label class="c-field__label u-text-uppercase">name : </label>
                                <input autofocus="" value="<?php echo (!empty($biodata['name']) ? $biodata['name'] : '') ?>" class="c-input" name="name" id="name" type="text" placeholder="name">

                                <?php if ($this->session->flashdata('name')): ?>                                    
                                    <small class="c-field__message u-color-danger">
                                        <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('name') ?>
                                    </small>
                                <?php endif ?>
                            </div>

                            <div class="c-field u-mb-small">
                                <p class="u-text-mute u-text-uppercase u-mb-small">gender</p>

                                 <?php if ($this->session->flashdata('gender')): ?>                                    
                                    <small class="c-field__message u-color-danger">
                                        <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('gender') ?>
                                    </small>
                                <?php endif ?>
                            </div>
                            <div class="c-choice c-choice--radio">
                                <input class="c-choice__input" id="male" name="gender" type="radio" value="male" <?php echo (!empty($biodata['gender']) AND $biodata['gender'] == 'Male') ? 'checked' : ''  ?>>
                                <label class="c-choice__label" for="male">Male</label>
                            </div>
                            <div class="c-choice c-choice--radio">
                                <input class="c-choice__input" id="female" name="gender" type="radio" value="female" <?php echo (!empty($biodata['gender']) AND $biodata['gender'] == 'Female') ? 'checked' : ''  ?>>
                                <label class="c-choice__label" for="female">Female</label>
                            </div>

                            <label class="c-field__label u-text-uppercase">birthday</label>
                            <div class="c-field has-icon-right u-mb-small">
                                <span class="c-field__icon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input name="birthday" readonly="" class="c-input" data-toggle="datepicker" type="text" placeholder="select date" value="<?php echo (!empty($biodata['birthday']) ? date('m-d-Y', strtotime($biodata['birthday'])) : '') ?>">

                                <?php if ($this->session->flashdata('birthday')): ?>                                    
                                    <small class="c-field__message u-color-danger">
                                        <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('birthday') ?>
                                    </small>
                                <?php endif ?>
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label u-text-uppercase">photo : </label>
                                <?php if (!empty($biodata['photo'])): ?>
                                    <img width="100px" src="<?php echo (!empty($biodata['photo']) ? base_url("storage/uploads/thumbnail/{$biodata['photo']}") : '') ?>" alt="photo">
                                <?php endif ?>
                                <input class="c-input" name="photo" id="photo" type="file" placeholder="photo">
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label u-text-uppercase">hobby : </label>
                                <input autofocus="" value="<?php echo (!empty($biodata['hobby']) ? $biodata['hobby'] : '') ?>" class="c-input" name="hobby" id="hobby" type="text" placeholder="hobby">

                                <?php if ($this->session->flashdata('hobby')): ?>                                    
                                    <small class="c-field__message u-color-danger">
                                        <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('hobby') ?>
                                    </small>
                                <?php endif ?>
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label u-text-uppercase">about : </label>
                                <textarea rows="5" autofocus="" class="c-input" name="about" id="about" type="text" placeholder="about"><?php echo (!empty($biodata['about']) ? $biodata['about'] : '') ?></textarea>

                                <?php if ($this->session->flashdata('about')): ?>                                    
                                    <small class="c-field__message u-color-danger">
                                        <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('about') ?>
                                    </small>
                                <?php endif ?>
                            </div>  

                        </div>

                    </div>                

                </div>

            </form>

        </div>

    </div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>
