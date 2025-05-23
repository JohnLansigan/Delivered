<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="signup.css">

    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <style>
        .error-message {
            color: red;
            font-size: 1em;
        }
    </style>

</head>

<body>

    <div id='nav-container'>

        <img id='logo' src="icon.png" alt="logo.png">

        <div id='middle-nav'>

            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>

        </div>

        <a href="login.php"><button id='login'><img src="profile.png" alt="profile.png">Login</button></a>

    </div>

    <form id='form-container' action="signup_process.php" method="post" onsubmit="return validateForm()">
        <h1>Sign up</h1>

        <div>
            <div>
                <label for="fname">First Name <strong>*</strong></label>
                <label for="lname">Last Name <strong>*</strong></label>
            </div>

            <div>
                <input id='fname' type="text" maxlength=50 name="fname" required onkeyup="validateFirstName()">
                <input id='lname' type="text" maxlength=50 name="lname" required onkeyup="validateLastName()">
            </div>
            
            <div>
                <p id="fname-error" class="error-message"></p>
                <p id="lname-error" class="error-message"></p>
            </div>

        </div>

        <div>
            <label for="address">Address <strong>*</strong></label>
            <input id='address' type="text" maxlength=250 name="address" required onkeyup="validateAddress()">
            <p id="address-error" class="error-message"></p>
        </div>

        <div>
            <label for="email">Email <strong>*</strong></label>
            <input id='email' type="email" maxlength=100 name="email" required onkeyup="validateEmail()">
            <p id="email-error" class="error-message"></p>
        </div>

        <div>
            <label for="username">Username <strong>*</strong></label>
            <input id='username' type="text" maxlength=50 name="username" required onkeyup="validateUsername()">
            <p id="username-error" class="error-message"></p>
        </div>

        <div>
            <label for="password">Password <strong>*</strong></label>
            <input id='password' type="password" maxlength=50 name="password" required onkeyup="validatePassword(); validateRePassword()">
            <div id="password-error" class="error-message"></div>
        </div>


        <div>
            <label for="repassword">Re-enter Password <strong>*</strong></label>
            <input id='repassword' type="password" maxlength=50 name="repassword" required onkeyup="validateRePassword()">
            <input type="checkbox" onclick="repassToggle()"  id="show">
            <label for="checkbox">Show Passwords</label>
            <div id="repassword-error" class="error-message"></div>
        </div>

        <hr>

        <div>
            <input type="checkbox" id="accept" name="accept" required onchange="validateAccept()">
            <label for="accept" id="bySi">By signing up you agree to our <a href="terms.php" onclick="showTerms(event)">Terms and conditions</a></label>
            <div id="accept-error" class="error-message"></div>
        </div>

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="login.php">Log In</a></p>

    </form>

    <div id='footer-container'>

        <div>

            <h2>[Delivered]</h2>
            <p>a passion project.</p>
            <br>
            <br>
            <p>© 2025 [Delivered] All rights reserved</p>

        </div>

        <div>

            <h3>Links</h3>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="terms.php">Terms</a>
            <a href="create.php">Create</a>

        </div>

        <div>

            <h3>The Project</h3>
            <p>News</p>
            <p>Partners</p>
            <p>Contact Us</p>
            <p>Contact Us</p>

        </div>

        <div>

            <h3>Services</h3>
            <p>Feedback</p>
            <p>Report Bugs</p>
            <p>Download</p>
            <p>Get Help</p>

        </div>

        <div>

            <h3>Socials</h3>
            <p>Instagram</p>
            <p>Facebook</p>
            <p>Twitter</p>
            <p>TikTok</p>

        </div>

    </div>

    <script>
        function validateFirstName() {
            const fnameInput = document.getElementById('fname');
            const fnameError = document.getElementById('fname-error');
            if (fnameInput.value.trim() === '') {
                fnameError.textContent = 'First name is required.';
                return false;
            } else {
                fnameError.textContent = '';
                return true;
            }
        }

        function validateLastName() {
            const lnameInput = document.getElementById('lname');
            const lnameError = document.getElementById('lname-error');
            if (lnameInput.value.trim() === '') {
                lnameError.textContent = 'Last name is required.';
                return false;
            } else {
                lnameError.textContent = '';
                return true;
            }
        }

        function validateAddress() {
            const addressInput = document.getElementById('address');
            const addressError = document.getElementById('address-error');
            if (addressInput.value.trim() === '') {
                addressError.textContent = 'Address is required.';
                return false;
            } else {
                addressError.textContent = '';
                return true;
            }
        }

        function validateEmail() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput.value.trim() === '') {
                emailError.textContent = 'Email is required.';
                return false;
            } else if (!emailRegex.test(emailInput.value)) {
                emailError.textContent = 'Invalid email format.';
                return false;
            } else {
                emailError.textContent = '';
                return true;
            }
        }

        function validateUsername() {
            const usernameInput = document.getElementById('username');
            const usernameError = document.getElementById('username-error');
            if (usernameInput.value.trim() === '') {
                usernameError.textContent = 'Username is required.';
                return false;
            } else if (usernameInput.value.length < 3) {
                usernameError.textContent = 'Username must be at least 3 characters long.';
                return false;
            } else {
                usernameError.textContent = '';
                return true;
            }
        }

        function validatePassword() {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('password-error');
            const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[0-9]).{8,}$/;
            if (passwordInput.value.trim() === '') {
                passwordError.textContent = 'Password is required.';
                return false;
            } else if (!passwordRegex.test(passwordInput.value)) {
                passwordError.textContent = 'Password must be at least 8 characters and include one capital letter, one special character, and one number.';
                return false;
            } else {
                passwordError.textContent = '';
                return true;
            }
        }

        function validateRePassword() {
            const passwordInput = document.getElementById('password');
            const repasswordInput = document.getElementById('repassword');
            const repasswordError = document.getElementById('repassword-error');
            if (repasswordInput.value.trim() === '') {
                repasswordError.textContent = 'Please re-enter your password.';
                return false;
            } else if (passwordInput.value !== repasswordInput.value) {
                repasswordError.textContent = 'Passwords do not match.';
                return false;
            } else {
                repasswordError.textContent = '';
                return true;
            }
        }

        function validateAccept() {
            const acceptCheckbox = document.getElementById('accept');
            const acceptError = document.getElementById('accept-error');
            if (!acceptCheckbox.checked) {
                acceptError.textContent = 'You must accept the terms and conditions.';
                return false;
            } else {
                acceptError.textContent = '';
                return true;
            }
        }


        function validateForm() {
            const isFirstNameValid = validateFirstName();
            const isLastNameValid = validateLastName();
            const isAddressValid = validateAddress();
            const isEmailValid = validateEmail();
            const isUsernameValid = validateUsername();
            const isPasswordValid = validatePassword();
            const isRePasswordValid = validateRePassword();
            const isAcceptValid = validateAccept();

            return isFirstNameValid && isLastNameValid && isAddressValid && isEmailValid && isUsernameValid && isPasswordValid && isRePasswordValid && isAcceptValid;
        }

        function repassToggle() {
            var x = document.getElementById("password");
            var y = document.getElementById("repassword");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
            }


    
    function showTerms(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Terms and Conditions',
        html: `
            <p><b>By clicking on the agree buttton:</b></p>
                <p style="text-align:justify">1.   You acknowledge and agree that Upon review, your submission will be published in the Home page. Any information you type 
            into your submission can be seen and searched for by any person on the internet indefinitely. You are required to create 
            an account in order to create a submission. You may edit or delete a submission you sent within 24 hours of submission. 
            Otherwise, you cannot edit or delete this message anymore and only view them. It is at the administrators discretion to 
            delete any account or submissions they deem inappropriate. You agree to be bound by the Terms of Use and Privacy Policy 
            for the [Delivered] Website and affiliated entities.</p><br>

                <p style="text-align:justify">2.   You warrant that you have all necessary licenses and permissions to submit this content and have it posted. You represent and 
            warrant that you have all necessary rights, licenses, and permissions to grant the above licenses. You represent and warrant that 
            the Content submitted by you, and the submission of such Content, do not and will not violate any intellectual property rights 
            (including copyrights and trademark rights) of any third party. You agree that you will indemnify, defend, and hold harmless the
             Delivered Website and employees from any liability, damage or cost (including reasonable attorneys’ fees and costs) and from any 
             claim or demand made by any third party due to violation of these representations and warranties, or otherwise arising out of any 
             submitted Content.</p><br>

                <p style="text-align:justify">3.   You agree you are providing appropriate licenses to the Delivered Website. When you submit content to the website, 
                    you agree that you are granting to the Delivered Website a non-exclusive, worldwide, royalty-free, sublicensable,
                     transferable right and license to use, host, store, cache, reproduce, publish, display (publicly or otherwise), perform
                      (publicly or otherwise), distribute, transmit, modify, adapt (including, without limitation, in order to conform it to the
                       requirements of any networks, devices, services, or media through which the Services are available), and create derivative 
                       works of the Content.</p><br>

                <p style="text-align:justify">4.   You warrant and represent your submission does not violate any applicable laws and DOES NOT contain any of the following: 
                    Doxing information, defined as writing a submission that includes any private or identifying information of their persons. 
                    Any usernames, last names, addresses, phone numbers, dates, links to any outside sources, information about a person’s family, 
                    place of employment, or any other identifying details. Any unlawful, defamatory, libelous, threatening, pornographic, 
                    harassing, or hateful language, including any language that could be deemed discriminatory to anyone’s ethnicity,
                     national origin, race, color, religion, disability, sexual orientation, gender expression or identity, or 
                     physical appearance. Hate speech and bullying language defined as threatening a person or writing anything meant to harm,
                      intimidate, or coerce any individual Absolutely no slurs or derogatory comments of any kind will be permitted.
                       Identifying yourself as the submitter within the message is not allowed. Any duplicate submissions will be deleted. 
                       You understand that by using the Services, you may be exposed to Content that might be offensive, harmful, inaccurate 
                       or otherwise inappropriate, or in some cases, postings that have been mislabeled or are otherwise deceptive. 
                       All Content is the sole responsibility of the person who originated such Content. We may not monitor or control the 
                       Content posted via the Services and, we cannot take responsibility for such Content.</p><br>
        
            <h2>Terms of Use:</h2><br>

            <h3>Content</h3><br>
            <p style="text-align: justify;">You are responsible for your use of the Services and for any Content you provide, including compliance with applicable laws, rules,
        and regulations. You should only provide Content that you are comfortable sharing with others. Any use or reliance on any Content or
        materials posted via the Services or obtained by you through the Services is at your own risk. We do not endorse, support, represent
        or guarantee the completeness, truthfulness, accuracy, or reliability of any Content or communications posted via the Services or endorse
        any opinions expressed via the Services. You understand that by using the Services, you may be exposed to Content that might be
        offensive, harmful, inaccurate or otherwise inappropriate, or in some cases, postings that have been mislabeled or are otherwise
        deceptive. All Content is the sole responsibility of the person who originated such Content. We may not monitor or control the Content
        posted via the Services and, we cannot take responsibility for such Content. We reserve the right to remove Content that violates the
        User Agreement, including for example, copyright or trademark violations or other intellectual property misappropriation,
        impersonation, unlawful conduct, or harassment. This license authorizes us to make your Content available to the rest of
        the world and to let others do the same. You agree that this license includes the right for the website to provide, promote,
        and improve the Services and to make Content submitted to or through the Services available to other companies, organizations or
        individuals for the syndication, broadcast, distribution, promotion or publication of such Content on other media and services,
        subject to our terms and conditions for such Content use.</p><br>

        <h3>Your Account</h3><br>
            <p style="text-align: justify;">You may need to create an account to use some of our Services. You are responsible for safeguarding your account, so use a strong password and limit its use to this account. We cannot and will not be liable for any loss or damage arising from your failure to comply with the above. We may need to provide you with certain communications, such as service announcements and administrative messages. These communications are considered part of the Services and your account, and you may not be able to opt-out from receiving them. If you added your phone number to your account and you later changed or deactivated that phone number, you must update your account information to help prevent us from communicating with anyone who acquires your old number.</p><br>

            <h3>Ending These Terms</h3><br>
            <p style="text-align: justify;">You may end your legal agreement with the Delivered Website at any time by deactivating your accounts and discontinuing your use of the Services. We may suspend or terminate your account or cease providing you with all or part of the Services at any time for any or no reason, including, but not limited to, if we reasonably believe: (i) you have violated these Terms (ii) you create risk or possible legal exposure for us; (iii) your account should be removed due to unlawful conduct, (iv) your account should be removed due to prolonged inactivity; or (v) our provision of the Services to you is no longer commercially viable. We will make reasonable efforts to notify you by the email address associated with your account or the next time you attempt to access your account, depending on the circumstances. In all such cases, the Terms shall terminate, including, without limitation, your license to use the Services, except that the following sections shall continue to apply: 2, 3, 5, and 6.
            </p><br>

            <h3>General</h3><br>
            <p style="text-align: justify;">We may revise these Terms from time to time. The changes will not be retroactive, and the most current version of the Terms, which will always be at this page. We will try to notify you of material revisions, for example via a service notification or an email to the email associated with your account. By continuing to access or use the Services after those revisions become effective, you agree to be bound by the revised Terms.
            </p><br>

        <h2>Privacy Policy:</h2><br>
        <h3>Data Collection</h3><br>
            <p style="text-align: justify;">We collect technical data, profile data, content, and other data received from you, your organization and other third party sources. We collect and control various types of personal data regarding our Users and visitors to our Sites. Such data is collected and generated through your interaction with us or with our Service, through automatic means, or directly from you, from other Users, from our Customers, or from other third parties (including our Service Providers, as defined below).Specifically, we collect the following categories of data (which, to the extent it relates to an identified or identifiable individual, is deemed as “personal data”): Data automatically collected or generated: When you visit, interact with, or use our Service, we collect, record or generate certain technical data about you. We do so either independently or with the help of third party Service Providers, including through the use of “cookies” and other tracking technologies. Such data consists of connectivity, technical and aggregated usage data, such as IP addresses and general locations, device and application data (like type, operating system, mobile device or app id, browser version, locale and language settings used), date and time stamps of usage, the relevant cookies and pixels installed on or interacted with via such device, and the recorded activity (sessions, clicks, use of features, logged activities and other interactions) of visitors and Users in connection with our Service. In addition, phone calls (e.g., with our customer service or product consultants) may be automatically recorded, tracked and analyzed, for purposes including analytics, service-, operations-, and business quality control and improvements, training, and record-keeping purposes. User Data received from you: When you contact us, sign up to the Service and create your individual profile (“User Profile”), or sign up to an event that we host, organize or sponsor, you provide us with personal data. This would typically include your name, workplace and position, contact details (such as e-mail, phone and address), account login details (e-mail address and passwords which are automatically hashed), as well as any other data you choose to provide when you use our Service, contact us, or interact with others via our Service. For example, you may connect your Google or LinkedIn account when you sign up or login to the Service, and thereby provide us with your name, e-mail address, image and other details available on your profile there. You may also provide us with your profile photo, location, time-zone, skills, device, general location, and activity logs and data; as well as your preferences, characteristics and objectives for using the Service (collectively, “User Data”). You may also send us a “Contact Us” or support requests, or provide us with feedback, reviews, or responses to our surveys or promotions, including by submitting an online form on our Service or social media channels, by posting on any of our online public forums or communities, by sending an e-mail to any of our designated addresses, or any other form of communication. Such data may include details on an issue you are experiencing, contact information and any other documentation, screen recording, screenshots or other information. Our Customers may provide us with additional data such as their billing details, business needs and preferences. To the extent that such data concerns a non-human entity (e.g. the bank account of a company or business), it will not be regarded as “personal data” in most countries. User Data received from our Customers and Users: Customers and Users may provide us with the contact details of potential Users, such as their employees, team members and colleagues, in order for us to contact, invite or subscribe them as Users to our Service (including by using Single sign-on tools). Such data typically includes these individuals’ names, phone numbers and work emails, however additional data may be provided at the discretion of those providing it. For the purposes of this Privacy Policy, this data is also regarded as User Data. Data received from other third parties: We may receive personal data which relates to you from other sources. For example, if you participate in an event, webinar or promotion that we sponsor or participate in, we may receive your personal data from its organizers. We may also receive your contact and professional details (e.g., your name, company, position, contact details and professional experience, preferences and interests) from our Partners (defined below), from our service providers, and through the use of tools and channels commonly used for connecting between companies and individual professionals in order to explore potential business and employment opportunities, such as LinkedIn. Data obtained through Analytics Tools: We may use analytics tools (e.g. Google Analytics) to collect data about the use of our Sites and Service. Analytics tools collect data such as how often Users and visitors visit or use the Sites or Service, which pages they visit and when, which website, ad or e-mail message brought them there, and how they interact with and use our Service and its various features.
            </p><br>

            <h3>Data Use</h3><br>
            <p style="text-align: justify;">We use personal data as necessary for the performance of our Service; to comply with our legal and contractual obligations; and to support our legitimate interests in maintaining and improving our Service, e.g. in understanding how our Service are used and how our campaigns are performing, and gaining insights which help us dedicate our resources and efforts more efficiently; in marketing, advertising and selling our Service to you and others; providing customer service and technical support; and protecting and securing our Users, Customers, visitors, ourselves and our Service. If you reside or are using the Service (i) in a territory governed by privacy laws which determine that “consent” is the only or most appropriate legal basis for processing personal data (in general, or specifically with respect to the types of personal data you choose to share via the Service), your acceptance of our Terms and of this Privacy Policy will be deemed as your consent to the processing of your personal data for all purposes detailed in this Privacy Policy, to the extent permitted under law in such territory. If you wish to revoke such consent, please contact us by email. Specifically, we use personal data for the following purposes: To facilitate, operate, and provide our Service; To authenticate the identity of our Users, and to allow them to access our Service; To provide our visitors, Users and Customers with assistance and support; To gain a better understanding on how visitors and Users evaluate, use and interact with our Service, and how we could improve their and others’ user experience, and continue improving our products, offerings and the overall performance of our Service; To facilitate and optimize our marketing campaigns, ad management and sales operations, and to manage and deliver advertisements for our products and services more effectively, including on other websites and applications. Such activities allow us to highlight the benefits of using our Service, and thereby to increase your engagement and overall satisfaction with our Service. To contact our visitors, Users and Customers (whether existing or prospective) with general or personalized service-related messages, as well as promotional messages that may be of specific interest to them; To facilitate, sponsor and offer certain events, contests and promotions; To publish your feedback and submissions to our Sites, public forums and blogs; To support and enhance our data security measures, including for the purposes of preventing and mitigating the risks of fraud, error or any illegal or prohibited activity; To create aggregated statistical data, inferred non personal data or anonymized or pseudonymised data (rendered non personal), which we or others may use to provide and improve our respective services, or for any other business purpose.

            </p><br>

            <h3>Data Security</h3><br>
            <p style="text-align: justify;">We secure your personal data using the highest industry-standard physical, procedural and technical measures. However, please be aware that regardless of any security measures used, we cannot and do not guarantee the absolute protection and security of any personal data stored with us.
            </p><br>

            <h3>Data Subject Rights</h3><br>
            <p style="text-align: justify;">Individuals have rights concerning their personal data. For all such personal data that we process, you may exercise your rights by contacting us as stated below. If you wish to exercise your privacy rights under applicable law, such as the right to request access to, rectification or erasure of your personal data held with the Delivered Website, or to restrict or object to such personal data’s processing, or to obtain a copy or port such personal data (each to the extent available to you under the laws which apply to you) – please contact us by email.
            </p><br>

            <h3>Additional Notes</h3><br>
            <p style="text-align: justify;">Updates and Amendments: We may update and amend this Privacy Policy from time to time by posting an amended version on our Service. The amended version will be effective as of the date it is published. When we make material changes to this Privacy Policy, we’ll provide Users with notice as appropriate under the circumstances, e.g., by displaying a prominent notice within the Service or by sending an email. Your continued use of the Service after the changes have been implemented will constitute your acceptance of the changes. <br><b>Last Updated: April 21, 2025.</b>
            </p><br>





        `,
        confirmButtonText: 'I Agree',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        didOpen: () => {
            document.body.classList.add('swal2-shown'); 
            Swal.getConfirmButton().addEventListener('click', () => {
                document.getElementById('accept').checked = true;
                validateAccept();
            });
        },
        didClose: () => {
            document.body.classList.remove('swal2-shown'); 
        }
    });
}

    </script>

</body>

</html>