/**
 * Created by Rom on 10/10/2016.
 */
$('document').ready(function(){
    setInterval('gallerie()',8000);
    gereClic();
})

function gallerie(){
    var active = $('#banniere .visible')
    var imgSuivant = (active.next().length > 0) ? active.next() : $('#banniere img:first');

    active.fadeOut(2000,function () {
        active.removeClass('visible');
        imgSuivant.fadeIn(2000).addClass('visible');
    });
}

function gereClic(){
    $('#newAccount').click(function(){
        var rq = $(this).attr('href').split(".")[0];
        event.preventDefault();
        $.get("../PHP/index.php?rq=" +rq,function(data){
            traiteRetour(testeJSON(data));
        });


    })
}

function testeJSON(result){
    var json={};
    try { json = $.parseJSON(result);}
    catch(err){
        json["erreur"] = {
            "contenu" : result,
            "title" : "Retour non JSON",
            "dialogClass" : "warning"
        };


    }
    return json;
}


function traiteRetour(objetJS){
    $.map(objetJS,function(val,i) {
        switch (i) {
            case 'formInscription': $('#form').html(val);
            break;
            default:
                alert('Err.retour: cas non traité...' + i)
        }
    });
}
