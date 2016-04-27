Validation.add('validate-aw-rma-file-extension', 'Please use only letters (a-z or A-Z) or numbers (0-9) only in this field and commas. No spaces or other characters are allowed.', function(v) {
    var isValid = !Validation.get('IsEmpty').test(v);
    var values  = v.split(',');
    for (var i = 0; i < values.length; i++) {
        if (!/^[a-zA-Z0-9]+$/.test(values[i])) {
            isValid = false;
            break;
        }
    }
    return isValid;
});