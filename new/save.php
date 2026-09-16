<?php

// Get the form data from the AJAX request
$formData = json_decode(file_get_contents('php://input'), true);

// Process the form data
$name = $formData['name'];
$lastName = $formData['lastName'];
$email = $formData['email'];

// Perform any necessary validation or data manipulation here

// Return a response
$response = ['status' => 'success'];
echo json_encode($response);

?>