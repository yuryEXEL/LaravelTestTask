$(document).ready(function () {
    $('#createUserButton').click(function () {
        $('#createUserForm').toggle();
        $('#deleteUserForm, #updateUserForm').hide();
        clearErrorMessages();
    });

    $('#deleteUserButton').click(function () {
        $('#deleteUserForm').toggle();
        $('#createUserForm, #updateUserForm').hide();
        clearErrorMessages();
    });

    $('#updateUserButton').click(function () {
        $('#updateUserForm').toggle();
        $('#createUserForm, #deleteUserForm').hide();
        clearErrorMessages();
    });

    clickButtonOnCreateUser();
    clickButtonOnUpdateUser();
    clickButtonOnDeleteUser();
});

/**
 * Event click button on create user and send query
 */
function clickButtonOnCreateUser() {
    $('#userCreateForm').on('submit', function (e) {
        e.preventDefault();
        clearErrorMessages();

        var formData = new FormData(this);

        $.ajax({
            url: '/usersManager/createUser',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                this.addSuccessMessages(response);
                this.clearForm('#userCreateForm :input[type="text"]');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                addErrorMessages(jqXHR);
            }
        });
    });
}

/**
 * Event click button on update user and send query
 */
function clickButtonOnUpdateUser() {
    $('#userUpdateForm').on('submit', function (e) {
        e.preventDefault();
        clearErrorMessages();

        var formData = new FormData(this);

        $.ajax({
            url: '/usersManager/updateUser',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                this.addSuccessMessages(response);
                this.clearForm('#userUpdateForm :input[type="text"]')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                addErrorMessages(jqXHR);
            }
        });
    });
}

/**
 * Event submit on delete user and send query
 */
function clickButtonOnDeleteUser() {
    $('#userDeleteForm').on('submit', function (e) {
        e.preventDefault();
        clearErrorMessages();

        var formData = new FormData(this);

        $.ajax({
            url: '/usersManager/deleteUser',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                this.addSuccessMessages(response);
                this.clearForm('#userDeleteForm :input[type="text"]')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                addErrorMessages(jqXHR);
            }
        });
    });
}

/**
 * Add success messages
 */
function addSuccessMessages(response) {
    $('#successMessages').empty().append('<p>' + response + '</p>');
}

/**
 * Clear all input in form
 */
function clearForm(selectorForm) {
    $(selectorForm).each(function () {
        $(this).val('');
    });
}

/**
 * Clear error messages field
 */
function clearErrorMessages(){
    $('#errorMessage').empty();
}

/**
 * Add error messages to field
 */
function addErrorMessages(jqXHR) {
    var errors = JSON.parse(jqXHR.responseText);
    $.each(errors, function (key, value) {
        if (typeof value === 'string') {
            $('#errorMessage').append(key + ": " + value + "<br>");
        } else if (typeof value === 'object') {
            $.each(value, function (subKey, subValue) {
                $('#errorMessage').append(key + " -> " + subKey + ": " + subValue + "<br>");
            });
        }
    });
}
