$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});
// Supplier CRUD
$(document).ready(function () {
    // add function
    $(document).on("click", ".supplierBtn", function (e) {
        e.preventDefault();

        let name = $("#name").val();
        let mobile_no = $("#mobile").val();
        let email = $("#email").val();
        let address = $("#address").val();

        $.ajax({
            url: "store",
            type: "POST",
            data: {
                name: name,
                mobile_no: mobile_no,
                email: email,
                address: address,
            },
            success: function (res) {
                if (res.status == "success") {
                    $("#supplierModal").modal("hide");
                    $("#supplierFrom")[0].reset();
                    $(".table").load(location.href + " .table");
                    Command: toastr["success"](
                        "Supplier data successfully added"
                    );

                    toastr.options = {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: false,
                        positionClass: "toast-top-right",
                        preventDuplicates: false,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "5000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                    };
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, val) {
                    $(".errorMsg").append(
                        '<span class="text-danger">' + val + "</span>" + "<br>"
                    );
                });
            },
        });
    });

    //Edit function
    $(document).on("click", ".supEditBtn", function (e) {
        e.preventDefault();

        var id = $(this).data("id");
        $("#editModal").modal("show");
        //console.log(id);

        $.ajax({
            url: "edit",
            type: "GET",
            dataType: "json",
            data: { id: id },
            success: function (res) {
                console.log(res.data);
                $('input[name="updateId"]').val(res.data.id);
                $('input[name="updatename"]').val(res.data.name);
                $('input[name="updatemobile_no"]').val(res.data.mobile_no);
                $('input[name="updateemail"]').val(res.data.email);
                $('textarea[name="updateaddress"]').val(res.data.address);
                $('select[name="updateStatus"]').val(res.data.status);

                if (res.data.status == 1) {
                    //1 means published
                    $("#upStatus").find(":selected").val(res.data.status);
                } else {
                    $("#upStatus").find(":selected").val(res.data.status);
                }
            },
        });
    });

    // Update function

    $("#supEditFrom").on("submit", function (e) {
        e.preventDefault();
        var data = $(".updateFrom").serialize();
        console.log(data);
        $.ajax({
            url: "update",
            method: "POST",
            data: data,
            success: function (data) {
                if (data.status == "success") {
                    $("#editModal").modal("hide");
                    $("#supEditFrom")[0].reset();
                    $(".table").load(location.href + " .table");
                    Command: toastr["success"](
                        "Supplier data successfully updated"
                    );

                    toastr.options = {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: false,
                        positionClass: "toast-top-right",
                        preventDuplicates: false,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "5000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                    };
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, val) {
                    $(".errorMsg").append(
                        '<span class="text-danger">' + val + "</span>" + "<br>"
                    );
                });
            },
        });
    });

    //Delete request

    $(document).on("click", ".supDelBtn", function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        if (confirm("Are you sure you want to delete this data?")) {
            $.ajax({
                url: "delete",
                type: "GET",
                dataType: "json",
                data: { id: id },
                success: function (res) {
                    if (res.status == "success") {
                        $(".table").load(location.href + " .table");
                        Command: toastr["warning"](
                            "Supplier data successfully deleted"
                        );

                        toastr.options = {
                            closeButton: false,
                            debug: false,
                            newestOnTop: false,
                            progressBar: false,
                            positionClass: "toast-top-right",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: "300",
                            hideDuration: "1000",
                            timeOut: "5000",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                        };
                    }
                },
            });
        }
    });
});

// sum invoice

$(document).ready(function () {
    $(document).on("click", ".addeventmore", function () {
        var date = $("#date").val();
        var purchase_no = $("#purchase_no").val();
        var brand_id = $("#brand_id").val();
        var brand_name = $("#brand_id").find("option:selected").text();
        var supplier_id = $("#supplier_id").val();
        var category_id = $("#category_id").val();
        var category_name = $("#category_id").find("option:selected").text();
        var product_id = $("#product_id").val();
        var product_name = $("#product_id").find("option:selected").text();

        if (date == "") {
            $.notify("Date is required", {
                globalPosition: "top right",
                className: "error",
            });
            return false;
        }
        if (purchase_no == "") {
            $.notify("Purchase no is required", {
                globalPosition: "top right",
                className: "error",
            });
            return false;
        }
        if (brand_id == "") {
            $.notify("Brand id is required", {
                globalPosition: "top right",
                className: "error",
            });
            return false;
        }
        if (supplier_id == "") {
            $.notify("Supplier Id is required", {
                globalPosition: "top right",
                className: "error",
            });
            return false;
        }
        if (category_id == "") {
            $.notify("Category Id is required", {
                globalPosition: "top right",
                className: "error",
            });
            return false;
        }
        if (product_id == "") {
            $.notify("Product Id is required", {
                globalPosition: "top right",
                className: "error",
            });
            return false;
        }
        var source = document.getElementById("document-template").innerHTML;
        var template = Handlebars.compile(source);
        var data = {
            date: date,
            purchase_no: purchase_no,
            supplier_id: supplier_id,
            brand_id: brand_id,
            brand_name: brand_name,
            category_id: category_id,
            category_name: category_name,
            product_id: product_id,
            product_name: product_name,
        };
        var html = template(data);
        $("#addRow").append(html);
    });

    $(document).on("click", ".removeeventmore", function (event) {
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
    });

    $(document).on("keyup click", ".unit_price,.buying_qty", function () {
        var unit_price = $(this).closest("tr").find("input.unit_price").val();
        var qty = $(this).closest("tr").find("input.buying_qty").val();
        var total = unit_price * qty;
        $(this).closest("tr").find("input.buying_price").val(total);
        totalAmountPrice();
    });

    //calculate sum of amount in invoice
    function totalAmountPrice() {
        var sum = 0;
        $(".buying_price").each(function () {
            var value = $(this).val();

            if (!isNaN(value) && value.lenght != 0) {
                sum += parseFloat(value);
            }
        });
        $("#estimated_amount").val(sum.toFixed(2));
    }
});

$(document).ready(function () {
    $("#brandFrom").submit(function (e) {
        e.preventDefault();
        var formData = $("#brandFrom").serialize();
        //console.log(formData);
         $.ajax({
            url: 'store',
            type: "post",

            data: formData,

           success: function (data) {
             if(data.status == 'success'){
               $('#brandFrom')[0].reset();
                $('.table').load(location.herf+' .table');
                Command: toastr["success"](
                    "Brand name successfully added"
                );

                toastr.options = {
                    closeButton: false,
                    debug: false,
                    newestOnTop: false,
                    progressBar: false,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                };
            }

           },
           error:function(err){
            let error = err.responseJSON;
            $.each(error.errors, function (key, value){
                alert(key + ': ' + value);
            });
           }
        });
    });
});
