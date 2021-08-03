$.validator.addMethod("passwordCheck", function (value, element) {
    return this.optional(element) || /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/
        .test(value);
}, "Password must contain at least one uppercase , lowercase, digit and special character");

$.validator.addMethod("customemail",
    function (value, element) {
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    },
    "Please enter valid email address",
);

$.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z][a-zA-Z\s]*$/i.test(value);
}, "Only alphabets suppported");
