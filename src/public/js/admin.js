var delay = (function(){
    var timer = 0;
    return function(callback, ms){
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
    };
})();

$(document).ready(function() {
   
    // BOUTON VALIDATION PAYEMENT
    $(".btn-escroc").click(function( event ) {
        event.preventDefault();
        var e = $(this);
        let nameGamer = $(this).attr('data-nameGamer')
        let nameEsilan = $(this).attr('data-nameEsilan')
        if(confirm("Valider l'inscription de "+nameGamer+" pour "+nameEsilan+" ?")) {
            $.get('/admin/ajax/ticketValidation', {
                idTicket: $(this).attr('data-idTicket')
            }).done(function(data) {
                console.log("OK")
                e.off('click');
                // e.click(preventDefault());
                e.removeClass("btn-escroc")
                e.addClass("btn-payeur");
                e.html("A payé");
                // e.parent().parent().find(".validateBy").html(data.nameValidator);
                // e.parent().parent().find(".dateValidation").html(data.dateValidation);

                e.parent().parent().find(".column-ticket-validation").html(data.dateValidation+"<span class=\"time\"> à "+data.timeValidation+"</span><span class=\"validation\">Par <span class=\"validator\">"+data.nameValidator+"</span></span>")

            }).fail(function() {
                console.log("NOK")
            });
        }
    });

    // BOUTON COMPATIBILITE TOURNOIS
    var onClickCompatible = function(event){
        event.preventDefault();
        var e = $(this);

        e.find(".checkmark").addClass("loading");
        $.get('/admin/ajax/compatibilityTypeTournament/disable', {
            idTicketType: $(this).attr('data-idTicketType'),
            idTournament: $(this).attr('data-idTournament')
        }).done(function(data) {
            e.find(".checkmark").removeClass("loading")
            e.find(".checkmark").removeClass("checkmark-checked")

            e.removeClass("type-tourn-compatible")
            e.addClass("type-tourn-notcompatible");
            e.off('click');
            e.click(onClickNotCompatible);
            e.find(".checkmark-text").html("Pas Compatible")
        }).fail(function() {
            e.find(".checkmark").removeClass("loading")
        });
    }
    var onClickNotCompatible = function(event){
        event.preventDefault();
        var e = $(this);

        e.find(".checkmark").addClass("loading");
        $.get('/admin/ajax/compatibilityTypeTournament/enable', {
            idTicketType: $(this).attr('data-idTicketType'),
            idTournament: $(this).attr('data-idTournament')
        }).done(function(data) {
            e.find(".checkmark").removeClass("loading")
            e.find(".checkmark").addClass("checkmark-checked")

            e.removeClass("type-tourn-notcompatible")
            e.addClass("type-tourn-compatible");
            e.off('click');
            e.click(onClickCompatible);
            e.find(".checkmark-text").html("Compatible")
        }).fail(function() {
            e.find(".checkmark").removeClass("loading")
        });
    }

    $(".type-tourn-compatible").click(onClickCompatible)
    $(".type-tourn-notcompatible").click(onClickNotCompatible)


    // GET GAME AND TOURNAMENT DATAS
    $("#inputIdGame").change(function(event){
        // event.preventDefault();
        var e = $(this);

        $.get('/admin/ajax/games/imgName', {
            idGame: e.val()
        }).done(function(data) {
            console.log("OK");
            e.parent().find(".select-img").attr("src", "/"+data.imgName);
        })
    })
    $("#inputIdEsilan").change(function(event){
        // event.preventDefault();
        var e = $(this);

        $.get('/admin/ajax/esilan/imgName', {
            idEsilan: e.val()
        }).done(function(data) {
            console.log("OK");
            e.parent().find(".select-img").attr("src", "/"+data.imgName);
        })
    })
    $("#inputIdGame").change();
    $("#inputIdEsilan").change();


    // // SEARCH INPUT 
    // $("#search-user").keyup(function() {
    //     var e = $(this);
    //     if (e.val() === ""){
    //         $("#table-user").show();
    //         $("#table-user-pagination").show();
    //         $("#table-user-search").hide();
    //     } else {
    //         delay(function(){
                
    //             $.get('/admin/ajax/users', {
    //                 name: e.val()
    //             }).done(function(data) {
    //                 console.log("OK");
    //                 e.parent().find(".select-img").attr("src", "/upload/"+data.imgName);
    //             })
    //         }, 1000 );               
    //     }
    // });

    // ADD TICKET TYPE WHEN CREATING ESILAN
    $('#addTicketType').click(() => {
        let index = $(".ticket-types .ticket-type").index( document.getElementById("addTicketType") )+1;
        let element = `
        <div class="ticket-type ticket-type-fill">
        <img class="suppress-button degrow" src="../../img/dustbin.png">
        <input type="hidden" name="" value="">
        <fieldset class="field-ticket-type">
            <legend>Type de place</legend>

            <div class="form-simple form-element">
                <label for="inputTitleTicketType${index}">Nom de la place<span class="required">*</span></label>
                <input type="text" id="inputTitleTicketType${index}" name="ticketTypes[${index}][ticketTypeName]" placeholder="Place PC" value="" required>
            </div>
            <div class="form-simple form-element">
                <label for="inputDescTicketType${index}">Description<span class="required">*</span></label>
                <textarea id="inputDescTicketType${index}" name="ticketTypes[${index}][ticketTypeDesc]" required></textarea>
            </div>

            <div class="form-double">
                <div class="form-element">
                    <label for="inputPriceTicketType${index}">Prix de la place (en €)<span class="required">*</span></label>
                    <input type="number" id="inputPriceTicketType${index}" name="ticketTypes[${index}][ticketTypePrice] placeholder="5,00" pattern="^\d+(\.|\,)\d{2}$" value="" step="any" required>
                </div>

                <div class="form-element">
                    <label for="inputNumPlaceTicketType${index}">Nombre de ticket<span class="required">*</span></label>
                    <input type="number" id="inputNumPlaceTicketType${index}" name="ticketTypes[${index}][ticketTypeMax]" value="" required>
                </div>
            </div>
        </fieldset>
    </div>`
        $('#addTicketType').before(element);
        $('.suppress-button').click(function(event) {
            event.preventDefault();
            $(this).closest(".ticket-type").remove();
        });
    });

    
})