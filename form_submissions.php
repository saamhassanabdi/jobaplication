<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Application System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow mb-5">

                <div class="card-header bg-primary text-white text-center">
                    <h2>Job Application Form</h2>
                </div>

                <div class="card-body">

                    <div id="message"></div>
                    <div id="result"></div>

                    <form id="jobForm" method="POST" novalidate>

                        <fieldset>

                            <legend class="text-primary mb-3">
                                Personal Information
                            </legend>

                            <!-- Fullname -->
                            <div class="mb-3">

                                <label for="fullname" class="form-label">
                                    Fullname *
                                </label>

                                <input type="text" class="form-control"
                                       id="fullname" name="fullname"
                                       placeholder="Enter your fullname">

                                <div class="text-danger small" id="fullnameError"></div>

                            </div>

                            <!-- Email -->
                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Email *
                                </label>

                                <input type="email" class="form-control"
                                       id="email" name="email"
                                       placeholder="Enter your email">

                                <div class="text-danger small" id="emailError"></div>

                            </div>

                            <!-- Place of Birth -->
                            <div class="mb-3">

                                <label for="pob" class="form-label">
                                    Place of Birth *
                                </label>

                                <input type="text" class="form-control"
                                       id="pob" name="pob"
                                       placeholder="Enter your place of birth">

                                <div class="text-danger small" id="pobError"></div>

                            </div>

                            <!-- Gender -->
                            <div class="mb-3">

                                <label class="form-label d-block">
                                    Gender *
                                </label>

                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input"
                                           id="male" name="gender" value="male">

                                    <label for="male" class="form-check-label">
                                        Male
                                    </label>

                                </div>

                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input"
                                           id="female" name="gender" value="female">

                                    <label for="female" class="form-check-label">
                                        Female
                                    </label>

                                </div>

                                <div class="text-danger small" id="genderError"></div>

                            </div>

                            <!-- Education -->
                            <div class="mb-3">

                                <label for="education_level" class="form-label">
                                    Education Level *
                                </label>

                                <select class="form-select"
                                        id="education_level"
                                        name="education_level">

                                    <option value="">Select Education</option>
                                    <option value="highschool">High School</option>
                                    <option value="bachelor">Bachelor's Degree</option>
                                    <option value="master">Master's Degree</option>

                                </select>

                                <div class="text-danger small" id="educationError"></div>

                            </div>

                            <!-- Skills -->
                            <div class="mb-3">

                                <label class="form-label d-block">
                                    Skills (Select at least 2) *
                                </label>

                                <?php

                                $skillsList = ["PHP", "HTML", "CSS", "JavaScript"];

                                foreach ($skillsList as $skill) {

                                ?>

                                    <div class="form-check form-check-inline">

                                        <input type="checkbox"
                                               class="form-check-input"
                                               name="skills[]"
                                               id="<?php echo strtolower($skill); ?>"
                                               value="<?php echo htmlspecialchars($skill); ?>">

                                        <label class="form-check-label"
                                               for="<?php echo strtolower($skill); ?>">

                                            <?php echo htmlspecialchars($skill); ?>

                                        </label>

                                    </div>

                                <?php } ?>

                                <div class="text-danger small" id="skillsError"></div>

                                <div class="small text-muted" id="skillsCount">
                                    0 skills selected
                                </div>

                            </div>

                            <!-- Experience -->
                            <div class="mb-3">

                                <label for="experience" class="form-label">
                                    Years of Experience *
                                </label>

                                <input type="number" class="form-control"
                                       id="experience" name="experience"
                                       min="1" step="1"
                                       placeholder="Minimum 1 year">

                                <div class="text-danger small" id="experienceError"></div>

                            </div>

                            <!-- Cover Letter -->
                            <div class="mb-4">

                                <label for="cover_letter" class="form-label">
                                    Cover Letter *
                                </label>

                                <textarea class="form-control"
                                          id="cover_letter"
                                          name="cover_letter"
                                          rows="4"
                                          placeholder="Write your cover letter here..."></textarea>

                                <div class="text-danger small" id="coverLetterError"></div>

                                <div class="text-muted small text-end">
                                    Characters: <span id="charCount">0</span>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">

                                <button type="submit" id="submitBtn"
                                        class="btn btn-primary">
                                    Register
                                </button>

                                <button type="reset"
                                        class="btn btn-outline-secondary">
                                    Clear
                                </button>

                            </div>

                        </fieldset>

                    </form>

                </div>

                <div class="card-footer text-center text-muted">
                    Job Application System
                </div>

            </div>

        </div>
    </div>


    <!-- APPLICATION TABLE -->
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Submitted Applications</h4>
        </div>

        <div class="card-body">

            <div class="mb-3">

                <input type="text" id="search"
                       class="form-control"
                       placeholder="Search by fullname or email...">

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Education</th>
                            <th>Skills</th>
                            <th>Experience</th>
                            <th>Submission Date</th>
                        </tr>

                    </thead>

                    <tbody id="applicationTable">

                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No applications submitted yet.
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <div id="recordCount" class="small text-muted">
                Total applications: 0
            </div>

        </div>

    </div>

</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function() {

    // Store applications temporarily
    let applications = [];

    // Error elements
    const errors = {

        fullname: "#fullnameError",
        email: "#emailError",
        pob: "#pobError",
        gender: "#genderError",
        education: "#educationError",
        skills: "#skillsError",
        experience: "#experienceError",
        cover_letter: "#coverLetterError"

    };


    // Clear all errors
    function clearErrors() {

        $.each(errors, function(field, element) {

            $(element).text("").hide();

        });

        $(".form-control, .form-select").removeClass("is-invalid");

    }


    // Clear one field error
    function clearFieldError(field) {

        if (!errors[field]) return;

        $(errors[field]).text("").hide();

        let inputID = field === "education" ?
                      "education_level" : field;

        $("#" + inputID).removeClass("is-invalid");

    }


    // Interactive validation
    $("#fullname, #email, #pob, #experience, #cover_letter")
        .on("input", function() {

            clearFieldError(this.id);

        });


    $("#education_level").on("change", function() {

        clearFieldError("education");

    });


    $('input[name="gender"]').on("change", function() {

        clearFieldError("gender");

    });


    // Skills counter
    $('input[name="skills[]"]').on("change", function() {

        let count = $('input[name="skills[]"]:checked').length;

        $("#skillsCount").text(count + " skills selected");

        clearFieldError("skills");

    });


    // Cover letter counter
    $("#cover_letter").on("input", function() {

        $("#charCount").text($(this).val().length);

    });


    // Submit using AJAX
    $("#jobForm").on("submit", function(event) {

        event.preventDefault();

        clearErrors();

        $("#message").empty();

        $("#result").empty();

        let formData = new FormData(this);

        $("#submitBtn")
            .prop("disabled", true)
            .text("Submitting...");


        $.ajax({
            // Correct PHP file name
            url: "from-hadling.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",

            beforeSend: function() {

                $("#message").html(
                    '<div class="alert alert-info">Submitting application...</div>'
                );

            },


            success: function(data) {

                $("#message").empty();


                if (data.success) {

                    // Success message
                    $("#message").hide().html(

                        '<div class="alert alert-success">' +
                        data.message +
                        '</div>'

                    ).fadeIn(500);


                    // Application result
                    $("#result").hide()
                        .html(data.result)
                        .slideDown(500);


                    // Add application
                    applications.push(data.application);


                    // Update table
                    displayApplications();


                    // Clear form
                    $("#jobForm")[0].reset();

                    $("#skillsCount").text("0 skills selected");

                    $("#charCount").text("0");

                }

                else {

                    // General error
                    $("#message").hide().html(

                        '<div class="alert alert-danger">' +
                        data.message +
                        '</div>'

                    ).fadeIn(500);


                    // Individual errors
                    if (data.errors) {

                        $.each(data.errors, function(field, error) {

                            if (error !== "" && errors[field]) {

                                $(errors[field])
                                    .text(error)
                                    .fadeIn(300);


                                if (field === "gender") {

                                    $("#male").trigger("focus");

                                }

                                else if (field === "skills") {

                                    $("#php").trigger("focus");

                                }

                                else {

                                    let inputID = field === "education" ?
                                                  "education_level" : field;

                                    $("#" + inputID)
                                        .addClass("is-invalid")
                                        .trigger("focus");

                                }

                            }

                        });

                    }

                }

            },

            error: function(xhr) {

                $("#message").html(

                    '<div class="alert alert-danger">' +
                    'Could not contact the PHP handler. Check the file name, localhost URL, and PHP errors.' +
                    '</div>'

                );

                console.error("AJAX error:", xhr.status, xhr.responseText);

            },

            complete: function() {

                $("#submitBtn")
                    .prop("disabled", false)
                    .text("Register");

            }
        });
    });

    function displayApplications() {
        let searchValue = $("#search").val().toLowerCase();
        let filtered = applications.filter(function(app) {
            return String(app.fullname).toLowerCase().includes(searchValue) ||
                   String(app.email).toLowerCase().includes(searchValue);

        });


        let rows = "";


        if (filtered.length === 0) {

            rows = `

                <tr>

                    <td colspan="8" class="text-center">

                        No matching applications found.

                    </td>

                </tr>

            `;

        }

        else {

            $.each(filtered, function(index, app) {

                rows += `

                    <tr>

                        <td>${escapeHTML(app.id)}</td>
                        <td>${escapeHTML(app.fullname)}</td>
                        <td>${escapeHTML(app.email)}</td>
                        <td>${escapeHTML(app.gender)}</td>
                        <td>${escapeHTML(app.education)}</td>
                        <td>${escapeHTML(app.skills)}</td>
                        <td>${escapeHTML(app.experience)} years</td>
                        <td>${escapeHTML(app.date)}</td>

                    </tr>

                `;

            });

        }


        $("#applicationTable").html(rows);


        $("#recordCount").text(

            "Showing " + filtered.length +

            " of " + applications.length + " applications"

        );

    }



    function escapeHTML(value) {
        return $("<div>").text(String(value ?? "")).html();

    }




    $("#search").on("input", function() {
        displayApplications();

    });




    $("#jobForm").on("reset", function() {
        clearErrors();
        $("#message").empty();
        $("#result").empty();
        $("#skillsCount").text("0 skills selected");
        $("#charCount").text("0");

    });

  

});

</script>

</body>
</html>