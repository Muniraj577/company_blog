function printResult() {
    $("#print").hide();
    $("#open").hide();
    var DocumentContainer = document.getElementById('section-to-print');
    var WindowObject = window.open('', "PrintWindow");
    WindowObject.document.writeln(DocumentContainer.innerHTML);

    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
    $("#print").show();
    $("#open").show();
}

function newWindow() {
    addCss('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css');
    $("#print").hide();
    $("#open").hide();
    var wi = window.open();
    var html = $('#section-to-print').html();
    $(wi.document.body).html(html);
    $("#print").show();
    $("#open").show();
}
