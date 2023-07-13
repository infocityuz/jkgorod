$(document).ready(function() {
    $('body .delete-data-item').on('click',function (e) {
        if (!confirm("Вы уверены?")){
            return false;
        }else{
            return true;
        }

    });
    window.goBack = function (e){
        var defaultLocation = "/";
        var oldHash = window.location.hash;

        history.back(); // Try to go back

        var newHash = window.location.hash;

        /* If the previous page hasn't been loaded in a given time (in this case
        * 1000ms) the user is redirected to the default location given above.
        * This enables you to redirect the user to another page.
        *
        * However, you should check whether there was a referrer to the current
        * site. This is a good indicator for a previous entry in the history
        * session.
        *
        * Also you should check whether the old location differs only in the hash,
        * e.g. /index.html#top --> /index.html# shouldn't redirect to the default
        * location.
        */

        if(
            newHash === oldHash &&
            (typeof(document.referrer) !== "string" || document.referrer  === "")
        ){
            window.setTimeout(function(){
                // redirect to default location
                window.location.href = defaultLocation;
            },1000); // set timeout in ms
        }
        if(e){
            if(e.preventDefault)
                e.preventDefault();
            if(e.preventPropagation)
                e.preventPropagation();
        }
        return false; // stop event propagation and browser default event
    }
    /*========================objex start=========================================*/

            $('#object_category').on('change', function (e) {
                let selectVal = this.value;
                $('.category__elements').addClass('active');
                if (selectVal == 'Жилой комплекс'){
                    $('.cat_1').removeClass('active');
                    $('.cat_2').removeClass('active');
                    $('.cat_3').removeClass('active');
                    $('.cat_0').addClass('active');

                }else if(selectVal == 'Поселок'){
                    $('.cat_0').removeClass('active');
                    $('.cat_2').removeClass('active');
                    $('.cat_3').removeClass('active');
                    $('.cat_1').addClass('active');

                }else if(selectVal == 'Бизнес Центр'){
                    $('.cat_0').removeClass('active');
                    $('.cat_1').removeClass('active');
                    $('.cat_3').removeClass('active');
                    $('.cat_2').addClass('active');

                }else if(selectVal == 'Жилой комплекс'){

                    $('.cat_0').removeClass('active');
                    $('.cat_2').removeClass('active');
                    $('.cat_1').removeClass('active');
                    $('.cat_3').addClass('active');
                }
            })
    /*========================objex end=========================================*/

});
