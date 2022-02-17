<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>


<form action="<?php echo (empty($this->input->get('form')) and $update == false) ? base_url('app/crud_multiple/create') : (($update == false) ? base_url('app/crud_multiple/process_create') : base_url('app/crud_multiple/process_update')) ?>" class="row" method="<?php echo (empty($this->input->get('form')) AND $update == false) ? 'GET' : 'POST' ?>" enctype="multipart/form-data">

    <div class="container-fluid">   
        <div class="row">

            <div class="col-12">

                <div class="c-card c-card--responsive h-100vh u-p-zero">
                    <div class="c-card__header c-card__header--transparent o-line">
                        <?php if ($this->input->get('form') or $update): ?>
                            <button class="c-btn c-btn--info c-btn--custom c-btn--small" name="publish" type="submit" title="publish">
                                <i class="fa fa-save" aria-hidden="true"></i>
                            </button>

                            <?php if (!$update): ?>
                                <a href='<?php echo base_url('app/crud_multiple/create') ?>' class="c-btn c-btn--danger c-btn--custom c-btn--small u-ml-auto" type="submit" title="publish">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>                                
                            <?php endif ?>
                        <?php else: ?>
                            <div class="c-field">
                                <input required="" min="1" max="100" autofocus="" value="" class="c-input" name="form" id="form" type="number" placeholder="Insert Count Form (number)">
                            </div>
                            <button style="width: 120px" class="c-btn c-btn--info u-ml-xsmall" type="submit" title="Submit">
                                Create
                            </button>
                        <?php endif ?>
                    </div>
                    <div class="c-card__body u-p-small">

                        <div class="row">
                            <?php $this->load->view('app/_layouts/alert'); ?>

                            <?php if ($this->input->get('form') or $update): ?>

                                <?php
                                $length = ($update) ? $biodata['count'] : $this->input->get('form');
                                for ($i=0; $i < $length ; $i++) { ?> 
                                <div class="col-lg-6 col-md-6 col-12 u-mb-small">
                                    <div class="c-card c-card--responsive u-p-zero">
                                        <div class="c-card__header c-card__header--transparent o-line">
                                            Form <?php echo $i+1 ?>
                                        </div>
                                        <div class="c-card__body u-p-small">

                                            <?php if (!empty($biodata['data'][$i]['id'])): ?>
                                                <input type="hidden" name="id[]" value="<?php echo $biodata['data'][$i]['id'] ?>">
                                            <?php endif ?>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label u-text-uppercase">name : </label>
                                                <input autofocus="" value="<?php echo (!empty($biodata['data'][$i]['name']) ? $biodata['data'][$i]['name'] : '') ?>" class="c-input" name="name[]" id="name" type="text" placeholder="name">

                                                <?php if ($this->session->flashdata('name')): ?>                                    
                                                    <small class="c-field__message u-color-danger">
                                                        <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('name') ?>
                                                    </small>
                                                <?php endif ?>
                                            </div>

                                            <div class="c-field u-mb-medium">
                                                <label class="c-field__label" for="select- <?php echo $i ?>">Gender</label>

                                                <select name="gender[]" class="c-select" id="select- <?php echo $i ?>">
                                                    <?php if ($biodata['data'][$i]['gender'] == 'Male'): ?>
                                                        <option value="Male" selected="">Male</option>
                                                        <option value="Female">Female</option>
                                                    <?php elseif($biodata['data'][$i]['gender'] == 'Female'): ?>
                                                     <option value="Male">Male</option>
                                                     <option value="Female" selected="">Female</option>
                                                 <?php else: ?>
                                                     <option value="Male">Male</option>
                                                     <option value="Female">Female</option>
                                                 <?php endif ?>
                                             </select>
                                             <?php if ($this->session->flashdata('gender')): ?>                                    
                                                <small class="c-field__message u-color-danger">
                                                    <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('gender') ?>
                                                </small>
                                            <?php endif ?>
                                        </div>

                                        <label class="c-field__label u-text-uppercase">birthday</label>
                                        <div class="c-field has-icon-right u-mb-small">
                                            <span class="c-field__icon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input name="birthday[]" readonly="" class="c-input" data-toggle="datepicker" type="text" placeholder="select date" value="<?php echo (!empty($biodata['data'][$i]['birthday']) ? date('m/d/Y', strtotime($biodata['data'][$i]['birthday'])) : '') ?>">

                                            <?php if ($this->session->flashdata('birthday')): ?>                                    
                                                <small class="c-field__message u-color-danger">
                                                    <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('birthday') ?>
                                                </small>
                                            <?php endif ?>
                                        </div>

                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label u-text-uppercase">photo : </label>
                                            <?php if (!empty($biodata['data'][$i]['photo'])): ?>
                                                <img width="100px" src="<?php echo (!empty($biodata['data'][$i]['photo']) ? base_url("storage/uploads/thumbnail/{$biodata['data'][$i]['photo']}") : '') ?>" alt="photo">
                                            <?php endif ?>
                                            <input class="c-input" name="photo[]" id="photo" type="file" placeholder="photo">
                                            <input class="c-input" name="photo_old[]" id="photo" type="hidden" value="<?php echo (!empty($biodata['data'][$i]['photo']) ? $biodata['data'][$i]['photo'] : '') ?>">
                                        </div>

                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label u-text-uppercase">hobby : </label>
                                            <input autofocus="" value="<?php echo (!empty($biodata['data'][$i]['hobby']) ? $biodata['data'][$i]['hobby'] : '') ?>" class="c-input" name="hobby[]" id="hobby" type="text" placeholder="hobby">

                                            <?php if ($this->session->flashdata('hobby')): ?>                                    
                                                <small class="c-field__message u-color-danger">
                                                    <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('hobby') ?>
                                                </small>
                                            <?php endif ?>
                                        </div>

                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label u-text-uppercase">about : </label>
                                            <textarea rows="5" autofocus="" class="c-input" name="about[]" id="about" type="text" placeholder="about"><?php echo (!empty($biodata['data'][$i]['about']) ? $biodata['data'][$i]['about'] : '') ?></textarea>

                                            <?php if ($this->session->flashdata('about')): ?>                                    
                                                <small class="c-field__message u-color-danger">
                                                    <i class="fa fa-times-circle"></i><?php echo $this->session->flashdata('about') ?>
                                                </small>
                                            <?php endif ?>
                                        </div>  

                                    </div>                

                                </div>
                            </div><!-- col -->
                            <?php } ?>
                        <?php endif ?>

                    </div><!-- row -->

                </div><!-- card body -->

            </div><!-- card -->

        </div><!-- col -->

    </div><!-- row -->

</div><!-- container -->

</form>

<?php $this->load->view('app/_layouts/footer'); ?>
