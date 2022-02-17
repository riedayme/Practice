</div><!-- // .row -->

</div><!-- // .container -->

</main><!-- // .o-page__content -->

</div>

<!-- Template JS File -->
<script src="<?php echo base_url(app_all_modules_js) ?>"></script>
<script src="<?php echo base_url(app_main_js) ?>"></script>

<?php if (!empty($js) and is_array($js)): ?>
    <!-- JS Libraies -->
    <?php foreach ($js as $row): ?>
        <script src="<?php echo base_url($row) ?>"></script>
    <?php endforeach?>
<?php endif?>

<!-- Page Specific JS File -->
<?php if (!empty($js_external) and is_array($js_external)): ?>
    <?php foreach ($js_external as $row): ?>
        <script src="<?php echo $row ?>"></script>
    <?php endforeach?>
<?php endif?>

<script src="<?php echo base_url(app_custom_js) ?>"></script>

<!-- this is the external script -->

</body>

</html>
