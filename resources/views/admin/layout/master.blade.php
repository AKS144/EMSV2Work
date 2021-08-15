<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.includes.head')
    @yield('css')

    @include('admin.chat_app.chat_bubble_style')
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
.image-upload > input {
  visibility:hidden;
  width:0;
  height:0
}

.noActive{
color: #31708f !important;
background-color: #ffff;
}

.noActiveStatus{
color: #31708f !important;
background-color: #fff;
}

#gender_radio{
  #
}

.glyphicon.glyphicon-picture {
    font-size: 50px;
}


.preloader { 
  position: fixed; 
  top: 0; 
  left: 0; 
  width: 100%; 
  height: 100%; 
  z-index: 9999; 
  background-color: #fff; 
} 
.preloader .loading { 
  position: absolute; 
  left: 50%; 
  top: 50%; 
  transform: translate (-50%, - 50%); 
  font: 14px arial; 
} 

.modal-header{
  background:#eee; 
  color:#0000;
}

.modal-title{
  font-weight:bolder;
   text-transform:uppercase; 
   font-family: 'Times New Roman', Times, serif; 
   color:black;
}

table th{
  text-align:center;
  font-family: times new romans;
}

table td{
  text-align:center;
  font-family: times new romans;
}

</style>

  </head>
 
  <body class="nav-md ">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('/uploads/gallery/' .Auth::user()->image) }}" alt="..." height="50" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->first_name. ' '.Auth::user()->last_name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            @yield('css')
            <!-- sidebar menu -->
            @include('admin.includes.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('admin.includes.footer-menu')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('admin.includes.navigation')
        <!-- /top navigation -->

                  <div class = "preloader"> 
                  <div class = "loading"> 
                  <!-- <img src = "https://i.stack.imgur.com/MnyxU.gif" width = "80">  -->
                  <div class="fa fa-spinner fa-spin fa-5x" width = "200"></div>
                    <p> Please Wait </p> 
                    </div> 
                    </div> 
        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('admin.includes.footer')
        <!-- /footer content -->
      </div>
    </div>
 
    @yield('js')
    @include('admin.includes.scripts')
    @include('admin.includes.chat_script')



  </body>
</html>
