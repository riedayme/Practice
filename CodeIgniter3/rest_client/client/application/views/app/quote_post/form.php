<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>


<div class="container-fluid">   
    <div class="row">

        <div class="col-12">
            <form action="<?php echo ($update == true) ? base_url('app/quote_post/process_update/'.$data_quote['id']) : base_url('app/quote_post/process_create') ?>" class="row" method="post" enctype="multipart/form-data">

                <div class="col-12 col-xl-9 col-lg-9 u-p-zero">

                    <div class="c-card c-card--responsive h-100vh u-p-zero">
                        <div class="c-card__header c-card__header--transparent o-line">
                            <button class="c-btn c-btn--info" name="publish" type="submit" title="publish">
                                <i class="fa fa-save" aria-hidden="true"></i>
                            </button>
                            <div class="u-ml-auto" style="max-width: 150px">
                                <label><input value="Published" name="status" type="radio" <?php echo (!empty($data_quote['status'])) ? ($data_quote['status'] == 'Published') ? 'checked' : '' : 'checked'?>>Published</label>
                                <label><input value="Draft" name="status" type="radio" <?php echo (!empty($data_quote['status'])) ? ($data_quote['status'] == 'Draft') ? 'checked' : '' : '' ?>>Draft</label>
                            </div>
                        </div>
                        <div class="c-card__body u-p-small">

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input13">Title : </label>
                                <input autofocus="" autocomplete="off" value="<?php echo (!empty($data_quote['title']) ? $data_quote['title'] : '') ?>" required="" class="c-input" name="title" id="title" type="text" placeholder="title">
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input13">Slug : </label>
                                <input name="slug_old" type="hidden" value="<?php echo (!empty($data_quote['slug']) ? $data_quote['slug'] : '') ?>">
                                <input autocomplete="off" value="<?php echo (!empty($data_quote['slug']) ? $data_quote['slug'] : '') ?>" class="c-input" name="slug" id="slug" type="text" placeholder="Slug">
                            </div>    

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input13">Image : </label>
                                <?php if (!empty($data_quote['image_thumbnail'])): ?>
                                    <img width="100px" src="<?php echo (!empty($data_quote['image_thumbnail']) ? $data_quote['image_thumbnail'] : '') ?>" alt="Image">
                                <?php endif ?>
                                <input required="" autofocus="" autocomplete="off" class="c-input" name="image" id="image" type="file" placeholder="image">
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input13">category : </label>
                                <input autofocus="" autocomplete="off" value="<?php echo (!empty($data_quote['category']) ? $data_quote['category'] : '') ?>" required="" class="c-input" name="category" id="category" type="text" placeholder="category">
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="input13">Content : </label>
                                <textarea rows="5" autofocus="" autocomplete="off" required="" class="c-input" name="content" id="content" type="text" placeholder="Quote"><?php echo (!empty($data_quote['content']) ? $data_quote['content'] : '') ?></textarea>
                            </div>  

                        </div>

                    </div>                

                </div>

            </form>

        </div>

    </div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>
