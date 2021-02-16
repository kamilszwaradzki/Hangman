$("#custom-styles").on("change",function() {
   var selected_style = $("#custom-styles option:selected").attr('value');
   var current_style = $("#custom-theme").attr('href');
   $("#custom-theme").attr('href', current_style.replace(/(css\/).*?(\.css)/,"$1" + selected_style + "$2"));
});