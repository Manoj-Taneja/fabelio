var awStoreCreditManager = Class.create();

awStoreCreditManager.prototype = {
    initialize: function (config) {
        this.config = config;
        this.quoteBaseGrandTotal = config.quoteBaseGrandTotal;
        this.balance = config.balance;
        this.formattedBalance = config.formattedBalance;
        this.baseBalance = config.baseBalance;
        this.baseStorecreditAmountUsed = config.baseStorecreditAmountUsed;
        this.isStorecreditSubstracted = config.isStorecreditSubstracted;
        this.storecreditBox = $$(config.storecreditBoxSelector).first();
        this.storecreditCheckbox = $$(config.storecreditCheckboxSelector).first();
        this.storecreditAvailableAmount= $$(config.storecreditAvailableAmountSelector).first();

        this.addFunctions();
        this.initObservers();
        this.setStorecreditAvailable();
    },

    switchStorecreditCheckbox: function() {
        if (!this.isStorecreditSubstracted && this.storecreditCheckbox.checked) {
            this.quoteBaseGrandTotal -= this.baseBalance;
            this.isStorecreditSubstracted = true;
        }

        if (this.isStorecreditSubstracted && !this.storecreditCheckbox.checked) {
            this.quoteBaseGrandTotal += this.baseBalance;
            this.isStorecreditSubstracted = false;
        }

        if (this.quoteBaseGrandTotal < 0.0001) {
            var elements = Form.getElements(payment.form);
            for (var i=0; i<elements.length; i++) {
                if (this.storecreditCheckbox.checked) {
                    if (elements[i].name == 'payment[method]') {
                        elements[i].disabled = true;
                    }
                }
                if (elements[i].name == 'payment[method]' && elements[i].value == 'free') {
                    elements[i].checked = false;
                    elements[i].disabled = true;
                    $(elements[i].parentNode).hide();
                }
            }

            if (this.storecreditCheckbox.checked) {
                $('checkout-payment-method-load').hide();
                payment.switchMethod();
            }
        } else {
            var elements = Form.getElements(payment.form);
            for (var i=0; i<elements.length; i++) {
                if (elements[i].name == 'payment[method]') {
                    elements[i].disabled = false;
                }
            }
            $('checkout-payment-method-load').show();
            payment.switchMethod(payment.lastUsedMethod);
        }

    },

    addFunctions: function () {
        var me = this;
        if (payment) {
            payment.addBeforeInitFunction('storecredit', me.grandTotalInit.bind(me));
            payment.addAfterInitFunction('storecredit', me.storecreditInit.bind(me));
            payment.addBeforeValidateFunction('storecredit', me.storecreditValidate.bind(me));
        }
    },

    initObservers: function() {
        var me = this;
        Event.observe(this.storecreditCheckbox, 'click', me.switchStorecreditCheckbox.bind(me));
    },

    grandTotalInit: function () {
        if (this.isStorecreditSubstracted) {
            this.quoteBaseGrandTotal += this.baseStorecreditAmountUsed;
            this.isStorecreditSubstracted = false;
        }
    },

    storecreditInit: function () {
        if (this.storecreditCheckbox) {
            this.storecreditCheckbox.disabled = false;
        }
        this.switchStorecreditCheckbox();
    },

    storecreditValidate: function () {
        if (this.quoteBaseGrandTotal < 0.0001) {
            return true;
        }
        return false;
    },

    setStorecreditAvailable: function () {
        if (this.storecreditBox) {
            if (this.balance == 0) {
                this.storecreditCheckbox.checked = false;
                this.storecreditCheckbox.disabled = true;
                this.storecreditBox.hide();
            } else {
                this.storecreditCheckbox.disabled = false;
                this.storecreditBox.show();
            }
        }

        if (this.storecreditAvailableAmount) {
            this.storecreditAvailableAmount.innerHTML = this.formattedBalance;
        }
    }
};