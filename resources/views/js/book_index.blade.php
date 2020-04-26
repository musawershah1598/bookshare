<script>
    // $(document).ready(function() {
//     var recommended = $(".recommended");
//     var bestselling = $(".bestselling");

//     recommended.on("click", function() {
//         if ($(this).prop("checked") == true) {
//             handleRecommended(1);
//         } else {
//             handleRecommended(0);
//         }
//     });
//     bestselling.on("click", function() {
//         if ($(this).prop("checked") == true) {
//             handleBestSelling(1);
//         } else {
//             handleBestSelling(0);
//         }
//     });
// });

function handleRecommended(book_id) {
    var url = '{{route("book.handle.recommended")}}';
    var value = $("#recommended"+book_id);
    var val;
    if(value.prop('checked') == true){
        val = 1;
    }else{
        val = 0;
    }
    $.ajax({
        url: url,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            val: val,
            book_id: book_id
        },
        success: function(data){
            if(data.working == 1){
                toastr.success('Added to Recommended Books',"Success",{
                    timeOut: 2000,
                    positionClass: 'toast-bottom-center'
                });
            }else{
                toastr.warning('Removed from Recommended Books',"Warning",{
                    timeOut: 2000,
                    positionClass: "toast-bottom-center"
                });
            }
        },
        error: function(error){
            toastr.error("An error occurred",'Danger',{
                timeOut: 2000,
                positionClass: 'toast-bottom-center'
            })
        }
    });
}

function handleBestSelling(book_id) {
    var value = $("#bestselling"+book_id);
    var val;
    if(value.prop('checked') == true){
        val = 1;
    }else{
        val = 0
    }
    $.ajax({
        url: "{{route('book.handle.bestselling')}}",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            val: val,
            book_id: book_id
        },
        success: function(data){
            if(data.working == 1){
                toastr.success('Added to Best Selling Books',"Success",{
                    timeOut: 2000,
                    positionClass: 'toast-bottom-center'
                });
            }else{
                toastr.warning('Removed from Best Selling Books',"Warning",{
                    timeOut: 2000,
                    positionClass: "toast-bottom-center"
                });
            }
        },
        error: function(error){
            toastr.error("An error occurred",'Danger',{
                timeOut: 2000,
                positionClass: 'toast-bottom-center'
            })
        }
    });
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

</script>