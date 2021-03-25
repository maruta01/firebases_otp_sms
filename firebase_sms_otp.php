<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase SMS OTP</title>
    <meta name="author" content="Marut Jaipala">
    <meta name="description" content="You can read more details on website https://firebase.google.com/docs/auth/web/phone-auth?authuser=0  enjoy">

    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


    <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>

    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-analytics.js"></script>

    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-firestore.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-6 pt-4 ">
            <h1>Firebase Authentication With SMS OTP </h1>
            <div class="input-group mt-4">
                <input id="phoneNumber" type="text" class="form-control" placeholder="+66987654321" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <button type="button" class="btn btn-primary" onclick="phoneSendOTP()">Request_OTP</button>
            </div>
            <div id="showCapcha"></div>
            <div id="recaptcha-container"></div>
            <p></p>
            <div id="show_vertify_otp" style="display: none;">
                <div class="input-group mt-4 ">
                    <input type="number" id="OTP" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <button type="button" class="btn btn-success" onclick="vertify_otp()">Submit</button>
                </div>
            </div>
        </div>

        <div id="show_message"></div>
    </div>

</body>

</html>

<script>
    // firebaseConfig is https://console.firebase.google.com/u/0/project/ -> Project setting  { IN TITLE : Your apps }
    var firebaseConfig = {
        apiKey: "",
        authDomain: "",
        projectId: "",
        storageBucket: "",
        messagingSenderId: "",
        appId: "",
        measurementId: ""
    };
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    firebase.auth().languageCode = 'th';

    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');

    function phoneSendOTP() {
        const phoneNumber = document.getElementById("phoneNumber").value;
        const appVerifier = window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
            .then((confirmationResult) => {
                console.log(confirmationResult)
                window.confirmationResult = confirmationResult;
                document.getElementById('recaptcha-container').style.display = 'none';
                document.getElementById('show_vertify_otp').style.display = 'block';
            }).catch((error) => {
                document.getElementById("show_message").innerHTML = "" + error.message
                console.log(error.message)
            });
    }

    function vertify_otp() {
        const code = document.getElementById("OTP").value;
        confirmationResult.confirm(code).then((result) => {
            console.log(result)
            const user = result.user;
            alert('OTP VERTIFY : Welcome NEW USER');
            document.getElementById("show_message").innerHTML = "Verified" 
        }).catch((error) => {
            document.getElementById("show_message").innerHTML = "" + error.message
            console.log(error.message)
        });
    }
</script>