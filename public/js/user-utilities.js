function getSubCategoriesByCategory(obj) {
    var category = $("#" + obj.id).val();
    if (category === "none") return;
    $("#sub_category").html("<option value='none'>Please Wait ....</option>");
    $.ajax({
        datatype: "json",
        type: 'get',
        data: {
            category: category
        },
        url: $("#baseUrl").val() + '/categories/subcategories/category',
        success: function (response) {
            var res = JSON.parse(response);
            $("#sub_category").html(res.data);
            $(".subCategory").html(res.data);
            $("#sub_category option:first").html("Select Shop Sub Category");
            $(".subCategory option:first").html("Select Shop Sub Category");
            $("#sub_category option:first").val("none");
            $(".subCategory option:first").val("none");
        },
        error: function () {
            console.log("Eror getting response");
        }
    });
}

function getCityByTown(obj) {
    var townId=  $("#" + obj.id).val();
    $.ajax({
        method: "get",
        url: $("#baseUrl").val() + '/street/town',
        data: {townId: townId},
        success: function (response) {
            console.log("response: ", response);
            $("#street").empty();
            $("#street").append(response);
            $(".street").append(response);
            $(".street option:first").html("Filter By Street");
            $(".street option:first").val("none");
        },
        error: function (error) {
            $("#street").fadeOut(500);
        }
    });
}

function getTownsByRegion(obj) {
    var region = $("#" + obj.id).val();
    if (region === "none") return;
    $("#town").html("<option value='none'>Loading Towns, Please Wait ....</option>");
    $.ajax({
        datatype: "json",
        type: 'get',
        data: {
            region: region
        },
        url: $("#baseUrl").val() + '/region/town',
        success: function (response) {
            var res = JSON.parse(response);
            $("#town").html(res.data);
            $(".town").html(res.data);
            $("#town option:first").html("Filter By Town");
            $(".town option:first").html("Filter By Town");
            $("#town option:first").val("none");
            $(".town option:first").val("none");
        },
        error: function () {
            console.log("Eror getting response");
        }
    });
}

function showCustomSearchModal(obj){
    console.log(obj.class);
   $("#customSearchModal").modal('show');
}
