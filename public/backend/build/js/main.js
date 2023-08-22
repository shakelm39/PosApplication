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
                    console.log(res.category);
                    $('input[name="updateId"]').val(res.category.id);
                    $('input[name="updatename"]').val(res.category.name);
                    $('input[name="updatemobile_no"]').val(res.category.mobile_no);
                    $('input[name="updateemail"]').val(res.category.email);
                    $('textarea[name="updateaddress"]').val(res.category.address);
                    $('select[name="updateStatus"]').val(res.category.status);

                    if (res.category.status == 1) {
                        //1 means published
                        $("#upStatus").find(":selected").val(res.category.status);
                    } else {
                        $("#upStatus").find(":selected").val(res.category.status);
                    }
                },
            });
        });

        // Update function

        $("#supEditFrom").on("submit", function (e) {
            e.preventDefault();
            var data = $(".updateFrom").serialize();
        
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

// Brand Add ajax request
    $(document).ready(function() {
        $('.BrandupdateFrom').hide();

        $('#add_brand').on('click', function(e){
            e.preventDefault();

            var name = $('#name').val();
            $.ajax({
                url: "store",
                type: 'POST',
                data: {
                    name: name
                },
                success: function(data){
                    if(data.status == 'success'){
                        Command: toastr["success"](
                            "Brand data successfully added"
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
                        $('#brandFrom')[0].reset();
                        $('.table').load(location.href+' .table');

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

    // edit ajax request

        $(document).on('click','.brandEditBtn',function(e){
            e.preventDefault();
            $('.BrandAddFrom').hide();
            $('.BrandupdateFrom').show();
            var brandUpId = $(this).data('id');
            
            $.ajax({
                url:'edit',
                type:'get',
                data:{brandUpId:brandUpId},
                success: function(response){
                    if(response){
                        $('#brand_update_id').val(response.data.id);
                        $('#update_name').val(response.data.name);
                        $('#update_name').val(response.data.name);
                        $('select[name="update_status"]').val(response.data.status);

                        if (response.data.status == 1) {
                            //1 means published
                            $("#update_status").find(":selected").val(response.data.status);
                        } else {
                            $("#update_status").find(":selected").val(response.data.status);
                        }
                    }
                }
            });
        })

        //Ajax Update request

            $('#update_brand').on('click',function(e){
                e.preventDefault();
            
            var brandUpDateFrom = $('#update_brand_form').serialize();

            $.ajax({
                url:'update',
                type:'post',
                data: brandUpDateFrom,
                success: function(res){
                    if(res.status=='success'){
                        Command: toastr["success"](
                            "Brand data successfully Updated!!"
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
                        $('#update_brand_form')[0].reset();
                        $('#datatable-responsive').load(location.href+' #datatable-responsive');
                        $('.BrandAddFrom').show();
                        $('.BrandupdateFrom').hide();
                    }
                }
            });

                
            });


        //delte ajax request
        $(document).on('click','.brandDelBtn', function(){
            var id = $(this).data('id');
            $.ajax({
                url:'delete',
                type: 'get',
                data:{ id:id},
                success: function(data){
                    if(data.status == 'success'){
                        Command: toastr["warning"](
                            "Brand data successfully deleted!!"
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
                        
                        $('.table').load(location.href+' .table'); 
                    }
                }
            })
        });

    });


//Category Ajax request

    $(document).ready(function(){

        $('.catupdateFrom').hide();

        //add category request
        $('#catFrom').on('submit',function(e){
            e.preventDefault();
            const caTform = $('#catFrom').serialize();

            $.ajax({
                url:'store',
                type:'POST',
                data:caTform,
                success:function(res){
                    if(res.status == 'success'){
                        Command: toastr["success"](
                            "Category data successfully Added!!"
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
                        $('#catFrom')[0].reset();
                        $('.catTbl').load(location.href+' .catTbl');

                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, val) {
                        $(".errorMsg").append(
                            '<span class="text-danger">' + val + "</span>" + "<br>"
                        );
                    });
                }
            });
        })

    //Edit Category Request

        $(document).on('click','.catEditBtn',function(e){
            e.preventDefault();
            $('.catAddFrom').hide();
            $('.catupdateFrom').show();

            const catEditId = $(this).data('id');
            //alert(catEditId);
            $.ajax({
                url: 'edit',
                type:'get',
                data:{catEditId:catEditId},
                success: function(res){
                    if(res.category){

                        $('#cat_update_id').val(res.category.id);
                        $('#update_name').val(res.category.name);
                        $('#update_status').val(res.category.status);

                        if (res.category.status == 1) {
                            //1 means published
                            $("#update_status").find(":selected").val(res.category.status);
                        } else {
                            $("#update_status").find(":selected").val(res.category.status);
                        }
                    }
                }
            });
        });

    //Update category request

        $(document).on('submit','#update_cat_form',function(e) {
            e.preventDefault();

            var catUpForm = $('#update_cat_form').serialize();

            $.ajax({
                url:'update',
                type:'POST',
                data:catUpForm,
                success: function(res) {
                    if(res.status == 'success'){
                        Command: toastr["success"](
                            "Category data successfully Updated!!"
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
                        $('.catupdateFrom').hide();
                        $('.catAddFrom').show();
                        $('#catFrom')[0].reset();
                        $('.catTbl').load(location.href+' .catTbl');
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, val) {
                        $(".errorMsg").append(
                            '<span class="text-danger">' + val + "</span>" + "<br>"
                        );
                    });
                }
            })
        });

        //delete category request

        $(document).on('click','.catDelBtn', function(e){
            e.preventDefault();
            var catDelId = $(this).data('id');
            var confirmatin = confirm("Are you sure you want to delete this?");
            if(confirmatin){
            $.ajax({
                url: 'delete',
                type: 'get',
                data: {catDelId: catDelId},
                success:function (data) {
                    if(data.status === 'success'){
                        Command: toastr["warning"](
                            "Category data successfully Deleted!!"
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
                        
                        $('.catTbl').load(location.href+' .catTbl');
                    }
                }
            });
        }
        });
    });


//__ Unit ajax request__//

    $(document).ready(function(){
        $('.unitupdateFrom').hide();

        //_unit Add Ajax Request_//
        $(document).on('submit','#unitAddFrom',function(e){
            e.preventDefault();
            var unitAddFrom = $('#unitAddFrom').serialize();

            $.ajax({
                url: 'store',
                type: 'POST',
                data: unitAddFrom,
                success: function(res){
                    if(res.status=='success'){
                        $('#unitAddFrom')[0].reset();
                        $('.unitTbl').load(location.href+' .unitTbl');
                        Command: toastr["success"](
                            "Unit data successfully added!!"
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
                },error:function (err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(i, val){
                        $('.errorMsg').append('<span class="text-danger">'+val+'</span>');
                    });
                }
            })

        })

    //__unit edit ajax request__//

        $(document).on('click','.unitEditBtn',function(e){
            e.preventDefault();
            $('.unitAddDiv').hide();
            $('.unitupdateFrom').show();
            var unitEditId = $(this).data('id');

            $.ajax({
                url: 'edit',
                type: 'get',
                data: {'id': unitEditId},
                success: function (res){
                    if(res.unit){
                        $('#unit_update_id').val(unitEditId);
                        $('#unitUpdateName').val(res.unit.name);
                        $('#unitUpdateStatus').val(res.unit.status);

                        if(res.unit.status==1){
                            $("#unitUpdateStatus").find(":selected").val(res.unit.status);
                        }else{
                            $("#unitUpdateStatus").find(":selected").val(res.unit.status);  
                        }

                    }
                }

            })
        });


    //__unit update ajax request__//

            $(document).on('submit','#update_unit_form',function(e){
                e.preventDefault();
                var unitUpdateFrom = $('#update_unit_form').serialize();
                $.ajax({
                    url: 'update',
                    type: 'POST',
                    data: unitUpdateFrom,
                    success: function (res){
                        if(res.status=='success'){
                            $('.unitupdateFrom').hide();
                            $('#update_unit_form')[0].reset();
                            $('.unitTbl').load(location.href+' .unitTbl');
                            Command: toastr["success"](
                                "Unit data successfully updated!!"
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
                    }

                })
            });


    //__unit delete ajax request__//

            $(document).on('click','.unitDelBtn',function(){

                var unitDelId = $(this).data('id');
                
                $.ajax({
                    url: 'delete',
                    type:'get',
                    data: {'id': unitDelId},
                    success: function(res){
                        if(res.status=='success'){
                            $('.unitTbl').load(location.href+' .unitTbl');
                            Command: toastr["warning"](
                                "Unit data successfully deleted!!"
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
                    }
                });
            });

    });


    //__ User ajax request__//

    $(document).ready(function(){

        //__ User  add ajax request__//

        $(document).on('submit','#userAddForm',function(e){
            e.preventDefault();

            var userForm = $('#userAddForm').serialize();

            $.ajax({
                url: 'store',
                type: 'POST',
                data: userForm,
                success: function(res){
                    if(res.status=='success'){
                        $('#userAddForm')[0].reset();
                        $('#userModal').modal('hide');
                        $('.userTbl').load(location.href+' .userTbl');
                        Command: toastr["success"](
                            "User successfully added!!"
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
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function(i,e){
                        $('.errorMsg').append('<span class="text-danger">'+e+'</span>'+'<br>');
                    });
                }
            });
        });


        //Edit user Request

        $(document).on('click','.userEditBtn',function(e){
            e.preventDefault();
            $('#updateUserModal').modal('show');
            

            const useEditId = $(this).data('id');
            

            $.ajax({
                url: 'edit',
                type:'get',
                data:{'id':useEditId},
                success: function(res){
                    if(res.user){

                        $('#userUpId').val(useEditId);
                        $('#upname').val(res.user.name);
                        $('#upemail').val(res.user.email);
                        $('#upusertype').val(res.user.usertype);
                        $('#upstatus').val(res.user.status);

                        if (res.user.status == 1) {
                            //1 means published
                            $("#upstatus").find(":selected").val(res.user.status);
                        } else {
                            $("#upstatus").find(":selected").val(res.user.status);
                        }
                        if (res.user.usertype == 1) {
                            //1 means published
                            $("#upusertype").find(":selected").val(res.user.usertype);
                        } else {
                            $("#upusertype").find(":selected").val(res.user.usertype);
                        }
                        
                    }
                }
            });
        });

        //Update user Request
        $(document).on('submit','#userUpForm',function(e) {
            e.preventDefault();

            var userUpForm = $('#userUpForm').serialize();

            $.ajax({
                url:'update',
                type:'POST',
                data:userUpForm,
                success: function(res) {
                if(res.status == 'success'){
                    Command: toastr["success"](
                        "User data successfully Updated!!"
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
                    $('#updateUserModal').modal('hide');
                    $('#userUpForm')[0].reset();
                    $('.userTbl').load(location.href+' .userTbl');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, val) {
                    $(".errorMsg").append(
                        '<span class="text-danger">' + val + "</span>" + "<br>"
                    );
                });
            }
         })
        });

        //__user delete request__//

        $(document).on('click','.userDelBtn',function(){

            var userDelId = $(this).data('id');
            var delConf = confirm('Are you sure you want to delete?');
            if(delConf){
                $.ajax({
                    url: 'delete',
                    type:'get',
                    data: {'id': userDelId},
                    success: function(res){
                        if(res.status=='success'){
                            $('.userTbl').load(location.href+' .userTbl');
                            Command: toastr["warning"](
                                "User data successfully deleted!!"
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
                    }
                });
            }
        });



});