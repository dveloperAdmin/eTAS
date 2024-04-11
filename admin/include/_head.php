<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="admin/assets/images/bio-logo.png" type="image/png" />

  <!--plugins-->
  <link href="admin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="admin/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="admin/assets/css/style5.css" rel="stylesheet" />
  <!-- <link href="admin/assets/css/icons.css" rel="stylesheet"> -->
  <link href="admin/assets/css/ionicons.css" rel="stylesheet">
  <link href="admin/assets/css/icons8.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="admin/assets/icofont/css/icofont.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


  <!-- loader-->
  <link href="admin/assets/css/pace.min.css" rel="stylesheet" />


  <!--Theme Styles-->
  <link href="admin/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="admin/assets/css/light-theme.css" rel="stylesheet" />
  <link href="admin/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="admin/assets/css/header-colors.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css"> -->
  <!-- alert box  -->
  <script src="js/sweetalert2.js"></script>




  <title>eTAS</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Kode+Mono:wght@400..700&family=Protest+Riot&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');

  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Orbitron:wght@400..900&family=Oswald:wght@200..700&display=swap');

  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lora:ital,wght@0,400..700;1,400..700&family=Orbitron:wght@400..900&family=Oswald:wght@200..700&display=swap');

  <?php if(isset($_SESSION['newUser'])) {
    ?>

    /* Hide li elements with title not equal to "Users" */
    .nav-pills .nav-item,
    a[href="user-Ui"] {
      display: none;
    }

    #newusers {
      display: block;
    }

    <?php
  }

  ?>#header-name {
    font-family: 'Protest Guerrilla', sans-serif;
    font-size: 2.5rem;
    font-weight: 400;
    font-style: normal;
    /* background: -webkit-linear-gradient(45deg, #09009f, #00ff95 80%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; */
  }

  input[type="file"]::file-selector-button {
    background-color: greenyellow;
    color: black;
    font-style: italic;
    font-family: "Oswald", sans-serif;
    font-size: 18px;

  }

  .style-key-input {
    width: 25px;
    height: 40px;
    text-align: center;
    font-size: 22px;
    /* font-weight: 900; */
    font-family: 'Aboreto', cursive;
  }

  .btn-extend {
    padding: 0.2rem 2rem;

    text-align: center;
    font-family: inherit;
    color: #fff;
    background: #166beff7;
    cursor: pointer;
    border-radius: 9px;
    height: 50px;
    font-size: 25px;
    border: none;

  }

  .btn-extend:hover {
    background: #0a8a0ef7;
  }

  .progress {
    background-color: grey;
    border: 1px solid black;
    height: 100%;
    width: 100%;
  }

  #displayProgress {
    padding: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: repeating-linear-gradient(to left,
        #00d100,
        #acff0a,
        #d5ff0a,
        #f6ff0a);
    box-shadow: 0 5px 5px -6px #00d100, 0 3px 7px #acff0a;
    color: black;
    height: 100%;
    width: 0%;
    transition: 1s ease .3s;
  }

  #date_span,
  #clock_span {
    font-family: 'Protest Guerrilla', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 1.2rem;
  }

  #pageHeader {
    margin-bottom: 0.8rem !important;
    border-radius: 0;
    border-top-left-radius: 12px;
    /* border-bottom-left-radius: 12px; */
    padding: .8rem;
    border-color: #135a9b !important;
    border-width: 5px !important;
    border-right: .3rem solid red !important;
    border-bottom-right-radius: 12px;
  }


  .mb-header {
    margin-bottom: 0 !important;
  }

  .page-content {
    padding-top: .8rem;
  }

  .icon-size {
    font-size: 1.1rem;

  }

  .tduser {
    padding: .3rem .5rem !important;
  }

  .header-sec {
    font-family: "Oswald", sans-serif;
    font-weight: 500;
    font-style: normal;
  }

  .mst-2 {
    height: 235px;

  }

  .mst-3 {
    height: 345px;
  }

  .table-header {
    position: sticky;
    top: 0;
  }

  .col-14 {
    margin-bottom: .35rem;
  }

  .col-15 {
    padding-right: 0px;
    flex: 0 0 auto;
    max-width: 50%;
    margin-bottom: .35rem;
  }

  .col-20 {
    padding-right: 0px;
    flex: 0 0 auto;
    max-width: 24%;

    margin-bottom: .35rem;
  }

  .col-17 {
    padding-right: 0px;
    flex: 0 0 auto;
    max-width: 31%;
    margin-top: .5rem;
    margin-bottom: .35rem;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  input[type=number] {
    -moz-appearance: textfield;
  }

  .col-18 {
    padding-right: 0px;
    flex: 0 0 auto;
    max-width: 69%;
    margin-top: .5rem;
    margin-bottom: .3rem;
  }

  .col-16 {
    padding-right: 0px;
    flex: 0 0 auto;
    max-width: 33.3%;
  }

  .row-2 {
    padding-right: 0px;
  }



  input[type="time"] {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
  }

  .info-box {
    position: relative;
    display: inline-block;
    cursor: pointer;
  }

  .info-icon {
    position: relative;
    z-index: 1;
    /* Ensure icon is on top */
  }

  .info-content {
    display: none;
    position: absolute;
    top: -12rem;
    font-family: times;
    /* Position to the top of the icon */
    left: calc(-4% + 10px);
    /* Position to the right side of the info icon */
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 10px;
    z-index: 0;
    /* Ensure content is below icon */
    width: 628px;
    animation: slideIn 0.5s forwards;
    /* Apply slide in animation */
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    /* Add box shadow for depth */
    border-radius: 5px;
    /* Add border radius for rounded corners */
    transform-origin: top left;
    /* Set transform origin to top left corner */
    transform: translateY(-100%);
    /* Move content up by its height */
  }

  .connector {
    position: absolute;
    width: 0;
    height: 0;
    top: auto;
    bottom: -10px;
    /* Position connector to the bottom of the info content */
    left: -10px;
    /* Position connector to the left of the info content */
    border-left: 10px solid transparent;
    /* Left border for triangle */
    border-right: 10px solid #f9f9f9;
    /* Right border for triangle */
    border-top: 10px solid transparent;
    /* Top border for triangle */
  }

  @keyframes slideIn {
    0% {
      opacity: 0;
      transform: translateY(-10px);
      /* Initial position above the icon */
    }

    100% {
      opacity: 1;
      transform: translateY(0);
      /* Slide in to the top */
    }
  }

  .info-icon {
    font-size: 1.2rem;
    color: #135a9b;
    font-weight: 700;
  }

  .imp-emp {
    color: black;
    font-weight: 700;
    font-size: 1.5rem;
    font-family: "Oswald", sans-serif;
    margin-right: 4.6rem;
  }

  .dbBack {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: center;
    padding-right: 3rem;
  }

  .col-xl-16 {
    width: 65%;
    margin-left: 0 !important;

  }

  @media screen and (max-width: 1025px) {
    .col-15 {
      width: 100%;
    }

    .col-20 {
      width: 100%;
    }

    .col-16 {
      width: 100%;
    }

    .col-17 {
      width: 100%;
    }

    .col-18 {
      width: 100%;
    }

    .info-content {
      width: 400px;
      top: -19rem;
    }

    .imp-emp {
      margin-right: 0rem;
      font-size: 15px;
    }

    .col-xl-16 {
      width: 100%;
      margin-left: auto !important;

    }
  }




  /* toggle button */

  .checkBtn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: #dde1e7;
    border-radius: 28px;
    box-shadow: -3px -3px 7px #ffffff73,
      3px 3px 5px rgba(94, 104, 121, 0.288);
  }

  .checkBtn .checkBtnToggle {
    height: 25px;
    width: 60px;
  }

  .checkBtnToggle input {
    position: relative;
    height: 100%;
    width: 100%;
    background: #d6d6d6;
    outline: none;
    -webkit-appearance: none;
    border-radius: 25px;
    cursor: pointer;
    box-shadow: -8px -4px 8px 0px #ffffff73,
      8px 4px 12px 0px rgba(94, 104, 121, 0.288),
      inset -4px -4px 4px 0px #ffffff73,
      inset 4px 4px 4px 0px rgba(94, 104, 121, 0.288);
  }

  .checkBtnToggle input:before {
    position: absolute;
    content: '';
    left: 0;
    top: 0;
    width: 25px;
    height: 25px;
    background: #135a9b;
    border: 2px solid #fc0202;
    border-radius: 50%;
    box-shadow: -8px -4px 8px 0px #ffffff73,
      8px 4px 12px 0px rgba(94, 104, 121, 0.288);
    transition: left 0.4s cubic-bezier(0.85, 0.05, 0.18, 1.35);
  }

  input:checked:before {
    left: 33px;
    box-shadow: -8px -4px 8px 0px #ffffff73;
  }

  .CheckText:before {
    position: relative;
    content: 'Unchecked';
    margin-left: 20px;
    font-size: 20px;
    color: #a6a6a6;
    letter-spacing: 1px;
    float: right;
    width: 112px;
  }

  .CheckText.check:before {
    content: 'Checked';
    color: #3498db;
  }

  .box {
    position: relative;
    width: 66px;
    height: 66px;
    /* background-color: black; */
    border-radius: 50%;
    overflow: hidden;
  }

  .box::before {
    content: "";
    position: absolute;
    inset: -10px 23px;
    background: linear-gradient(315deg, green, yellow);
    transition: 0.5s;
    animation: animate 4s linear infinite;
  }

  .box:hover::before {
    inset: -20px, 0px;
  }

  @keyframes animate {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .box::after {
    content: "";
    position: absolute;
    inset: 6px;
    /* background: rgb(5, 5, 140); */
    border-radius: 50%;
    z-index: 1;
  }

  .image-content {
    position: absolute;
    inset: 4px;
    border: 1px;
    z-index: 3;
    border-radius: 50%;
    overflow: hidden;
  }

  .image-content img {
    position: absolute;
    top: 0px;
    left: .6px;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .shadow:before {
    content: "";
    position: absolute;
    inset: 0;
    transform: translate3d(0, 0, -1px);
    background: linear-gradient(315deg, #ff6632, #f6f9f6, #12bf24);
    filter: blur(5px);
  }


  .profile-greeting .confetti {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
  }

  .profile-greeting .confetti-piece {
    position: absolute;
    width: 15px;
    height: 15px;
    top: 100%;
    opacity: 0;
    border-radius: 10px 50px 35px 20px;
    -webkit-animation: makeItRain 5s infinite ease-out;
    animation: makeItRain 5s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(1) {
    left: 7%;
    -webkit-transform: rotate(-40deg);
    transform: rotate(-40deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(2) {
    left: 14%;
    -webkit-transform: rotate(4deg);
    transform: rotate(4deg);
    -webkit-animation: makeItRain 7s infinite ease-out;
    animation: makeItRain 7s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(3) {
    left: 21%;
    -webkit-transform: rotate(-51deg);
    transform: rotate(-51deg);
    -webkit-animation: makeItRain 5s infinite ease-out;
    animation: makeItRain 5s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(4) {
    left: 28%;
    -webkit-transform: rotate(61deg);
    transform: rotate(61deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(5) {
    left: 35%;
    -webkit-transform: rotate(-52deg);
    transform: rotate(-52deg);
    -webkit-animation: makeItRain 5s infinite ease-out;
    animation: makeItRain 5s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(6) {
    left: 42%;
    -webkit-transform: rotate(38deg);
    transform: rotate(38deg);
    -webkit-animation: makeItRain 4s infinite ease-out;
    animation: makeItRain 4s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(7) {
    left: 49%;
    -webkit-transform: rotate(11deg);
    transform: rotate(11deg);
    -webkit-animation: makeItRain 8s infinite ease-out;
    animation: makeItRain 8s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(8) {
    left: 53%;
    -webkit-transform: rotate(49deg);
    transform: rotate(49deg);
    -webkit-animation: makeItRain 7s infinite ease-out;
    animation: makeItRain 7s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(9) {
    left: 58%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(10) {
    left: 63%;
    -webkit-transform: rotate(10deg);
    transform: rotate(10deg);
    -webkit-animation: makeItRain 5s infinite ease-out;
    animation: makeItRain 5s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(11) {
    left: 68%;
    -webkit-transform: rotate(4deg);
    transform: rotate(4deg);
    -webkit-animation: makeItRain 8s infinite ease-out;
    animation: makeItRain 8s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(12) {
    left: 73%;
    -webkit-transform: rotate(42deg);
    transform: rotate(42deg);
    -webkit-animation: makeItRain 4s infinite ease-out;
    animation: makeItRain 4s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(13) {
    left: 78%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(14) {
    left: 80%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(15) {
    left: 84%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(16) {
    left: 89%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(17) {
    left: 91%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .profile-greeting .confetti-piece:nth-child(18) {
    left: 93%;
    -webkit-transform: rotate(-72deg);
    transform: rotate(-72deg);
    -webkit-animation: makeItRain 6s infinite ease-out;
    animation: makeItRain 6s infinite ease-out;
  }

  .addAnimation .profile-greeting .confetti-piece:nth-child(odd) {
    background: var(--clr);
  }

  .profile-greeting .confetti-piece:nth-child(even) {
    z-index: 1;
  }

  .profile-greeting .confetti-piece:nth-child(4n) {
    width: 5px;
    height: 12px;
  }

  .profile-greeting .confetti-piece:nth-child(3n) {
    width: 3px;
    height: 10px;
  }

  .addAnimation .profile-greeting .confetti-piece:nth-child(4n-7) {
    background: var(--clr);
  }

  @-webkit-keyframes makeItRain {
    from {
      opacity: 0;
    }

    50% {
      opacity: 1;
    }

    to {
      -webkit-transform: translateY(-350px);
    }
  }

  /* //dashbord style  */
  .col-dash {
    cursor: pointer;
    background:
      linear-gradient(95deg, var(--clr) 0%, var(--clrs) 100%),
      linear-gradient(95deg, var(--clr) 0%, var(--clrs) 100%) bottom;
    background-size: 100% 15px;
    background-repeat: no-repeat;
    transition: background .1s cubic-bezier(0.42, 0, 0.44, 0.62);


  }



  .col-dash:hover {
    cursor: pointer;
    background: linear-gradient(269deg, var(--clr) 0%, var(--clrs) 100%);
    box-shadow: 0 0 20px var(--clrs);

  }

  .col-dash:hover+.col-15>span {
    background: white;
    /* Change to the desired background color */
    color: black;
    /* Change to the desired text color */
  }

  .col-dash:before {
    content: "";
    position: absolute;
    inset: 5px;
    background: white;
    border-radius: 6px;
    /* filter: blur(8px); */

  }

  .col-dash:hover+.profile-greeting .confetti {
    animation: none;
  }

  .col-15>span {
    font-size: 57px;
    background: linear-gradient(269deg, var(--clr) 0%, var(--clrs) 100%);
    -webkit-background-clip: text;
    -moz-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .mb-112 {
    font-family: 'Protest Guerrilla', sans-serif;

  }


  .addAnimation {

    display: flex;
  }


  .col-dash .card-body {

    position: relative;
    z-index: 1;
  }

  .col-dash .i {
    position: absolute;
    inset: 0px;
    display: block;
  }

  .col-dash .i::before {
    content: '';
    position: absolute;
    top: 0;
    left: 80%;
    width: 15px;
    height: 5px;
    background: #f7f8fa;
    transform: translateX(-50%) skewX(325deg);
    transition: .5s;

  }

  .col-dash:hover .i::before {
    width: 40px;
    left: 20%;
  }

  .col-dash .i::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 20%;
    width: 15px;
    height: 5px;
    background: #f7f8fa;
    transform: translateX(-50%) skewX(325deg);
    transition: .5s;

  }

  .col-dash:hover .i::after {
    width: 40px;
    left: 80%;
  }

  .hiddenAnimation {
    display: none;
  }
  </style>

</head>