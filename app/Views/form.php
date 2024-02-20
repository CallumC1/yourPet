
<!-- create a basic form that gets a users name and email -->
<form action="/formSubmit" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>
    <br>
    <input type="submit" value="Submit">
</form>


<?php

    foreach ($formData as $data) {
        echo $data['name'] . " " . $data['email'] . "<br>";
    }
?>