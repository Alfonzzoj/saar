/**
 * Created by ricar on 6/29/2015.
 */

function numToComma(number){
    if( number === undefined){
        return "0,00";
    }
    if(typeof number === "string"){
        number=parseFloat(number);
        number=isNaN(number)?0:number;
    }
    return number.toLocaleString('es',{minimumFractionDigits:2});
}
function commaToNum(string){
    if( string === undefined){
        return 0;
    }
    if(typeof string === "number")
        string+="";
    if(string=="")
        string="0";
    return Number(string.replace(/\./g, "").replace(',', "."));
}

function isValid(inputs){

    var mensajes="";
    var valid=true;
    $.each(inputs, function(index,input){
        var data=$(input).data();
        var value=$(input).val();
        data.empty=(data.empty==undefined)?true:data.empty;
        data.type= data.type || "text";

        if(!data.empty && value==""){

            mensajes+="El campo "+data.name+" no puede estar vacio<br/>";
            valid=false;
            return true;
        }
        switch(data.type) {
            case "int":
            case "integer":
                if(isNaN(parseInt(value)) && value!=""){
                    valid=false;
                    mensajes+="El campo "+data.name+" debe ser un numero entero valido<br/>";
                }
                break;
            case "float":
                if(isNaN(parseFloat(value)) && value!=""){
                    valid=false;
                    mensajes+="El campo "+data.name+" debe ser un numero decimal valido<br/>";
                }
                break;
        }


    })

    return {isValid:valid, text:mensajes};


}

/**
 * Permite hacer previews de las imagenes
 * @param input
 * @param div
 */
function readURL(input, div) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(div).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('body').delegate('.sortable-table-title', 'click', function(){
    var sortType=($(this).find('.glyphicon-sort-by-attributes').length>0)?"DESC":"ASC";
    var sortName= $(this).data('sortName');
    var sortNameInput=$('input[name="sortName"]');
    var sortTypeInput=$('input[name="sortType"]');
    $(sortNameInput).val(sortName);
    $(sortTypeInput).val(sortType);
    $(sortNameInput).closest('.box-body').find('[type=submit]').trigger('click');
})

$('body').delegate('.operator-list li', 'click', function(){
    var value=$(this).text();
    var formGroup=$(this).closest('.form-group');
    $(formGroup).find('.operator-text').text(value);
    $(formGroup).find('.operator-input').val((value=="Todos")?"_":value);
})



function processValidation(json){
    var mensaje="";
    for(var o in json){
        $.each(json[o], function(index,value){
            mensaje+=value+"<br>";
        })
    }
    return mensaje;
}


function addLoadingOverlay(box){
    $(box).append('<div class="overlay"> <i class="fa fa-refresh fa-spin"></i> </div>');
}

function removeLoadingOverlay(box){
    $(box).find('.overlay').remove();
}