<!DOCTYPE html>

@section('stylesheets')
<style script="text/css">
    body{
        text-align: justify;
    }

    p{
        line-height:1.75
    }
    
    li {
        height: 100%;
    }

    #main{
        position: relative;
        width: 70%;
        left: 15%;
    }

    #about,
    #team,
    #contact,
    #terms{
        position: relative;
        width: 90%;
        left: 5%;
    }

    .line{
        position: relative;
        background: RGB(147,97,140);
        height: 2px;
        width: 90%;
        left: 5%;
    }

    #z1, #z2, #z3, #z4{
        width: 100px;
    }

    #second{
        display: none;
        
    }

    .dropdown{
        position: relative;
        font-size: 130%;
    }
    

    @media screen and (max-width: 736px) {
        #first{
            display: none;
        }

        #second{
            display: block;
        }
    }

</style>
@stop

<html lang="en">

  <head>
    <link href="img/addvise-icon.png" rel="shortcut icon" type="image/x-icon" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container" id="first">
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#terms">Addvise Terms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#policy">Addvise Policy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">Team</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script type="text/JavaScript">
        function unhide(){
            if(document.getElementsByClassName('dropdown')[0].style.display === 'block'){
                document.getElementsByClassName('dropdown')[0].style.display = 'none';
            }else{
                document.getElementsByClassName('dropdown')[0].style.display = 'block';
            }
        }
    </script>

    <div id="second">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <ul class="nav-item">
                        <a style ="cursor:pointer; font-size: 200%;" onclick="unhide();">❤❤❤</a>
                    </ul>
                </ul>
            <div class="dropdown" style="display:none;">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <tr class="navbar-nav ml-auto">
                    <ul class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </ul>
                    <ul class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#terms">Addvise Terms</a>
                    </ul>
                    <ul class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#policy">Addvise Policy</a>
                    </ul>
                    <ul class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#team">Team</a>
                    </ul>
                </tr>
                </div>
            </div>
        </nav>
    </div>

    @extends('main')

    @section('title', 'Welcome')

    @section('content')

    <!--Contain the frame-->
    <div id="main">
        <div id="innerContainer">

            <!-- About -->
            <section id="about">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="section-heading">About Addvise</h1>
                    <h3 class="section-subheading text-muted">Seek advice, give advice. Help others.</h3>
                </div>
                </div>
            </div>

            <div class="row">
            <div class="col-lg-12 text-center">
                Addvise is a one stop web-application platform that allows anyone to seek for an advice from strangers anonymously. The feeds are hosted on the world leading social media platform Facebook and our aim is to bring a unique experience of seeking and receiving both anonymous and real users replies. We believe that there is a market for anonymity due to human nature of seeking validation, and for an audience who seek for real advice for an embarrassing topic.
            </div>
            </div>

            </section>

            <br><br>

            <div class="line"></div>
            <br>

            <!-- Terms and Condition -->
            <section id="terms">
                <div class="container">
                    <h1 class="section-heading">Addvise Terms of Service</h1>

                    <h2>1. Terms</h2>
                        <p>By accessing the website at <a href="https://addvise.ml/">https://addvise.ml/</a>, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>

                    <h2>2. Use License</h2>
                        <ol type="a">
                        <li>
                        Permission is granted to temporarily download one copy of the materials (information or software) on Addvise's website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                            <ol type="i">
                            <li>modify or copy the materials;</li>
                            <li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
                            <li>attempt to decompile or reverse engineer any software contained on Addvise's website;</li>
                            <li>remove any copyright or other proprietary notations from the materials; or</li>
                            <li>transfer the materials to another person or "mirror" the materials on any other server.</li>
                            </ol>
                        </li>
                        <li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by Addvise at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</li>
                        </ol>

                    <h2>3. Disclaimer</h2>
                        <ol type="a">
                        <li>The materials on Addvise's website are provided on an 'as is' basis. Addvise makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</li>
                        <li>Further, Addvise does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</li>
                        </ol>

                    <h2>4. Limitations</h2>
                        <p>In no event shall Addvise or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Addvise's website, even if Addvise or a Addvise authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>

                    <h2>5. Accuracy of materials</h2>
                        <p>The materials appearing on Addvise website could include technical, typographical, or photographic errors. Addvise does not warrant that any of the materials on its website are accurate, complete or current. Addvise may make changes to the materials contained on its website at any time without notice. However Addvise does not make any commitment to update the materials.</p>

                    <h2>6. Links</h2>
                        <p>Addvise has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Addvise of the site. Use of any such linked website is at the user's own risk.</p>

                    <h2>7. Modifications</h2>
                        <p>Addvise may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>

                    <h2>8. Governing Law</h2>
                        <p>These terms and conditions are governed by and construed in accordance with the laws of Singapore and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>
                </div>
            </section>

            <div class="line"></div>
            <br>

            <!-- Privacy Policy -->
            <section id="policy">
                <div class="container">
                    <h1 class="section-heading">Addvise Privacy Policy</h1>
                    
                    <p>This privacy policy ("Policy") describes how Website Operator ("Website Operator", "we", "us" or "our") collects, protects and uses the personally identifiable information ("Personal Information") you ("User", "you" or "your") may provide on the <a target="_blank" rel="nofollow" href="https://addvise.ml">https://addvise.ml</a> website and any of its products or services (collectively, "Website" or "Services"). It also describes the choices available to you regarding our use of your personal information and how you can access and update this information. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.</p>

                    <h2>Collection of personal information</h2>
                        <p>We receive and store any information you knowingly provide to us when you create an account, publish content, fill any online forms on the Website.  When required this information may include your email address, name,  or other Personal Information. You can choose not to provide us with certain information, but then you may not be able to take advantage of some of the Website's features.</p>

                    <h2>Collection of non-personal information</h2>
                        <p>When you visit the Website our servers automatically record information that your browser sends. This data may include information such as your device's IP address, browser type and version, operating system type and version, language preferences or the webpage you were visiting before you came to our Website, pages of our Website that you visit, the time spent on those pages, information you search for on our Website, access times and dates, and other statistics.</p>

                    <h2>Managing personal information</h2>
                        <p>You are able to access, add to, update and delete certain Personal Information about you. The information you can view, update, and delete may change as the Website or Services change. When you update information, however, we may maintain a copy of the unrevised information in our records. We will retain your information for as long as your account is active or as needed to provide you Services. Some information may remain in our private records after your deletion of such information from your account. We will retain and use your information as necessary to comply with our legal obligations, resolve disputes, and enforce our agreements. We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally.</p>

                    <h2>Use of collected information</h2>
                        <p>Any of the information we collect from you may be used to  personalize your experience; improve our Website; improve customer service and respond to queries and emails of our customers; run and operate our Website and Services. Non-personal information collected is used only to identify potential cases of abuse and establish statistical information regarding Website usage. This statistical information is not otherwise aggregated in such a way that would identify any particular user of the system.</p>

                    <h2>Children</h2>
                        <p>We do not knowingly collect any personal information from children under the age of 13. If you are under the age of 13, please do not submit any personal information through our Website or Service. We encourage parents and legal guardians to monitor their children's Internet usage and to help enforce this Policy by instructing their children never to provide personal information through our Website or Service without their permission. If you have reason to believe that a child under the age of 13 has provided personal information to us through our Website or Service, please contact us.</p>

                    <h2>Cookies</h2>
                        <p>The Website uses "cookies" to help personalize your online experience. A cookie is a text file that is placed on your hard disk by a web page server. Cookies cannot be used to run programs or deliver viruses to your computer. Cookies are uniquely assigned to you, and can only be read by a web server in the domain that issued the cookie to you. We may use cookies to collect, store, and track information for statistical purposes to operate our Website and Services. You have the ability to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. If you choose to decline cookies, you may not be able to fully experience the features of the Website and Services.</p>

                    <h2>Advertisement</h2>
                        <p>We may display online advertisements and we may share aggregated and non-identifying information about our customers that we collect through the registration process or through online surveys and promotions with certain advertisers. We do not share personally identifiable information about individual customers with advertisers. In some instances, we may use this aggregated and non-identifying information to deliver tailored advertisements to the intended audience.</p>

                    <h2>Links to other websites</h2>
                        <p>Our Website contains links to other websites that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other websites or third parties. We encourage you to be aware when you leave our Website and to read the privacy statements of each and every website that may collect personal information.</p>

                    <h2>Information security</h2>
                        <p>We secure information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of personal information in its control and custody. However, no data transmission over the Internet or wireless network can be guaranteed. Therefore, while we strive to protect your personal information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and our Website cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third-party, despite best efforts.</p>

                    <h2>Data breach</h2>
                        <p>In the event we become aware that the security of the Website has been compromised or users Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the user as a result of the breach or if notice is otherwise required by law. When we do we will post a notice on the Website.</p>

                    <h2>Legal disclosure</h2>
                        <p>We will disclose any information we collect, use or receive if required or permitted by law, such as to comply with a subpoena, or similar legal process, and when we believe in good faith that disclosure is necessary to protect our rights, protect your safety or the safety of others, investigate fraud, or respond to a government request.</p>

                    <h2>Changes and amendments</h2>
                        <p>We reserve the right to modify this privacy policy relating to the Website or Services at any time, effective upon posting of an updated version of this Policy on the Website. When we do we will  post a notification on the main page of our Website. Continued use of the Website after any such changes shall constitute your consent to such changes. Policy was created with <a style="color:#222" target="_blank" title="Create privacy policy" href="https://www.websitepolicies.com/privacy-policy-generator">WebsitePolicies.com</a></p>

                    <h2>Acceptance of this policy</h2>
                        <p>You acknowledge that you have read this Policy and agree to all its terms and conditions. By using the Website or its Services you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to use or access the Website and its Services.</p>

                    <h2>Contacting us</h2>
                        <p>If you have any questions about this Policy, please contact us.</p>
                        <p>This document was last updated on September 5, 2017.</p>
                </div>
            </section>

            <div class="line"></div>
            <br>

            <!-- Team -->
            <section class="bg-light" id="team">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="section-heading">Our Amazing Team</h1>
                    <h3 class="section-subheading text-muted">Meet out amazing team who developed Addvise in a short span of 4 weeks named in ascending order.</h3>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="team-member">
                        <img id="z1" class="mx-auto rounded-circle" src="img/girl.png" alt="">
                        <h4>Apoorva</h4>
                        <p class="text-muted">Student</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">
                        <img id="z3" class="mx-auto rounded-circle" src="img/girl.png" alt="">
                        <h4>Jia Yee</h4>
                        <p class="text-muted">Student</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">
                        <img id="z4" class="mx-auto rounded-circle" src="img/girl.png" alt="">
                        <h4>Won</h4>
                        <p class="text-muted">Student</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">
                        <img id="z2" class="mx-auto rounded-circle" src="img/girl.png" alt="">
                        <h4>Zihan</h4>
                        <p class="text-muted">Student</p>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <!-- Footer -->
            <footer>
            <div class="container">
                <center>
                    <span class="copyright">Copyright &copy; Addvise 2017</span>
                </center>
            </div>
            </footer>

        </div>
    </div>

    <br><br>
    </body>

</html>

@stop


