

$(document).ready(function() {
    
    $("#customFilter").select2(); 

    $(".tweet-favorite").on("click", function(e) {
        e.preventDefault();
        console.log(this.dataset.id);
        $.LoadingOverlay("show");
        // console.log(this.parent);
        var el = this;
        $.ajax({
            url: 'index.php?module=Social&action=Favorite&mode=favorite&id='+this.dataset.id,
            type: 'GET',
            success: function(result, status, xhr) {
                console.log(result);
                $.LoadingOverlay("hide");
                if(typeof(result.result.errors) !== 'undefined') {
                    result.result.errors.forEach(element => {
                        showSuccess(element.message);
                    });
                } else if(result.result.favorited == false) {
                    showSuccess("Tweet has been unfavorited.");
                    el.parentNode.parentNode.lastElementChild.textContent = "-";
                } else {
                    showSuccess("Tweet has been favorited.");
                    el.parentNode.parentNode.lastElementChild.textContent = "Yes";
                }
                // location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error, status);
                $.LoadingOverlay("hide");
                showError();   
            } 
        });
    });
});

function showError() {
    Vtiger_Helper_Js.showMessage({
        type: "error",
        text: "Tweet failed"
    });
}

function showSuccess(message) {
    Vtiger_Helper_Js.showMessage({
        type: "info",
        text: message
    });
}