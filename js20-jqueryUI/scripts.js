var widgetId = 0;
var d = new Date();
var lowerBoundYear = d.getFullYear() - 16;
var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
];

$( "#autocomplete" ).autocomplete({
    source: availableTags
});

$( ".controlgroup" ).controlgroup();
$( ".controlgroup-vertical" ).controlgroup({
    "direction": "vertical"
});

$( "#button" ).button();
$( "#button-icon" ).button({
    icon: "ui-icon-gear",
    showLabel: false
});

$( "#tabs" ).tabs();


// Link to open the dialog
$( "#dialog-link" ).click(function( event ) {
    $( "#dialog" ).dialog( "open" );
    event.preventDefault();
});

$( "#datepicker" ).datepicker({
    inline: true,
    changeYear:true,
    yearRange: `1920:${lowerBoundYear}`
});

$( "#slider-range" ).slider({
    range: true,
    min: 500,
    max: 5000,
    values: [ 600, 2000 ],
    slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    }
});

$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
    " - $" + $( "#slider-range" ).slider( "values", 1 ) );

$( "#sortable" ).sortable({
    placeholder: "ui-state-highlight"
});
$( "#sortable" ).disableSelection();

$("#add-work-place").click(function (e) {
    console.log('dsads');
    createWorkPlace();
});

setSpinner = () => {
    $( ".spinner" ).spinner({
        max: 50
    });
};

setSpinner();

getSortableValues = function() {
    $.each($('#sortable').find('li'), function() {
        console.log($(this).text());
    });
};
createWorkPlace = () => {
    widgetId++;

    let newField = $("<fieldset id = 'fieldset-"+ widgetId + "'></fieldset>");

    let newLegend = $("<legend>Add previous place of work</legend>");
    let newDivControl = $("<div class='controlgroup'></div>");
    let newCloser = $("<div class='closer' id='closer-" + widgetId +"'>x</div>");

    let newInputCompany = $('<input type="text" id="previous-job-company-'+ widgetId +'" class="ui-widget1" style="width:770px" name="company-name[]" placeholder="Enter company name from your previous job"/>');
    let newInputPosition = $('<input type="text" id="previous-job-position-'+ widgetId +'" class="ui-widget1" style="width:770px" name="position-in-company[]" placeholder="Enter your position from this job"/>');
    let newPar = $('<p style="float: left;">Enter number of years in this position</p>');
    let newSpinner = $('<input id="spinner" class="spinner" name="count-of-years[]" style="width:30px; padding: 10px 2%;">');

    newDivControl.append(newInputCompany,newInputPosition, newPar, newSpinner);
    newField.append(newLegend, newDivControl,newCloser);
    newField.insertBefore($('#add-work-place'));
    setSpinner();
};

$('body').click(function(event){
    var target = $( event.target );
    if(target.hasClass( "closer" )){
        target.parent().remove();
    }
});