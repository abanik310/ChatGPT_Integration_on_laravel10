
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chat GPT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Main Sidebar Container -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          <div class="row">
              <div class="col text-right">
                  <a href="/logout" class="btn btn-primary btn-sm">Logout</a>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </div>
    <div class="container-fluid">
      <div class="card col-lg-12">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 style="margin:auto; font-size: xx-large" class="card-title">Hi <b>{{ session('name') }}</b></h3>
          </div>
        </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card-body" style="position: relative">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 style="text-align:center; font-size: x-large" class="card-title">Search for Anything</h3>
                </div>
              </div>
              <div class="card-body">
                <form method="post" action="/chat_gpt">
                  @csrf
                  <div class="input-group mb-3">
                      <input type="text" name="search_for" class="form-control" placeholder="Search for" required>
                      <div class="input-group-append">
                          <div class="input-group-text">
                          </div>
                      </div>
                  </div>
                  <div class="row justify-content-end">
                      <!-- /.col -->
                      <div class="col-4">
                          <button type="submit" class="btn btn-primary btn-block">Search</button>
                      </div>
                      <!-- /.col -->
                  </div>
                </form>              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <!-- Your first card content here -->
          <div class="card-body" style="position: relative">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 style="text-align:center; font-size: x-large" class="card-title">Result</h3>
                </div>
              </div>
              <div class="card-body">
                @if(session()->has('message'))
                    <p>{{ session('message') }}</p>
                @else
                    <p>No message available yet.</p>
                @endif
            </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
      <!-- /.container-fluid -->
  </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>
