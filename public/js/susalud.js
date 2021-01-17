$('#producto_id').change(function (event) {
    $.get('producto/' + event.target.value + "", function (response, state) {
        for (var i = 0; i < response.colores.length; i++) {
            $('#colores').append('<div class="form-check form-check-inline"> <input class="form-check-input" type="radio" name="color" id="inlineRadio1" value="' + response.colores[i].id + '"><label class="form-check-label" for="inlineRadio1">' + response.colores[i].nombre + '</label></div>');
        }
        for (var i = 0; i < response.tallas.length; i++) {
            $('#tallas').append('<div class="form-check form-check-inline"> <input class="form-check-input" type="radio" name="talla" id="inlineRadio1" value="' + response.tallas[i].id + '"><label class="form-check-label" for="inlineRadio1">' + response.tallas[i].nombre + '</label></div>');
        }
    })
});

$('.currency').on('blur', function () {
    const value = this.value.replace(/,/g, '');
    this.value = parseFloat(value).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
    });
});

$('.currency').val(function (index, curValue) {
    if (curValue) {
        curValue = curValue.replace(/,/g, '');
        return parseFloat(curValue).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        });
    }
    return curValue;
});
