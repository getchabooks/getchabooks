// BROWSE: Term -> Department -> Course -> Section

var Browse = {};
Browse.GET_TERMS_URL       = Globals.BASE_URL + "get/terms/"
Browse.GET_DEPARTMENTS_URL = Globals.BASE_URL + "get/departments/";
Browse.GET_COURSES_URL     = Globals.BASE_URL + "get/courses/";
Browse.GET_SECTIONS_URL    = Globals.BASE_URL + "get/sections/";


function stringifyDepartmentList(data) {
    var s = "<option value='NULL' selected='true'>Select a Department</option>";
    _.each(data, function(value){
        s += "<option value=" + value.id + ">" + value.name + "</option>";
    });
    return s;
}

function stringifyCourseList(data)
{
    var s = "<option value='NULL' selected='true'>Select a Course</option>";
    _.each(data, function(value){
        var n = '';
        if (value.name && value.name !== "") {
            n = ": " + value.name;
        }

        s += "<option value=" + value.id + ">" + value.number + n + "</option>";
    });
    return s;
}

function stringifySectionList(data) {
    var s = "<option value='NULL' selected='true' disabled='disabled'>Select a Section</option>";
    _.each(data, function(value){
        var n = '';
        if (value.professor && value.professor !== "") {
            n = " - " + value.professor;
        }

        if (Selection.itemAlreadyAdded(value.id)) {
            s += "<option value=" + value.id + " disabled='disabled'>(Already Added) " + value.number + n + "</option>";
        } else {
            s += "<option value=" + value.id + ">" + value.number + n + "</option>";
        }
    });
    return s;
}

// Loads the drop-down course list based on a selected department.
function departmentWasPicked()
{
    var value = $(this).val();
    if (value == "NULL") {
        $("#course option[value=NULL]").attr("selected","selected");
        $("#course").attr("disabled", true);
    }
    else {
        $("#course").html("<option value='NULL' selected='true'>Loading Courses...</option>")
                    .attr("disabled", true);

        $.cachedAjax({
            url: Browse.GET_COURSES_URL + value,
            dataType: "json",
            success: departmentSelectedCallback
        });
    }

    $("#section").attr("disabled", true);
}

function departmentSelectedCallback(data)
{
    $("#course").html( stringifyCourseList(data) ).attr("disabled", false);
}



function courseWasPicked()
{
    var value = $(this).val();
    if (value == "NULL"){
        $("section option[value=NULL]").attr("selected","selected");
        $("#section").attr("disabled",true);
    }
    else {
        $("#section").html("<option value='NULL' selected='true'>Loading Sections...</option>")
                     .attr("disabled", true);

        $.cachedAjax({
            url: Browse.GET_SECTIONS_URL + value,
            dataType: "json",
            success: courseSelectedCallback
        });
    }
}

function courseSelectedCallback(data)
{
    _.each(data, function(value) {
        value.id = value.id.replace(/\s/,'%20');
    });

    $("#section").html( stringifySectionList(data) )
                 .attr("disabled",false);

    if ( $("#section").children().length == 2 ) { // only one section
        var id = $("#section").children(":eq(1)").attr('value');
        if (!Selection.itemAlreadyAdded(id)) {
            browseAdd(id);
        }
    }
}



// Displays the submit button.
function sectionWasPicked()
{
    var id = $("#section").val();
    
    if (id == 'NULL') {
        return;
    }

    browseAdd(id);
}

// Adds a course to the queue.
// TODO: Is it really necessary for it to take an id and select from jQuery?
function browseAdd(id)
{
    $("#department option[value=NULL]").attr("selected","selected");
    $("#course option[value=NULL]").attr("selected","selected");
    $("#section option[value=NULL]").attr("selected","selected");
    $("#course").attr("disabled",true);
    $("#section").attr("disabled",true);
    $("#department").focus();

    Selection.addItem(id);
}

$(document).ready(function() {
    $("#department").on('change', departmentWasPicked);
    $("#course").on('change', courseWasPicked);
    $("#section").on('change', sectionWasPicked);

});
