<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>

<form method="POST">

    <div class="row">
        <div class="col-md-12">

            <div class="c-card c-card--responsive h-100vh u-p-zero">
                <div class="c-card__header c-card__header--transparent o-line">
                    <a class="c-btn--custom c-btn--small c-btn c-btn--info" href="<?php echo base_url('app/crud_multiple/create') ?>">
                        <i class="fa fa-plus"></i>
                    </a>    

                    <button disabled="" type="button" class="c-btn--custom c-btn--small c-btn c-btn--info u-ml-auto action-update" data-href="<?php echo base_url('app/crud_multiple/update') ?>">
                        <i class="fa fa-edit"></i>
                    </button>  
                    <button disabled="" class="c-btn--custom c-btn--small c-btn c-btn--danger u-ml-small action-delete" type="button" data-href='<?php echo base_url('app/crud_multiple/process_delete') ?>'>
                        <i class="fa fa-trash"></i>
                    </button>         
                </div>
                <div class="c-card__body">
                    <?php $this->load->view('app/_layouts/alert'); ?>

                    <div class="c-table-responsive">

                        <table class="c-table c-table--zebra" style="display: table;">
                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head" style="padding:10px !important;width: 50px">
                                        <div class="c-choice c-choice--checkbox" style="position: relative; left: 10px; top: 10px;">
                                            <input class="c-choice__input" id="select_all" type="checkbox">
                                            <label class="c-choice__label" for="select_all"></label>
                                        </div>
                                    </th>
                                    <th class="c-table__cell c-table__cell--head">user</th>
                                    <th class="c-table__cell c-table__cell--head">birthday</th>
                                    <th class="c-table__cell c-table__cell--head">hobby</th>
                                    <th class="c-table__cell c-table__cell--head">about</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($biodata): ?>
                                    <?php foreach ($biodata as $data): ?>                                    
                                        <tr class="c-table__row">
                                            <td class="c-table__cell">
                                                <div class="c-choice c-choice--checkbox" style="position: relative; left: 5px; top: 10px;">
                                                    <input class="c-choice__input checkbox" id="checkbox-<?php echo $data['id'] ?>" name="id[]" value="<?php echo $data['id'] ?>" type="checkbox">
                                                    <label class="c-choice__label" for="checkbox-<?php echo $data['id'] ?>"></label>
                                                </div>
                                            </td>
                                            <td class="c-table__cell">
                                                <?php if ($data['photo']): ?>
                                                    <div class="o-media__img u-mr-xsmall">
                                                        <a target="_blank" href="<?php echo base_url("storage/uploads/thumbnail/{$data['photo']}") ?>"><img width="60" src="<?php echo base_url("storage/uploads/thumbnail/{$data['photo']}") ?>" alt="<?php echo $data['name'] ?>"/></a>
                                                    </div>
                                                <?php endif ?>
                                                <div class="o-media__body">
                                                    <?php echo $data['name'] ?> 
                                                    <span class="u-block u-text-mute u-text-xsmall"><?php echo $data['gender'] ?></span>
                                                </div>
                                            </td>
                                            <td class="c-table__cell">
                                                <?php echo $data['birthday'] ?> 
                                            </td>
                                            <td class="c-table__cell">
                                                <?php echo $data['hobby'] ?> 
                                            </td>
                                            <td class="c-table__cell">
                                                <?php echo $data['about'] ?> 
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="c-table__cell u-text-center" colspan="8">No Content</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

</form>

<?php $this->load->view('app/_layouts/footer'); ?>
