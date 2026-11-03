<?php

header("Content-Type: application/json");

$success = true;
$errMsg = "";

$errors = [
    "fullname" => "",
    "email" => "",
    "pob" => "",
    "gender" => "",
    "education" => "",
    "skills" => "",
    "experience" => "",
    "cover_letter" => ""
];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $pob = trim($_POST["pob"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $education = $_POST["education_level"] ?? "";
    $skills = $_POST["skills"] ?? [];
    $experience = trim($_POST["experience"] ?? "");
    $cover_letter = trim($_POST["cover_letter"] ?? "");
    if (empty($fullname)) {
        $errors["fullname"] = "* Please fill fullname field!";

    }
    if (empty($email)) {
        $errors["email"] = "* Please fill email field!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "* Please enter a valid email!";

    }
    if (empty($pob)) {
        $errors["pob"] = "* Please fill place of birth!";

    }


    // 4. Validate gender.
    if (empty($gender)) {

        $errors["gender"] = "* Please select gender!";

    } elseif (!in_array($gender, ["male", "female"], true)) {

        $errors["gender"] = "* Invalid gender selection!";

    }


    // 5. Validate education.
    $allowedEducation = ["highschool", "bachelor", "master"];
    if (empty($education)) {
        $errors["education"] = "* Please select education level!";
    } elseif (!in_array($education, $allowedEducation, true)) {
        $errors["education"] = "* Invalid education selection!";

    }


    // 6. Validate skills.
    $allowedSkills = ["PHP", "HTML", "CSS", "JavaScript"];
    if (!is_array($skills)) {
        $skills = [];

    }

    $skills = array_unique(
        array_intersect($skills, $allowedSkills)
    );

    if (count($skills) < 2) {
        $errors["skills"] = "* Please select at least 2 skills!";

    }


    // 7. Validate experience.
    if ($experience === "") {
        $errors["experience"] = "* Please enter years of experience!";
    } elseif (!ctype_digit($experience) || (int)$experience < 1) {
        $errors["experience"] = "* Experience must be at least 1 year!";

    }


    // 8. Validate cover letter.
    if (empty($cover_letter)) {
        $errors["cover_letter"] = "* Please fill cover letter!";

    }


    // Check validation errors.
    foreach ($errors as $error) {
        if ($error !== "") {
            $success = false;
            break;

        }

    }


    // If validation fails.
    if (!$success) {

        $errMsg = "Please correct the errors in the form.";

        echo json_encode([
            "success" => false,
            "message" => $errMsg,
            "errors" => $errors
        ]);

        exit;

    }
    $skillsText = implode(", ", $skills);
    $applicationID = time();
    $submissionDate = date("Y-m-d H:i:s");
    $application = [
        "id" => $applicationID,
        "fullname" => $fullname,
        "email" => $email,
        "pob" => $pob,
        "gender" => $gender,
        "education" => $education,
        "skills" => $skillsText,
        "experience" => (int)$experience,
        "cover_letter" => $cover_letter,
        "date" => $submissionDate

    ];


    // Display successful application information.
    $result = '

    <div class="alert alert-success mt-3">

        <h4 class="alert-heading">Job Application Information</h4>

        <hr>

        <p><strong>Application ID:</strong> ' .
        htmlspecialchars((string)$applicationID) . '</p>

        <p><strong>Fullname:</strong> ' .
        htmlspecialchars($fullname) . '</p>

        <p><strong>Email:</strong> ' .
        htmlspecialchars($email) . '</p>

        <p><strong>Place of Birth:</strong> ' .
        htmlspecialchars($pob) . '</p>

        <p><strong>Gender:</strong> ' .
        htmlspecialchars($gender) . '</p>

        <p><strong>Education:</strong> ' .
        htmlspecialchars($education) . '</p>

        <p><strong>Skills:</strong> ' .
        htmlspecialchars($skillsText) . '</p>

        <p><strong>Experience:</strong> ' .
        htmlspecialchars($experience) . ' years</p>

        <p><strong>Cover Letter:</strong><br>' .
        nl2br(htmlspecialchars($cover_letter)) . '</p>

        <p><strong>Submission Date:</strong> ' .
        htmlspecialchars($submissionDate) . '</p>

        <hr>

        <div class="text-end d-print-none">

            <button onclick="window.print()"
                    class="btn btn-dark btn-sm">

                Save as PDF / Print

            </button>

        </div>

    </div>';


    // Return successful JSON response.
    echo json_encode([

        "success" => true,

        "message" => "Job application submitted successfully!",

        "result" => $result,

        "application" => $application

    ]);

} else {

    echo json_encode([

        "success" => false,

        "message" => "Invalid request method."

    ]);

}

?>





