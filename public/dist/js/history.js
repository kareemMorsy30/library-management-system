/*jslint plusplus: true, evil: true */
/*global console, alert, prompt, confirm, $, jQuery */

$(function () {
    "use strict";
    var table = $('#vHistoryTable').DataTable({
        select: {
            style: "multi+shift",
            selector: "td:first-child"
        },
        language: {
            select: {
                rows: {
                    '_': "%d Products Selected",
                    1: "1 Product Selected",
                    0: ""
                }
            },
            lengthMenu: "Show _MENU_ Products",
            info: "Showing _START_ to _END_ of _TOTAL_ Products"
        },
        columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: false,
            className: "select-checkbox"
        },
            {
                targets: 1,
                width: "12px"
            },
            {
                targets: 4,
                orderable: false,
                width: "12px"
            },
            {
                targets: [2, 5],
                orderable: false,
                width: "8%"
            },
            {
                targets: [3, 7, 8],
                orderable: false
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
        } else {
            $("th.select-checkbox").addClass("selected");
        }
    });
    
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
            $(child_0).attr("disabled", false);
            $(cell_1).children().attr("disabled", false);
            $(cell_2).children().attr("disabled", false);
            $(cell_3).children().attr("disabled", false);
            $(cell_4).children().attr("disabled", false);
            $(cell_5).children().attr("disabled", false);
        }
    }
    
    function deleteSelected(self) {
        
        table.row(self.parent()).remove();
    }
    
    
    $("#action-list").change(function() {
        var selected = $(this).find("option:selected");
        var value = $(selected).attr("value");
        var checked = $(".selected").find(".select-checkbox");
        
//        if(value == "1") {
//           checked.each(function(index) {
//               edit(this);
//               $(".selected").find(".hide-input").removeClass("hide-input");
//               $(".selected").find(".hide-textarea").removeClass("hide-textarea");
//           });
//        } 
//        else if(value == "2") {
//            deleteSelected(checked);
//            table.rows(".selected").remove().draw();
//        }
        if (value == "1") {
            $(".selected").find(".status").attr("value", "Approved");
            $(".selected").find(".status").parent('td').attr('data-search', 'Approved');
            $(".selected").find(".status").parent('td').attr("data-order", "Approved");
            $("#apply").removeClass("hidden");
        } else if (value == "2") {
            $(".selected").find(".status").attr("value", "Preparing Order");
            $(".selected").find(".status").parent('td').attr('data-search', 'Preparing Order');
            $(".selected").find(".status").parent('td').attr("data-order", "Preparing Order");
            $("#apply").removeClass("hidden");
        } else if (value == "3") {
            $(".selected").find(".status").attr("value", "Out for delivery");
            $(".selected").find(".status").parent('td').attr('data-search', 'Out for delivery');
            $(".selected").find(".status").parent('td').attr("data-order", "Out for delivery");
            $("#apply").removeClass("hidden");
        } else if(value == "4") {
            $(".selected").find(".status").attr("value", "Delivered");
            $(".selected").find(".status").parent('td').attr('data-search', 'Delivered');
            $(".selected").find(".status").parent('td').attr("data-order", "Delivered");
            $("#apply").removeClass("hidden");
        }
        table.rows(".selected").invalidate().draw();
        
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
            table.rows(".selected").invalidate().draw();
        }
        
    });
    
});