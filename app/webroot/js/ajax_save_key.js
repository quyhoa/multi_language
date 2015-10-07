<script type="text/javascript">
        jQuery(document).ready(function($) {
            var url,dta;
            handleMenu('#FMenuWord0','handleMenu');
            function handleMenu(id,action){
                // alert(id);
                var url,dta;
                $(id).blur(function(){
                dta = {keyWord: $(id).val()};
                url = '/dictjas/'+action;
                // use ajax
                $.ajax({
                    type: 'post',
                    url: url,
                    data: dta,
                    success: function (data) {
                        // rs = '<pre>'+data+'</pre>';
                        // $('#food').html(rs);

                        console.log(data.FMenu);
                        // $('#price').html(data.FMenu.price);
                        // alert('ok');
                        
                    },
                });
                
            });
            }
            function handle(id){
                var url,dta;
                $(id).blur(function(){
                dta = {keyWord: $(id).val()};
                url = '/dictjas/'+action;
                // use ajax
                $.ajax({
                    type: 'post',
                    url: url,
                    data: dta,
                    success: function (data) {
                    },
                });
                
            });
            }
        });
       
    </script>