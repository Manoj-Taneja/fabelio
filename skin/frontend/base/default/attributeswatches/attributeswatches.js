jQuery.noConflict();
function addNewConfigurableProductMethods() {
    if (typeof (Product) !== "undefined" && typeof (Product.Config) !== "undefined") {
        /* override default configure element function */
        Product.Config.addMethods({
            configureElement: function(element) {
                /*from original code*/
                this.reloadOptionLabels(element);
                if (element.value) {
                    //console.debug(element);
                    _disable_cart_button = false;
                    //console.debug(element.config.options);
                    //console.debug(element.config.options.length);
                    for (var k = 0; k < element.config.options.length; k++) {
                        if (element.config.options[k].id === element.value && typeof (element.config.options[k].optionSaleable) !== "undefined" && !element.config.options[k].optionSaleable) {
                            //console.debug("will disable button");
                            _disable_cart_button = true;
                        }
                    }
                    /* disable the add to cart button when item is not saleable */
                    if (_disable_cart_button) {
                        jQuery("#product_addtocart_form .button.btn-cart").attr("disabled", "disabled").addClass("disabled");
                    } else {
                        jQuery("#product_addtocart_form .button.btn-cart").removeAttr("disabled").removeClass("disabled");
                    }
                    /* eof disable the add to cart button when item is not saleable */
                    this.state[element.config.id] = element.value;
                    if (element.nextSetting) {
                        element.nextSetting.disabled = false;
                        this.fillSelect(element.nextSetting);
                        this.resetChildren(element.nextSetting);
                    }
                }
                else {
                    this.resetChildren(element);
                }
                this.reloadPrice();
                /*from orignal code*/
                /* swatches extra functions */
                window.enableSwatchesOptions(element.config.id);
                window.resetLabels(element.config.id);
                window.switchGallery(element.config.id);
                /*eof swatches extra functions */
            },
            getOptionLabel: function(option, price) {
                var price = parseFloat(price);
                if (this.taxConfig.includeTax) {
                    var tax = price / (100 + this.taxConfig.defaultTax) * this.taxConfig.defaultTax;
                    var excl = price - tax;
                    var incl = excl * (1 + (this.taxConfig.currentTax / 100));
                } else {
                    var tax = price * (this.taxConfig.currentTax / 100);
                    var excl = price;
                    var incl = excl + tax;
                }
                if (this.taxConfig.showIncludeTax || this.taxConfig.showBothPrices) {
                    price = incl;
                } else {
                    price = excl;
                }
                var str = option.label;
                /* added out of stock label */
                if (typeof option.optionSaleable !== "undefined" && !option.optionSaleable)
                    str += window.out_of_stock_string();
                if (price) {
                    if (this.taxConfig.showBothPrices) {
                        str += ' ' + this.formatPrice(excl, true) + ' (' + this.formatPrice(price, true) + ' ' + this.taxConfig.inclTaxTitle + ')';
                    } else {
                        str += ' ' + this.formatPrice(price, true);
                    }
                }
                return str;
            },
            fillSelect: function(element) {
                var attributeId = element.id.replace(/[a-z]*/, '');
                var options = this.getAttributeOptions(attributeId);
                this.clearSelect(element);
                element.options[0] = new Option(this.config.chooseText, '');
                var prevConfig = false;
                if (element.prevSetting) {
                    prevConfig = element.prevSetting.options[element.prevSetting.selectedIndex];
                }
                //_all_options_not_saleable = true;
                if (options) {
                    var index = 1;
                    for (var i = 0; i < options.length; i++) {
                        var allowedProducts = [];
                        if (prevConfig) {
                            for (var j = 0; j < options[i].products.length; j++) {
                                if (prevConfig.config.allowedProducts
                                        && prevConfig.config.allowedProducts.indexOf(options[i].products[j]) > -1) {
                                    allowedProducts.push(options[i].products[j]);
                                }
                            }
                        } else {
                            allowedProducts = options[i].products.clone();
                        }
                        //console.debug(allowedProducts);
                        /*To add an out of stock label*/
                        _option_saleable = false;
                        if (allowedProducts.size() > 0 && typeof (this.config.saleableProducts) !== "undefined") {
                            for (var k = 0; k < allowedProducts.length; k++) {
                                if (this.config.saleableProducts[allowedProducts[k]] === true) {
                                    _option_saleable = true;
                                    break;
                                }
                            }
                        }
                        options[i].optionSaleable = _option_saleable;
                        //if(_option_saleable) _all_options_not_saleable = false;
                        /*eof To add an out of stock label*/
                        if (allowedProducts.size() > 0) {
                            options[i].allowedProducts = allowedProducts;
                            element.options[index] = new Option(this.getOptionLabel(options[i], options[i].price), options[i].id);
                            if (typeof options[i].price !== 'undefined') {
                                element.options[index].setAttribute('price', options[i].price);
                            }
                            if (!options[i].optionSaleable) {
                                element.options[index].setAttribute('disabled', 'disabled');
                            }
                            element.options[index].config = options[i];
                            index++;
                        }
                    }
        }
            },
            reloadOptionLabels: function(element) {
                var selectedPrice;
                if (typeof element.options[element.selectedIndex] !== "undefined" && element.options[element.selectedIndex].config && !this.config.stablePrices) {
                    selectedPrice = parseFloat(element.options[element.selectedIndex].config.price);
                }
                else {
                    selectedPrice = 0;
                }
                for (var i = 0; i < element.options.length; i++) {
                    if (element.options[i].config) {
                        element.options[i].text = this.getOptionLabel(element.options[i].config, element.options[i].config.price - selectedPrice);
                    }
                }
            }
        });
        if (typeof window.mng_Config !== "undefined") {
            jQuery.each(window.mng_Config.attributes, function(att_id) {
                _container = jQuery("#attribute-" + this.id + "-container.product-swatches-container #swatches-options-" + this.id);
                /*jQuery.each(this.options, function(){
                 _container.append('<a href="#" id="swatches_option_value_' + this.id + '" val="' + this.id + '" class="">' +  this.label  + '</a>');
                 });*/
                /*if(mng_Config.attributes[att_id].swatches_type=="image" || mng_Config.attributes[att_id].swatches_type=="label"){
                 jQuery("select#attribute" + att_id).css("display","none");
                 }*/
                _container.find("a").on("click", function() {
                    if (jQuery(this).hasClass("active") && !jQuery(this).hasClass("selected")) {
                        //jQuery("#product-options-wrapper dl dd select#attribute" + att_id).val( jQuery(this).attr("rel") );
                        jQuery(this).closest("ul").find("a").removeClass("selected");
                        jQuery(this).addClass("selected");
                        jQuery("dt#label-attribute-" + att_id + " label span").hide();
                        jQuery("dt#label-attribute-" + att_id + " span.selected-label").text(" : " + jQuery(this).data("original-title"));
                        jQuery("#product-options-wrapper dl dd select#attribute" + att_id).val(jQuery(this).attr("rel"));//.change();
                        //console.debug(mng_Config.attributes[att_id].has_swatches);
                        //if(mng_Config.attributes[att_id].swatches_type=="image"  && jQuery(this).attr("href")!="#" ){
                        //jQuery(".product-img-box .product-image img").attr("src", jQuery(this).attr("href"));
                        //}
                        /* when event is triggered from select with function .click()  */
                        if (window._configureElement) {
                            window.spConfig.configureElement($('attribute' + att_id));
                        }
                        /*reset value to true*/
                        window._configureElement = true;
                        _value = jQuery(this).attr("rel");
                    }
                    return false;
                }).on("mouseenter", function() {
                    if (jQuery(this).closest("ul").hasClass("has-swatches")) {
                        jQuery(this).siblings("span.tooltip-container").addClass("on");
                    }
                }).on("mouseleave", function() {
                    if (jQuery(this).closest("ul").hasClass("has-swatches")) {
                        jQuery(this).siblings("span.tooltip-container").removeClass("on");
                    }
                });
            });
        }
    }
    /* select click to activate swatches actions */
    jQuery(document).on("change", "#product-options-wrapper dd select.configurable-option-select", function() {
        /* find swatch/label to click */
        _swatch = jQuery(".product-swatches-container ul li a#swatches_option_value_" + jQuery("option:selected", this).val());
        if (_swatch.length > 0) {
            window._configureElement = false;/* do not trigger the configureElement function again */
            _swatch.click();
        }
    });
}
;
function swatchesSelectDefaultValueOnHash() {
    /* get default values from window hash */
    if (window.location.hash) {
        var _hash = location.hash.slice(1);
        jQuery.each(_hash.split('&'), function(c, q) {
            var i = q.split('='); /*retrieve the att-option pair, the parameters must be arranged as the options*/
            if (parseInt(i[0]) > 0) {
                jQuery("#attribute-" + i[0].toString() + "-container.product-swatches-container #swatches-options-" + i[0].toString() + " a.active#swatches_option_value_" + i[1].toString()).click();
            }
        });
    }
    /*for selecting default values on the product details page , in case there are default values and no hash is set*/
    else if (typeof mng_Config !== "undefined" && typeof mng_Config.defaultValues !== "undefined") {
        jQuery.each(mng_Config.defaultValues, function(att_id) {
            /* if the select has a selected value and the value is active */
            jQuery("#attribute-" + att_id + "-container.product-swatches-container #swatches-options-" + att_id + " a.active#swatches_option_value_" + mng_Config.defaultValues[att_id]).click();
        });
    }
}
;
var _content_is_hidden = false;
var _configureElement = true;
jQuery(document).ready(function() {

    /* product list functions */
    jQuery(document).on("mouseenter", "ul.attribute-swatches.product-list li a", function() {
        //console.debug(this);
        _item = jQuery(this).closest('li.item');
        if (jQuery(this).attr("rel")) {
            _item.find('.product-image > img.catalog-product-image').attr("src", jQuery(this).attr("rel"));
        }
        _item.find('.product-image, .product-name a').attr("href", jQuery(this).attr("href"));

        jQuery(this).closest('ul.attribute-swatches li').find('span').addClass("on");
    }).on("mouseleave", "ul.attribute-swatches.product-list li a", function() {
        jQuery(this).closest('ul.attribute-swatches li').find('span').removeClass("on");
    });
    
    /* touchscreen, click to activate swatches */
    if ('ontouchstart' in document.documentElement) {
        jQuery(document).on("touchstart", "ul.attribute-swatches.product-list li a", function(e) {
            e.preventDefault();
            e.stopPropagation();
            jQuery('ul.attribute-swatches li a').removeClass("touched");
            jQuery('ul.attribute-swatches li span').removeClass("on");
            _item = jQuery(this).closest('li.item');
            if (jQuery(this).attr("rel")) {
                _item.find('.product-image > img.catalog-product-image').attr("src", jQuery(this).attr("rel"));
            }
            _item.find('.product-image, .product-name a').attr("href", jQuery(this).attr("href"));
            jQuery(this).addClass("touched").closest('ul.attribute-swatches li').find('span').addClass("on");
        }).on("touchend click", "ul.attribute-swatches.product-list li a", function(e) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        });
    }
    
    
    /* if layered navigation is enabled, an option was selected and the configuration value was set to yes: */
    /*if (typeof window._FILTER_SELECTED_OPTION !="undefined"){
     jQuery("ul.attribute-swatches.product-list li a." + _FILTER_SELECTED_OPTION).each(function(){
     jQuery(this).closest('li.item').find('.product-image > img').attr("src",jQuery(this).attr("rel"));
     })
     }*/


    /* gallery functions */
    jQuery(document).on("click", "div#product-gallery-container li.product-image-thumbs > a", function(event) {
        event.preventDefault();
        
        jQuery("a#main-image-link").attr("href", jQuery(this).attr("rel"));
        jQuery("a#main-image-link img#image").attr("alt", jQuery(this).attr("title"));
        jQuery("a#main-image-link img#image").attr("title", jQuery(this).attr("title"));
        jQuery("a#main-image-link img#image").attr("src", jQuery(this).attr("href"));
        if (jQuery.fn.CloudZoom !== undefined) {
            jQuery('#main-image-link').CloudZoom();
        }
    });


    /* enable gallery carousel if bxslider enabled */
    if (jQuery.fn.bxSlider !== undefined && window._ENABLE_PRODUCT_GALLERY_CAROUSEL) {
        /* COPY ALL THE ITEMS FROM THE SLIDER FIRST TO A DUMMY CONTAINER, THEN COPY THEM BACK  */
        jQuery("#product-gallery-container ul.slides").clone().appendTo("#product-gallery-container-temp");
        jQuery("#product-gallery-container ul.slides li:hidden").remove();/* remove hidden elements for the carousel to load correctly */
        jQuery('#product-gallery-container-temp ul.slides li').removeAttr("style");/* use this for items disabled in the gallery by default...*/
        window.startCarousel( false );
    }

});

function enableSwatchesOptions(select_id) {
    _enable_refresh = false;
    _disable_elements = false;
    //console.debug(select_id);
    if (select_id === "first") {
        _disable_elements = true;
        _enable_refresh = true;
    }
    jQuery("#product-options-wrapper dl dd select.super-attribute-select").each(function() {
        if (_disable_elements) {
            jQuery(this).closest("dd").find(".product-swatches-container ul li a").removeClass("selected").removeClass("active");
        }
        _select = jQuery(this);
        if (_enable_refresh) {
            if (!jQuery(this).prop("disabled")) {
                jQuery("option", this).each(function() {
                    jQuery("a#swatches_option_value_" + jQuery(this).val()).addClass("active");
                });
            }
            _enable_refresh = false;
        }
        if (jQuery(this).attr("id") === "attribute" + select_id) {
            _disable_elements = true;
            _enable_refresh = true;
        }
    });
}
;
function resetLabels(select_id) {
    _reset = false;
    jQuery("#product-options-wrapper dl dt").each(function() {
        if (_reset === true) {
            jQuery("label span", this).show();
            jQuery("span.selected-label", this).text("");
        }
        //if(att_id == select_id ) _reset = true;
        if (jQuery(this).attr("id") === "label-attribute-" + select_id)
            _reset = true;
    });
}
;
function switchGallery(select_id) {
    //console.debug(jQuery(this).attr("id"));
    /* switch only if select can switch the gallery */
    if (jQuery("#product-options-wrapper dd select.configurable-option-select.switch-gallery#attribute" + select_id).length > 0) {
        _classes = new Array();
        jQuery("#product-options-wrapper dd select.configurable-option-select.switch-gallery").each(function() {
            if (jQuery("option:selected", this).val() !== "") {
                //console.debug(jQuery(this).attr("id") + "-"+jQuery("option:selected",this).val() );
                _classes.push(jQuery(this).attr("id") + "-" + jQuery("option:selected", this).val());
            }
        });
        _class = _classes.join(".");
        if (!_class)
            return;/* don't do anything if there is no class... */
        /* enable gallery carousel if bxslider enabled */
        if (jQuery.fn.bxSlider !== undefined && window._ENABLE_PRODUCT_GALLERY_CAROUSEL) {
            /* copy items from dummy container and remove existing items in bxslider */
            /* destroy slider first  */
            _carousel = jQuery('#product-gallery-container ul.slides').bxSlider();
            _carousel.destroySlider();
            jQuery('#product-gallery-container').empty();
            jQuery('#product-gallery-container').append('<ul class="slides"></ul>');
            /* copy items */
            jQuery("#product-gallery-container-temp ul.slides li." + _class).clone().appendTo("#product-gallery-container ul.slides");
            /* restart slider */
            window.startCarousel(true );
            
            
            
        } else {
            jQuery("div.more-views-container ul li").hide();
            if (_class !== "") {
                jQuery("div.more-views-container ul li." + _class).show();
                jQuery("div.more-views-container ul li." + _class + " a").first().click();
            }
        }


    }
}
;
function startCarousel(  goToFirst  ) {
    /* don't start carousel without items */
    if(!jQuery("#product-gallery-container ul.slides li").length) return ;
    /* hide pager when too few items */
    _show_controls = window._PRODUCT_GALLERY_CAROUSEL_MIN_ITEMS < jQuery("#product-gallery-container ul.slides li").length ;
    window._PRODUCT_CAROUSEL_GALLERY_SETTINGS['controls'] = _show_controls; 
    /*start carousel w settings*/
    _carousel = jQuery('#product-gallery-container ul.slides').bxSlider(window._PRODUCT_CAROUSEL_GALLERY_SETTINGS);
    if(goToFirst){
        _carousel.goToSlide(0);
        jQuery("#product-gallery-container ul li." + _class ).not('.bx-clone').first().find('a').click();
    }
}