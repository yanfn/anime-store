$(function() {
    $('#myForm').on('submit', function(e) {
        e.preventDefault(); // prevent form from submitting normally

        var formData = $(this).serialize(); // get the form data
        var url = 'api/customer/register.php'; // replace with your URL

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(data) {
            alert('Form submitted successfully!');
                window.location = "login.html";
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });
});