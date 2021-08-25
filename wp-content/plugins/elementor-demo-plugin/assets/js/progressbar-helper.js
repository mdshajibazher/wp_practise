;(function($){
    $(window).on("elementor/frontend/init",function(){
        elementorFrontend.hooks.addAction("frontend/element_ready/progressbarWidget.default",function(){
            $(".progress").each(function(){
                var progressDone = $(this).data('progress-done');
                if(!progressDone){
                    $(this).data('progress-done',1);


                var element = $(this)[0];
                console.log(element);
                var bar = new ProgressBar.Line(element, {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 1400,
                    color: '#FFEA82',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {width: '90%', height: '10px'},
                    text: {
                        style: {
                            // Text color.
                            // Default: same as stroke color (options.color)
                            color: '#999',
                            position: 'absolute',
                            right: '0',
                            top: '0',
                            padding: 0,
                            margin: 0,
                            transform: null
                        },
                        autoStyleContainer: false
                    },
                    step: (state, bar) => {
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });


                bar.animate(.7);  // Number from 0.0 to 1.0

                }



            });
        })
    })
    $(document).ready(function(){

    })
})(jQuery);