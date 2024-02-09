$(document).ready(function () {
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML = `
        <div class="meta-menu row form-inline my-2">
            <div class="form-group">
                <input name="key[]" class="mx-2 form-control" placeholder="Menu Key">
            </div>
            <div class="form-group">
                <input name="title[]" class="mx-2 form-control" placeholder="Menu Title">
            </div>
            <div class="form-group">
                <input name="url[]" class="mx-2 form-control" placeholder="Menu URL">
            </div>
            <div class="form-group">
                <input name="parent[]" class="mx-2 form-control" placeholder="Menu Parent">
            </div>
            <div class="form-group">
                <input name="image[]" class="mx-2 form-control" placeholder="Menu Image">
            </div>
            <div class="form-group">
                <a class="remove_button" title="Remove Field">
                    <i class="fas fa-minus-circle"></i>
                </a>
            </div>
        </div>
    `;
    //Once add button is clicked
    $(addButton).click(function () {
        $(wrapper).append(fieldHTML);
    });

    //Once remove button is clicked
    $(document).on("click", ".remove_button", function () {
        if ($(".meta-menu").length > 1)
            $(this).closest(".meta-menu").remove(); //Remove field html
        else alert("You need to have 1 menu");
    });
});
