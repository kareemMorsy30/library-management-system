/*jslint plusplus: true, evil: true */
/*global console, alert, prompt, confirm, $, jQuery */

$(function () {
    "use strict";
    var table = $('#categoriesTable').DataTable({
        select: {
            style: "multi+shift",
            selector: "td:first-child"
        },
        language: {
            select: {
                rows: {
                    '_': "%d Categories Selected",
                    1: "1 Category Selected",
                    0: ""
                }
            },
            lengthMenu: "Show _MENU_ Categories",
            info: "Showing _START_ to _END_ of _TOTAL_ Categories"
        },
        columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: false,
            className: "select-checkbox"
        },
            {
                targets: 3,
                width: "15%"
            },
            {
                targets: 1,
                width: "35%"
            }
            ],
        order: [[1, "asc"]],
        search: true,
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });
    table.on("click", "th.select-checkbox", function () {
        if ($("th.select-checkbox").hasClass("selected")) {
            table.rows().deselect();
            $("tbody tr").find("input").prop("disabled", "true");
            $("tbody tr").find("textarea").prop("disabled", "true");
            $("tbody tr").find("input").addClass("hide-input");
            $("tbody tr").find("textarea").addClass("hide-textarea");
            $("th.select-checkbox").removeClass("selected");
        } else {
            table.rows().select();
            $("th.select-checkbox").addClass("selected");
        }
    }).on("select deselect", function () {
        if (table.rows({
                selected: true
            }).count() !== table.rows().count()) {
            $("th.select-checkbox").removeClass("selected");
//            $("tbody tr").find("input").prop("disabled", "true");
//            $("tbody tr").find("textarea").prop("disabled", "true");
//            $("tbody tr").find("input").addClass("hide-input");
//            $("tbody tr").find("textarea").addClass("hide-textarea");
        } else {
            $("th.select-checkbox").addClass("selected");
        }
    });
    
    $("#add").click(function () {
        addInput(this, "cates");
    });
    
    $("#add-branches").click(function () {
        addInput(this, "cates-branches");
    });
    
    $("#add-property").click(function () {
        addInput(this, "properties");
    });
    
    function addInput(ele, name) {
        $(ele).before('<input type="text" name=' + name + '>');
    }
    
    function implement(ele, naver) {
        $(ele).removeClass("hidden").addClass("show");
        $(naver).parent().children().removeClass("active");
        $(naver).addClass("active");
        
    }
    
    $("#first").click(function (ev) {
        ev.preventDefault();
    });
    
    function edit(self) {
        var children = $(self).parent().children();
        var cell_0 = children[1];
        var children_cell_0 = $(cell_0).children();
        var child_0 = $(children_cell_0)[0];
        var child_1 = $(children_cell_0)[1];
        var cell_1 = children[2];
        var cell_2 = children[3];
        var cell_3 = children[4];
        var cell_4 = children[5];
        var cell_5 = children[6];
        if ($(cell_0).children().is("input")) {
            $(cell_0).children().attr("disabled", false);
            $(cell_1).children().attr("disabled", false);
            $(cell_2).children().attr("disabled", false);
            $(cell_3).children().attr("disabled", false);
            $(cell_4).children().attr("disabled", false);
            $(cell_5).children().attr("disabled", false);
            $("#apply").removeClass("hidden");
        }
    }
    
    function apply() {
        var inputs = $("tr").find("input");
        var areas = $("tr").find("textarea");
        
        inputs.each(function(index) {
            if(!$(inputs[index]).prop("disabled") && $(inputs[index]).is("[type=text]")) {
               setTimeout(function() {
                    $(inputs[index]).attr("disabled", true);
               }, 1000);
                console.log($(inputs[index]).val());
            }
           
        });
        
        areas.each(function(index) {
           if(!$(areas[index]).prop("disabled")) {
                setTimeout(function() {
                    $(areas[index]).attr("disabled", true);
               }, 1000);
            };
        });
        $("#action-list option:first").prop("selected", true);
    }
    
    function deleteSelected(self) {
        
        table.row(self.parent()).remove();
    }
    
    
    $("#action-list").change(function() {
        var selected = $(this).find("option:selected");
        var value = $(selected).attr("value");
        var checked = $(".selected").find(".select-checkbox");
        
        if(value == "1") {
           checked.each(function(index) {
               edit(this);
               $(".selected").find(".hide-input").removeClass("hide-input");
               $(".selected").find(".hide-textarea").removeClass("hide-textarea");
           });
        } 
        else if(value == "2") {
            deleteSelected(checked);
            table.rows(".selected").remove().draw();
        }
        
    });
    
    
    $(".select-checkbox").click(function() {
        const x = $(this).parents();
        const y = x[1];
        const flag = $(y).is("thead");
        if(!flag) {
            $(this).parent().toggleClass(" selected");
            $("#action-list option:first").prop("selected", true);
            var children = $(this).parent().children();
            var cell_0 = children[1];
            var cell_1 = children[2];
            var dataCell_0 = $(cell_0).children().val();
            var dataCell_1 = $(cell_1).children().val();

            if(!$(cell_0).children().is("input")) {
                $(cell_0).replaceWith('<td class="sorting_1">' + dataCell_0 + '</td>');
                $(cell_1).replaceWith('<td class="sorting_1">' + dataCell_1 + '</td>');
            } else {
                $(this).parent().find("input").prop("disabled", "true");
                $(this).parent().find("input").addClass("hide-input");
                $(this).parent().find("textarea").prop("disabled", "true");
                $(this).parent().find("textarea").addClass("hide-textarea");
            }
        }
        
    });
    
    $("#save").click(function(ev) {
       ev.preventDefault(); //*******This Prevent Default Action of Button (حفظ)*******
        var self = $(this);
        var kind = $("#select-cates").find(":selected");
        var classVal = kind.attr("class");
        var add = $("#add-cates").val().trim();
        var regex = /[\d]/g;
        var count = "";
        if(add && classVal == "none" ) {
            $("#select-cates").append('<option class="level-0" value="">' + add + '</option>');
        } else if(add) {
            count = classVal.match(regex)[0];
            count = parseInt(count);
            kind.after('<option class="level-' + (++count) + '">' + ("&nbsp;".repeat(count*3)) + add + '</option>');
        }
    });
    
    
    
});