;(function($){
    var opt_value = $('#pqrc_toggle').val();
    if(opt_value){
        $("#toggle1 .minitoggle").addClass('active');
    }
    $(document).ready(function(){
        $('#toggle1').minitoggle();

        $('#toggle1').on("toggle", function(e){
            if (e.isActive)
                $("#pqrc_toggle").val(1)
            else
            $("#pqrc_toggle").val(0)
        });

    })


})(jQuery)

