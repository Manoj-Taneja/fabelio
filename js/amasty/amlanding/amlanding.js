function amlanding_menu()
{
    $$('#nav li.active').each(function(item) {$(item).removeClassName("active")});
}
document.observe("dom:loaded", function() { amlanding_menu(); }); 