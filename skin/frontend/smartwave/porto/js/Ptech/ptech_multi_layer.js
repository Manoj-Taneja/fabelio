// checking if IE: this variable will be understood by IE: isIE = !false
isIE = /*@cc_on!@*/false;

Control.Slider.prototype.setDisabled = function()
{
    this.disabled = true;

    if (!isIE)
    {
        this.track.parentNode.className = this.track.parentNode.className + ' disabled';
    }
};

function ptech_multilayer_hide_products()
{
    var items = $('ptech_filters_list').select('a', 'input');
    n = items.length;
    for (i = 0; i < n; ++i) {
        items[i].addClassName('ptech_multilayer_disabled');
    }

    if (typeof (ptech_slider) != 'undefined')
        ptech_slider.setDisabled();

    var divs = $$('div.ptech_loading_filters');
    for (var i = 0; i < divs.length; ++i)
        divs[i].show();
}

function ptech_multilayer_show_products(transport)
{
    var resp = {};
    if (transport && transport.responseText) {
        try {
            resp = eval('(' + transport.responseText + ')');
        }
        catch (e) {
            resp = {};
        }
    }

    if (resp.products) {

        var ajaxUrl = $('ptech_multilayer_ajax').value;

        if ($('ptech_multilayer_container') == undefined) {

            var c = $$('.col-main')[0];// alert(c.hasChildNodes());
            if (c.hasChildNodes()) {
                while (c.childNodes.length > 2) {
                    c.removeChild(c.lastChild);
                }
            }

            var div = document.createElement('div');
            div.setAttribute('id', 'ptech_multilayer_container');
            $$('.col-main')[0].appendChild(div);

        }

        var el = $('ptech_multilayer_container');
        el.update(resp.products.gsub(ajaxUrl, $('ptech_multilayer_url').value));
        catalog_toolbar_init();

        $('catalog-filters').update(
                resp.layer.gsub(
                        ajaxUrl,
                        $('ptech_multilayer_url').value
                        )
                );

        $('ptech_multilayer_ajax').value = ajaxUrl;
    }

    var items = $('ptech_filters_list').select('a', 'input');
    n = items.length;
    for (i = 0; i < n; ++i) {
        items[i].removeClassName('ptech_multilayer_disabled');
    }
    if (typeof (ptech_slider) != 'undefined')
        ptech_slider.setEnabled();
}

function ptech_multilayer_add_params(k, v, isSingleVal)
{
    var el = $('ptech_multilayer_params');
    var params = el.value.parseQuery();

    var strVal = params[k];
    if (typeof strVal == 'undefined' || !strVal.length) {
        params[k] = v;
    }
    else if ('clear' == v) {
        params[k] = 'clear';
    }
    else {
        if (k == 'price')
            var values = strVal.split(',');
        else
            var values = strVal.split('-');

        if (-1 == values.indexOf(v)) {
            if (isSingleVal)
                values = [v];
            else
                values.push(v);
        }
        else {
            values = values.without(v);
        }

        params[k] = values.join('-');
    }

    el.value = Object.toQueryString(params).gsub('%2B', '+');
}



function ptech_multilayer_make_request()
{
    ptech_multilayer_hide_products();

    var params = $('ptech_multilayer_params').value.parseQuery();

    if (!params['dir'])
    {
        $('ptech_multilayer_params').value += '&dir=' + 'desc';
    }

    new Ajax.Request(
            $('ptech_multilayer_ajax').value + '?' + $('ptech_multilayer_params').value,
            {
                method: 'get',
                onSuccess: ptech_multilayer_show_products
            }
    );
}


function ptech_multilayer_update_links(evt, className, isSingleVal)
{
    var link = Event.findElement(evt, 'A'),
            sel = className + '-selected';

    if (link.hasClassName(sel))
        link.removeClassName(sel);
    else
        link.addClassName(sel);

    //only one  price-range can be selected
    if (isSingleVal) {
        var items = $('ptech_multilayer_list').getElementsByClassName(className);
        var i, n = items.length;
        for (i = 0; i < n; ++i) {
            if (items[i].hasClassName(sel) && items[i].id != link.id)
                items[i].removeClassName(sel);
        }
    }

    ptech_multilayer_add_params(link.id.split('-')[0], link.id.split('-')[1], isSingleVal);

    ptech_multilayer_make_request();

    Event.stop(evt);
}


function ptech_multilayer_attribute_listener(evt)
{
    ptech_multilayer_add_params('p', 1, 1);
    ptech_multilayer_update_links(evt, 'ptech_multilayer_attribute', 0);
}


function ptech_multilayer_price_listener(evt)
{
    ptech_multilayer_add_params('p', 1, 1);
    ptech_multilayer_update_links(evt, 'ptech_multilayer_price', 1);
}

function ptech_multilayer_clear_listener(evt)
{
    var link = Event.findElement(evt, 'A'),
            varName = link.id.split('-')[0];

    ptech_multilayer_add_params('p', 1, 1);
    ptech_multilayer_add_params(varName, 'clear', 1);

    if ('price' == varName) {
        var from = $('adj-nav-price-from'),
                to = $('adj-nav-price-to');

        if (Object.isElement(from)) {
            from.value = from.name;
            to.value = to.name;
        }
    }

    ptech_multilayer_make_request();

    Event.stop(evt);
}


function roundPrice(num) {
    num = parseFloat(num);
    if (isNaN(num))
        num = 0;

    return Math.round(num);
}

function ptech_multilayer_category_listener(evt) {
    var link = Event.findElement(evt, 'A');
    var catId = link.id.split('-')[1];

    var reg = /cat-/;
    if (reg.test(link.id)) { //is search
        ptech_multilayer_add_params('cat', catId, 1);
        ptech_multilayer_add_params('p', 1, 1); 
        ptech_multilayer_make_request();
        Event.stop(evt);
    }
    //do not stop event
}

function catalog_toolbar_listener(evt) {
    catalog_toolbar_make_request(Event.findElement(evt, 'A').href);
    Event.stop(evt);
}

function catalog_toolbar_make_request(href)
{
    var pos = href.indexOf('?');
    if (pos > -1) {
        $('ptech_multilayer_params').value = href.substring(pos + 1, href.length);
    }
    ptech_multilayer_make_request();
}


function catalog_toolbar_init()
{
    var items = $('ptech_multilayer_container').select('.pages a', '.view-mode a', '.sort-by a');
    var i, n = items.length;
    for (i = 0; i < n; ++i) {
        Event.observe(items[i], 'click', catalog_toolbar_listener);
    }
}

function ptech_multilayer_dt_listener(evt) {
    var e = Event.findElement(evt, 'DT');
    e.nextSiblings()[0].toggle();
    e.toggleClassName('ptech_multilayer_dt_selected');
}

function ptech_multilayer_clearall_listener(evt)
{
    var params = $('ptech_multilayer_params').value.parseQuery();
    $('ptech_multilayer_params').value = 'clearall=true';
    if (params['q'])
    {
        $('ptech_multilayer_params').value += '&q=' + params['q'];
    }
    ptech_multilayer_make_request();
    Event.stop(evt);
}

function price_input_listener(evt) {
    if (evt.type == 'keypress' && 13 != evt.keyCode)
        return;

    if (evt.type == 'keypress') {
        var inpObj = Event.findElement(evt, 'INPUT');
    } else {
        var inpObj = Event.findElement(evt, 'BUTTON');
    }

    var sKey = inpObj.id.split('---')[1];
    var numFrom = roundPrice($('price_range_from---' + sKey).value),
            numTo = roundPrice($('price_range_to---' + sKey).value);

    if ((numFrom < 0.01 && numTo < 0.01) || numFrom < 0 || numTo < 0)
        return;

    ptech_multilayer_add_params('p', 1, 1);
    ptech_multilayer_add_params(sKey, numFrom + ',' + numTo, true);
    ptech_multilayer_make_request();
}

function ptech_multilayer_init()
{
    var items, i, j, n,
            classes = ['category', 'attribute', 'icon', 'price', 'clear', 'dt', 'clearall'];

    for (j = 0; j < classes.length; ++j) {
        items = $('ptech_filters_list').select('.ptech_multilayer_' + classes[j]);
        n = items.length;
        for (i = 0; i < n; ++i) {
            Event.observe(items[i], 'click', eval('ptech_multilayer_' + classes[j] + '_listener'));
        }
    }

    items = $('ptech_filters_list').select('.price-input');
    n = items.length;
    var btn = $('price_button_go');
    for (i = 0; i < n; ++i)
    {
        btn = $('price_button_go---' + items[i].value);
        if (Object.isElement(btn)) {
            Event.observe(btn, 'click', price_input_listener);
            Event.observe($('price_range_from---' + items[i].value), 'keypress', price_input_listener);
            Event.observe($('price_range_to---' + items[i].value), 'keypress', price_input_listener);
        }
    }
// finish new fix code    
}

function create_price_slider(width, from, to, min_price, max_price, sKey)
{
    var price_slider = $('ptech_multilayer_price_slider' + sKey);

    return new Control.Slider(price_slider.select('.handle'), price_slider, {
        range: $R(0, width),
        sliderValue: [from, to],
        restricted: true,
        onChange: function(values) {
            var f = calculateSliderPrice(width, from, to, min_price, max_price, values[0]),
                    t = calculateSliderPrice(width, from, to, min_price, max_price, values[1]);

            ptech_multilayer_add_params(sKey, f + ',' + t, true);

            $('price_range_from' + sKey).update(f);
            $('price_range_to' + sKey).update(t);

            ptech_multilayer_make_request();
        },
        onSlide: function(values) {
            $('price_range_from' + sKey).update(calculateSliderPrice(width, from, to, min_price, max_price, values[0]));
            $('price_range_to' + sKey).update(calculateSliderPrice(width, from, to, min_price, max_price, values[1]));
        }
    });
}

function calculateSliderPrice(width, from, to, min_price, max_price, value)
{
    var calculated = roundPrice(((max_price - min_price) * value / width) + min_price);

    return calculated;
}
$("#ptech_multilayer_price_sliderprice").click(function(e){

                                        var parentOffset = $(this).parent().offset(); 

                                         //or $(this).offset(); if you really just want the current element's offset

                                        var relX = e.pageX - parentOffset.left;
alert(relX);
                                        var relY = e.pageY - parentOffset.top;

                                        $('.handle-left').css('left',relX+'px');

                                    });
