function getDemoTheme() {
    var theme =  $.data(document.body, 'bootstrap');
theme='bootstrap';
    if (theme == null) {
        theme = '';
    }
    else {
        return theme;
    }
    var themestart = window.location.toString().indexOf('?bootstrap');
    if (themestart == -1) {
        return '';
    }
$(document).find('head').append('<link rel="stylesheet" href="' + url + '" media="screen" />');
  
    return theme;
};