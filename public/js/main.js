$(document).ready(function () {
    clickOnRowUserInTable();
    clickButtonOnSaveUser();
    clickOnButtonUploadForm();
});

/**
 * Event click button on update user and send query
 */
function clickOnRowUserInTable() {
    $('.user-row').click(function () {
        var username = $(this).find('td:eq(1)').attr('data-value'),
            userId = $(this).attr('data-id');

        $('#userId').val(userId)
        $('#newUsername').val(username);
        $('#editUserModal').modal('show');
    });
}

/**
 * Event click button on update user and send query
 */
function clickButtonOnSaveUser() {
    $('#saveUser').click(function (e) {
        e.preventDefault();
        clearErrorMessages();

        var newUsername = $('#newUsername').val();
        var userId = $('#userId').val();
        addSpinnerToButton('.btn-save-user-submit');

        $.ajax({
            url: "/users/update/",
            type: 'PUT',
            data: {
                userId: userId,
                username: newUsername
            },
            success: function (response) {
                $('#username_' + userId).text(newUsername).attr('data-value', newUsername);
                removeSpinnerToButton('.btn-save-user-submit');
                $('#editUserModal').modal('hide');
                clickOnRowUserInTable();
            },
            error: function (xhr, status, error) {
                $('#editUserModal').modal('hide');
                var errorMessage = xhr.responseText;
                $('#errorMessage').html("Error: " + errorMessage);
            }
        });
    });
}

/**
 * Event click button on upload file and send query
 */
function clickOnButtonUploadForm() {
    $('#uploadForm').on('submit', function (e) {
        e.preventDefault();
        clearErrorMessages();
        addSpinnerToButton('.btn-upload-submit');

        var formData = new FormData(this);

        $.ajax({
            url: 'users/import',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.length > 0) {
                    $('#userBody').html(response);
                    $('#upload_file').val('');
                    removeSpinnerToButton('.btn-upload-submit');
                    clickOnRowUserInTable();
                    clickButtonOnSaveUser();
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseText;
                $('#errorMessage').html('Error: ' + errorMessage);
            }
        });
    });
}

/**
 * Add spinner to button
 */
function addSpinnerToButton(selector) {
    $(selector).prepend('<i class="fa fa-spinner fa-spin"></i>').attr('disabled', 'disabled');
}

/**
 * Clear spinner
 */
function removeSpinnerToButton(selector) {
    $(selector).removeAttr('disabled').find('.fa-spinner').remove();
}

/**
 * Clear error messages field
 */
function clearErrorMessages(){
    $("#errorMessage").empty();
}
