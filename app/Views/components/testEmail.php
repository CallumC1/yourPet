<form>

    <input type="text" placeholder="token" id="providedToken">

    <input type="submit" value="Verify Email" id="tokenSubmit">

</form>

<script>

    document.getElementById("tokenSubmit").addEventListener("click", function() {
        event.preventDefault();

        var token = document.getElementById("providedToken").value;

        if (!token) {
            alert("Please enter a token");
            return;
        }

        window.location.href = "/auth/email/<?=$user_id?>/" + token;

    });

</script>