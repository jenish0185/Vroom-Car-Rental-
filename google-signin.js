function onGoogleSignIn() {
    // Load 'auth2'
    gapi.load('auth2', function() {
        // Initialize GoogleAuth object
        var auth2 = gapi.auth2.init({
            client_id: '1044023192075-bjdg7o3u278358k6j6r98kfr2v1g4ak6.apps.googleusercontent.com'
        }); // Close initialization here
        
        // Start the sign-in process
        auth2.signIn().then(function(googleUser) {
            // Handle the sign-in success
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId());
            console.log('Name: ' + profile.getName());
            console.log('Email: ' + profile.getEmail());
            console.log('Image URL: ' + profile.getImageUrl());
            
            // Redirect to Google authentication page
            window.location.href = 'https://accounts.google.com/o/oauth2/auth' +
                '?client_id=1044023192075-bjdg7o3u278358k6j6r98kfr2v1g4ak6.apps.googleusercontent.com' +
                '&redirect_uri=http://localhost/Login%20page/customerdash.php' + 
                '&response_type=code' +
                '&scope=email%20profile' +
                '&state=STATE_VALUE' +
                '&access_type=offline';
 
        }).catch(function(error) {
            // Handle the sign-in error
            console.error('Google Sign-In Error: ', error);
        });
    });
}
