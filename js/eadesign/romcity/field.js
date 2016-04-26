/**
 * Created by eadesignpc on 5/5/2015.
 */
function getAjaxReqest(action, selectCountry, stateId, normalImput,selectedCity) {
    var request = new Ajax.Request(action,
        {
            method: 'GET',
            onSuccess: function (data) {
                $('billing:city').replace('<select id="billing:city" name="billing[city]" class="required-entry">' +
                '<option value=""></option>' + convertJsonToHtml(data.responseText, this,selectedCity) +
                '</select>');
            },
            onFailure: $('billing:city').replace(normalImput),
            parameters: {city_id: stateId, country_id: selectCountry}
        }
    );
}



function getAjaxReqestCustomer(action, selectCountry, stateId, normalImput, selectedCity) {
    var request = new Ajax.Request(action,
        {
            method: 'GET',
            onSuccess: function (data) {
                $('city').replace('<select id="city" name="city" class="required-entry">' +
                '<option value=""></option>' + convertJsonToHtml(data.responseText, this, selectedCity) +
                '</select>');
            },
            onFailure: $('city').replace(normalImput),
            parameters: {city_id: stateId, country_id: selectCountry}
        }
    );
}
function getAjaxReqestShip(action, selectCountry, stateId, normalImput,selectedCity) {
    if (normalImput != null) {
        var resetShip = true;
    } else {
        var resetShip = false;
    }

    var request = new Ajax.Request(action,
        {
            method: 'GET',
            onSuccess: function (data) {
                $('shipping:city').replace('<select id="shipping:city" name="shipping[city]" class="required-entry">' +
                '<option value=""></option>' + convertJsonToHtml(data.responseText, this,selectedCity) +
                '</select>');
            },
            onFailure: function (resetShip) {
                if (resetShip) {
                    $('shipping:city').replace(normalImput)
                }
            },

            parameters: {city_id: stateId, country_id: selectCountry}
        }
    );
}

function convertJsonToHtml(data, ship, selectedCity) {

    var jsonData = data.evalJSON();

    if (jsonData.length == 0) {
        ship.replace(normalImput);
        return;
    }

    htmlData = '';

    jsonData.each(function (item) {
        if (item.cityname == selectedCity) {
            htmlData += '<option value="' + item.cityname + '" selected>' + item.cityname + '</option>';
        } else {
            htmlData += '<option value="' + item.cityname + '">' + item.cityname + '</option>';
        }

    });

    return htmlData;
}
