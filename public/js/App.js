$(document).ready(function () {
    //code here
    debuger(1, 'le js est chargée');
    delete_label();
    formular();
});

/**
 *
 * @param msg
 * @param lvl 1 = debug function, 2 = text, 3 = variable
 */
function debuger(lvl , msg) {
    if (lvl == 1){
        console.log('Function : '+msg);
    }else if (lvl == 2){
        console.log('Texte : '+msg);
    }else if (lvl == 3){
        console.log('Variable : '+msg);
    }
}

function delete_label() {
    $('#manga_cover .form-group label').html('');
    //debuger(1, label);
}

function formular() {
    $("#manga_genres").addClass('row');
    $("#manga_genres .form-check").addClass('col-lg-2');
    $("#manga_genres .form-check").css('padding-left', '2.25rem');
}