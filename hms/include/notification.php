<link rel="stylesheet" href="vendor/toastr/toastr.min.css">
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/toastr/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            <?php
            if(isset($message) && $message !== '' && isset($type) && $type !== '') { 
            ?>
                var message = <?php echo "'" . $message . "'"; ?>;
                var type = <?php echo "'" . $type . "'"; ?>;
                // Display the Toastr notification
                switch (type) {
                    case 'success':
                        toastr.success(message);
                        break;
                    case 'info':
                        toastr.info(message);
                        break;
                    case 'warning':
                        toastr.warning(message);
                        break;
                    case 'error':
                        toastr.error(message);
                        break;
                    default:
                        toastr.info(message);
                        break;
                }
        <?php 
        }
        if(isset($message) && $message !== '' && (!isset($type) || $type === '')) {
        ?>
                toastr.info(message);
        <?php } ?>
        });
    });
</script>