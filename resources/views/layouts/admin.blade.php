<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <title>TRMS Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ elixir('dist/admin.css') }}">
    <script src="{{ elixir('dist/admin.js') }}"></script>
</head>
<body>
    



    <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xs-6">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="">Exhibit Partners Event Mailer</a></h1>
                  </div>
               </div>
              
               <div class="col-xs-6">

               

               @if(Auth::check())
                  <div class="navbar navbar-inverse" role="banner">
                      <nav class="navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}<b class="caret"></b></a>
                            <ul class="dropdown-menu animated fadeInUp">
                              <!-- <li><a href="profile.html">Login</a></li> -->
                              <li><a href="{{url('logout')}}">Logout</a></li>
                            </ul>
                          </li>
                        </ul>
                      </nav>
                  </div>
                @endif  

              
               </div>
            </div>
         </div>
    </div>

    <div class="page-content">
        <div class="row">
          <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <p class="nav-collapser visible-sm visible-xs"><i class="glyphicon glyphicon-th-list" data-toggle="collapse" data-target=".nav.collapse" ></i></p>
                
                <ul class="nav hidden-sm hidden-xs">
                    @include('includes.admin-nav')
                </ul>

                <ul class="nav collapse hidden-md">
                    @include('includes.admin-nav')
                </ul>

             </div>
          </div>
          <div class="col-md-10">
            
                <div class="col-sm-12 content-box-large">
    
                  <div class="content-box-header">
                      
                      <div class="row">
                          
                          <div class="col-sm-6 title">
                
                              <h3>
                                @yield('title','')
                
                              </h3>

                          </div>
                      
                          <div class="col-sm-4">

                              @yield('search','')
                          
                          </div>

                          <div class="col-sm-2 ">
                            
                              @yield('action','')

                          </div>

                      </div>

                  </div>


                  @include('includes/flash')

                  
                  <div class="row">
                      
                      <div class="col-sm-12">
                        
                        @yield('content','')
                      
                      </div>

                  </div>

              </div>
 
        </div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright {{ Carbon\Carbon::now()->format('Y') }} <a href='http://www.exhibitpartners.com'>Exhibit Partners</a>
            </div>
            
         </div>
      </footer>
  </body>
</html>



