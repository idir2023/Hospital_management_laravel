<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')

    <div class="container-fluid page-body-wrapper">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        {{-- <div class="card-header bg-primary text-white">
                            <h2 class="mb-0 text-center"><i class="fas fa-user-md"></i> Add Doctor</h2>
                        </div> --}}
                        @if(session('message'))
                        <div class="alert alert-success"> {{session('message')}}</div>
                        @endif
                        <div class="card-body">
                            <form method="post" action="{{url('upload_doctor')}}" enctype="multipart/form-data">
                                @csrf
        
                                <div class="form-group">
                                    <label for="name"><i class="fas fa-user"></i> Doctor Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter doctor's name">
                                </div>
                                <div class="form-group">
                                    <label for="number"><i class="fas fa-phone"></i> Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter contact number">
                                </div>
                                <div class="form-group">
                                    <label for="speciality"><i class="fas fa-stethoscope"></i> Specialty</label>
                                    <select class="form-control" id="speciality" name="speciality">
                                        <option value="cardiologist">Cardiologist</option>
                                        <option value="orthopedic">Orthopedic</option>
                                        <option value="dermatologist">Dermatologist</option>
                                        <option value="neurologist">Neurologist</option>
                                        <!-- Add more specialty options as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="room"><i class="fas fa-bed"></i> Room No</label>
                                    <input type="text" class="form-control" id="room" name="room" placeholder="Enter room number">
                                </div>
                                <div class="form-group">
                                    <label for="image"><i class="fas fa-image"></i> Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-check"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
   
    @include('admin.script') 
  </body>
</html>