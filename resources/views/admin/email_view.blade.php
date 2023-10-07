<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
  @include('admin.css')
<style>
  .container{
    margin-top: 60px;
    width: 60%;

  }
  input{
  color: black;
    
  }
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
      <!-- partial -->
        <!-- partial:partials/_navbar.html -->
    @include('admin.navbar')
    <div class="container">
        <div class="container mt-5">
            <div class="email-container">
              @if(session('message'))
              <script>
                alert({{ session('message')}});
              </script>
              @endif
                <form action="{{url('sendemail',$data->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="greeting">Greeting:</label>
                        <input type="text" class="form-control" id="greeting" name="greeting" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea class="form-control" id="body" name="body" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="actiontext">Action Text:</label>
                        <input type="text" class="form-control" id="actiontext" name="actiontext" required>
                    </div>
                    <div class="form-group">
                        <label for="actionurl">Action URL:</label>
                        <input type="url" class="form-control" id="actionurl" name="actionurl" required>
                    </div>
                    <div class="form-group">
                        <label for="endpart">End Part:</label>
                        <textarea class="form-control" id="endpart" name="endpart" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                </form>
            </div>
        
        </div>
        </div>

    @include('admin.script') 
  </body>
</html>