/**
 * Created by vitaliy on 25.11.15.
 */
jQuery(document).ready(function($){
    $('#sub-cat').hide();
    $('#parent_id').change(function(){
        $.get("/api/dropdown",
            { option: $(this).val() },
            function(data) {
                if (data != '') {
                    var cat_id = $('#cat_id');
                    cat_id.empty();
                    $.each(data, function (index, element) {
                        cat_id.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        $('#sub-cat').show();

                    });
                }else {
                    $('#sub-cat').hide();
                }
          });
    });
    $('#new-category').hide();
    $('#new_discount').hide();
    $('#cat-open-edit').click(function() {
        $('#new-category').show();
        $('#old-category').hide();
        $('#cat-open-edit').hide();
    });
    $('#discount-open-edit').click(function() {
        $('#new_discount').show();
        $('#discount-open-edit').hide();
        $('#old_discounts').hide();
    });

});
