<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>

<form class="container-fluid u-p-zero" action="<?php echo base_url('app/quote_post/process_batch') ?>" method="POST">
    <div class="row">
        <div class="col-md-12">

            <div class="c-card c-card--responsive h-100vh u-p-zero">
                <div class="c-card__header c-card__header--transparent o-line">
                    <a class="c-btn--custom c-btn--small c-btn c-btn--info" href="<?php echo base_url('app/quote_post/create') ?>">
                        <i class="fa fa-plus"></i>
                    </a>           
                </div>
                <div class="c-card__body">

                    <?php $this->load->view('app/_layouts/alert'); ?>

                    <div class="c-toolbar u-mb-medium u-p-zero">

                        <h3 class="c-toolbar__title u-mr-auto u-pt-small u-pb-small"><?php echo $this->lang->line('total_data').$data_quote['total_pagination'] ?></h3>

                        <button type="submit" class="c-btn--custom c-btn--small c-btn c-btn--danger btn-action" name="action" value="delete_batch">
                            <i class="fa fa-trash"></i>
                        </button> 

                    </div>

                    <div class="c-table-responsive">

                        <table class="c-table c-table--zebra" style="display: table;">
                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head"><?php echo $this->lang->line('title'); ?></th>
                                    <th class="c-table__cell c-table__cell--head"><?php echo $this->lang->line('status'); ?></th>
                                    <th class="c-table__cell c-table__cell--head"><?php echo $this->lang->line('tools'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data_quote['content']): ?>
                                    <?php foreach ($data_quote['content'] as $quote): ?>
                                        <input type="hidden" name="id[]" value="<?php echo $quote['id'] ?>">
                                        <tr class="c-table__row">
                                            <td class="c-table__cell break-word">
                                                <div class="o-media__img u-mr-xsmall">
                                                    <a target="_blank" href="<?php echo $quote['image_thumbnail'] ?>"><img width="60" src="<?php echo $quote['image_thumbnail'] ?>" alt="<?php echo $quote['title'] ?>"/></a>
                                                </div>
                                                <div class="o-media__body">
                                                    <?php echo $quote['title'] ?> 
                                                    <span class="u-block u-text-mute u-text-xsmall"><?php echo $quote['category'] ?></span>
                                                </div>
                                            </td>
                                            <td class="c-table__cell break-word">
                                                <div class="o-media__body">
                                                    <?php echo $quote['status'] ?> 
                                                </div>
                                            </td>
                                            <td class="c-table__cell">
                                                <a class="c-btn c-btn--info c-btn--custom" href="<?php echo base_url('app/quote_post/update/'.$quote['id']) ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="c-btn c-btn--danger c-btn--custom action-delete" href="<?php echo base_url('app/quote_post/delete/'.$quote['id']) ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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
                    <?php echo $data_quote['pagination']; ?>

                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('app/_layouts/footer'); ?>
