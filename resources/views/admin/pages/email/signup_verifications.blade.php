<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    @include('.admin.includes.head')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
/* Font imports */
@font-face {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 400;
    src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
}
@font-face {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 700;
    src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
}
@font-face {
    font-family: 'Lato';
    font-style: italic;
    font-weight: 400;
    src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
}
@font-face {
    font-family: 'Lato';
    font-style: italic;
    font-weight: 700;
    src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
}

/* General styles */
a {
    text-decoration: none;
}

/* Click here to verify email button */
a[href="https://app.pinkad.pk/email-verified"] {
    font-size: 20px;
    font-family: 'Lato', Helvetica, Arial, sans-serif; /* Use the imported font */
    color: #d43790;
    text-decoration: none;
    padding: 15px 25px;
    border-radius: 5px;
    border: 1px solid #d43790;
    display: inline-block;
    background-color: #ffffff;
    transition: background-color 0.3s, color 0.3s; /* Add transition effect */
}

a[href="https://app.pinkad.pk/email-verified"]:hover {
    background-color: #d43790; /* Change background color on hover */
    color: #ffffff; /* Change text color on hover */
}

/* Social icons */
.social-icon {
    display: inline-block;
    width: 30px;
    height: 30px;
    margin-right: 10px; /* Adjust as needed */
    vertical-align: middle;
}

/* Media queries */
@media screen and (max-width: 600px) {
    /* Adjust styles for smaller screens */
    .social-icon {
        width: 20px;
        height: 20px;
    }
}
</style>

</head>
<body>



<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato',
 Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> 
 We're thrilled to have you here! Get ready to dive into your new account. </div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="#f1f1f1" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f1f1f1" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                    
                    <img src="https://pinkad.pk/portal/assets/img/logo-default.png" width="50%" height="30%" style="display: block; border: 0px;" />

                         <h1 style="font-size: 29px; font-weight: bold; margin: 2;">Welcome!</h1>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h4 style="margin: 0;">We're excited to have you get started. First, you need to confirm your account.
                         Just press the button below.</h4>
                    </td>
                </tr>
                <!-- <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B">
                                            <a href="https://app.pinkad.pk/email-verified" target="_blank" 
                                            style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff;
                                             text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; 
                                             border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">
                                             Click Here to Verify Your Email
                                             </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>  -->
                <!-- COPY -->
                <!-- <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">If that doesn't work, copy and paste the following link in your browser:</p>
                    </td>
                </tr> COPY -->
                <!-- <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;"><a href="#" target="_blank" style="color: #FFA73B;">https://ts.xx/sdfgd</a></p>
                    </td>
                </tr> -->
              <!--  -->
              <tr>
    <td bgcolor="#f1f1f1" align="center" style="padding: 23px 30px 0 30px;">
    <table border="0" cellspacing="0" cellpadding="0">
        <!-- Facebook -->
        <tr>
            <td bgcolor="#f1f1f1" align="center" style="padding: 20px;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <h5 style="margin-bottom: 10px; font-size: 16px;">
                                To watch your profile on PinkAd Facebook page
                                </br>
Follow PinkAd Facebook Page
                            </h5>
                            <a href="https://m.facebook.com/pinkad.pk" target="_blank" style=
                            " color: #ffffff; text-decoration: none; padding: 10px 20px;
                             border-radius: 5px; display: inline-block; ">
                             <!-- >background-color: #3b5998;"> -->
                        <img src="{{ asset('/assets/img/icons/facebook.png') }}" alt="Facebook"
                        style="width: 10%; height: 10%; vertical-align: middle; margin-right: 5px;">
                        </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Instagram -->
        <tr>
            <td bgcolor="#f1f1f1" align="center" style="padding: 20px;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <h5 style="margin-bottom: 10px; font-size: 16px;">
                                To watch your Profile on PinkAd Instagram
                                </br>
                                 Follow PinkAd Instagram
                            </h5>
                            <a href="https://m.instagram.com/pinkad.pk" target="_blank" 
                            style="font-size: 16px; color: #ffffff; 
                            text-decoration: none; padding: 10px 20px; border-radius: 5px;
                             display: inline-block;">
                                <img src="{{ asset('/assets/img/icons/instagram.png') }}" 
                                alt="Instagram" style="width: 10%; height: 10%; vertical-align: middle; margin-right: 5px;">
                               
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- WhatsApp -->
        <tr>
            <td bgcolor="#f1f1f1" align="center" style="padding: 20px;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <h5 style="margin-bottom: 10px; font-size: 16px;">
                                To get promotional tips about campaign start date etc.
                                </br>
                                 Follow PinkAd WhatsApp Channel
                            </h5>
                            <a href="https://whatsapp.com/channel/0029VaFeRli5vKAA6uEjVN23" target="_blank" 
                            style="font-size: 16px; color: #ffffff; text-decoration: none; padding: 10px 20px;
                             border-radius: 5px; display: inline-block;">
                                <img src="{{ asset('/assets/img/icons/whatsapp.png') }}" 
                                alt="WhatsApp" style="width: 10%; height: 10%; vertical-align: middle; margin-right: 5px;">
                               
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </td>
</tr>

              <!--  -->

              <tr>
    <td bgcolor="#ffffff" align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px;">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="center" bgcolor="#d43790" style="border-radius: 3px;">
                                <a href="https://app.pinkad.pk/email-verified" target="_blank" style="display: inline-block; font-size: 16px; font-family: Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 15px 30px; border-radius: 5px; background-color: #d43790;">
                                    Click Here to Verify Your Email
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>



                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h4 style="margin: 0; :000000">Pinkad Team</h4>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
                        <p style="margin: 0;"><a href="#" target="_blank" style="color: #FFA73B;">We&rsquo;re here to help you out</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                        <p style="margin: 0;">If these emails get annoying, please feel free to <a href="#" target="_blank" style="color: #111111; font-weight: 700;">unsubscribe</a>.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- new section -->
<!-- end: page -->
<footer class="row">
    @include('.admin.includes.footer')
</footer>
</body>
</html>
