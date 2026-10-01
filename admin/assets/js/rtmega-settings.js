/**
 * Settings page behaviour for RT Mega Menu.
 *
 * Moved out of admin-settings.php, where it was printed as an inline <script>.
 * The code is unchanged; it is now enqueued only on the plugin settings screen.
 */
(function($){

    $(document).ready(function () {

        // Show the first tab and hide the rest
        $('#tabs-nav li:first-child').addClass('active');
        $('.tab-content').hide();
        $('.tab-content:first').show();

        // Click function
        $('#tabs-nav li').click(function(){
            $('#tabs-nav li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').hide();

            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn();
            return false;
        });

        $('input[type="wpcolor"]').wpColorPicker();



    });

})(jQuery);
