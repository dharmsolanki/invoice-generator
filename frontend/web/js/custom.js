$("#amount").prop("readonly", true);
$(document).ready(function(){
    // Function to calculate and update the total price
    function updateTotalPrice() {
        var totalPrice = 0;
        $('.price').each(function() {
            var price = parseFloat($(this).val());
            if (!isNaN(price)) {
                totalPrice += price;
            }
        });
        $("#amount").val(totalPrice.toFixed(2));
    }    

    // Update the total price when a price is changed
    $(document).on('change', '.price', function() {
        updateTotalPrice();
    });

    $('#add-product-button').click(function(){
        // Create input fields for product name and price
        var productNameInput = '<input type="text" class="form-control product-name" name="Product[name][]" placeholder="Product Name">';
        var priceInput = '<input type="number" step="0.01" class="form-control price" name="Product[price][]" placeholder="Price">';

        // Wrap the input fields in a div with Bootstrap grid classes
        var productFields = '<div class="col-md-6">' + productNameInput + '</div><div class="col-md-6">' + priceInput + '</div>';

        // Append the input fields to the product-fields-container
        $('#product-fields-container').append(productFields);

        // Log a message to the console when the price input field changes
        $('.price').on('change', function() {
            updateTotalPrice();
        });
    });
});
