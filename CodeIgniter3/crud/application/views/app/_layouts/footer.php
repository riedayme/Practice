</div><!-- // .row -->

</div><!-- // .container -->

</main><!-- // .o-page__content -->

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

<!-- this is the external script -->
<?php  
echo '
<script>
    var lang = {
        alert_title : "'.$this->lang->line('alert_title').'",
        alert_text : "'.$this->lang->line('alert_text').'",
        alert_text_selected : "'.$this->lang->line('alert_text_selected').'",
        alert_text_confirm : "'.$this->lang->line('alert_text_confirm').'",
        alert_text_cancel : "'.$this->lang->line('alert_text_cancel').'",                
    };
</script>
';
?>

<script src="<?php echo base_url(app_custom_js) ?>"></script>


</body>

</html>
