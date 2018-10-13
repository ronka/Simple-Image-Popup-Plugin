(function ($) {

    var wp_rtl_popup = {
        popup: null,
        popupClose: null,
        init: function(){
            this.popup = $('#wprtl-popup');
            this.popupClose = $('#wprtl-popup__close');

            $(document).on('click', this.popupClose, this.closePopup);

            if( this.getCookie('wprtl_popup_seen') != '1' ){
                this.openPopup();
            }
        },
        openPopup: function(){            
            $("*").attr('tabindex','-1');

            wp_rtl_popup.popup
                        .attr('aria-hidden', 'false')
                        .attr('tabindex', '0')
                        .focus()
                        .find('*')
                        .attr('tabindex','0');
        },
        closePopup: function(){
            // hide popup for 365 days
            wp_rtl_popup.setCookie('wprtl_popup_seen', '1', 365);

            wp_rtl_popup.popup
                        .attr('aria-hidden', 'true')
                        .attr('tabindex', '-1');

            // restore focus to all
            $('*').attr('tabindex','0');
        },
        /**
         * get and set cookie function from https://www.w3schools.com/js/js_cookies.asp
         */
        getCookie: function(cname){
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        },
        setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
    }

    $(document).ready(function(){
        wp_rtl_popup.init();
    })

})(jQuery);