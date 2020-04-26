$(document).ready(function() {
    var recommended = $("#recommended");
    var bestselling = $("#bestselling");

    recommended.on("click", function() {
        if ($(this).prop("checked") == true) {
            handleRecommended(1);
        } else {
            handleRecommended(0);
        }
    });
    bestselling.on("click", function() {
        if ($(this).prop("checked") == true) {
            handleBestSelling(1);
        } else {
            handleBestSelling(0);
        }
    });
});

function handleRecommended(val) {
    var url = '{{route("book.handle.recommended")}}';
    console.log(url);
}

function handleBestSelling(val) {
    console.log(val);
}

$("#search").on("keyup", function(e) {
    if (e.which == 13) {
        formSubmit(e);
    } else {
        var input = $(this).val();
        if (input == "") {
            $("#default-table").css("display", "block");
            $("#search-table").css("display", "none");
        }
    }
});
function formSubmit(event) {
    event.preventDefault();
    var input = $("#search").val();
    $("#spinner").css("display", "block");
    $.ajax({
        url: "{{route('book.search')}}",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: { search: input },
        success: function(val) {
            console.log(val);
            $("#search-table").css("display", "block");
            $("#default-table").css("display", "none");
            $("#spinner").css("display", "none");
            $("#search-table tbody").html(val);
        },
        error: function(error) {
            console.log(error);
            if (error.status == 404) {
                $("#not-found").css("display", "block");
                $("#spinner").css("display", "none");
                setTimeout(() => {
                    $("#not-found").css("display", "none");
                }, 4000);
            }
        }
    });
}
