    var path_prod = $("#route_product").attr('val');
    var path_prod2 = $("#route_product_for_quotation").attr('val');
    var path_supplierName = $("#routeSupplierName").attr('val');
    var path_userName = $("#routeUserName").attr('val');

    $('input.product').typeahead({
        source:  function (query, process) {
            return $.get(path_prod, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    $('input.productquotation').typeahead({
        source:  function (query, process) {
            return $.get(path_prod2, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    $('input.suppliername').typeahead({
        source:  function (query, process) {
            return $.get(path_supplierName, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    $('input.username').typeahead({
        source:  function (query, process) {
            return $.get(path_userName, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    $(document).ready(function () {
        $('.btnPrint').printPage();
    });

    $(document).ready(function () {
        $("#addrow").click(function () {
            var html = "<tr>\n" +
                "                                <td></td>\n" +
                "                                <td><textarea name=\"product[]\" class=\"form-control\"></textarea></td>\n" +
                "                                <td><input type=\"number\" name=\"quantity[]\" value=\"\" class=\"form-control\"></td>\n" +
                "                                <td><input type=\"text\" name=\"unit[]\" value=\"\" class=\"form-control\"></td>\n" +
                "                                <td><input type=\"number\" name=\"amount[]\" value=\"\" class=\"form-control\"></td>\n" +
                "                                <td></td>\n" +
                "                            </tr>";
            $('.billtable tr:last').after(html);
        });
    });
