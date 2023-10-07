<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
  @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    @include('admin.navbar')


    <div class="container-fluid page-body-wrapper">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        
                        @if(isset($doctor))
                        <div class="card-body">
                           
                            <form method="post" action="{{ url('editdoctor',$doctor->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <img src="doctorimage/{{ $doctor->image }}" height="100px" width="100px"  alt="">
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    <img src="{{ asset('path_to_image_folder/' . $doctor->image) }}" alt="Doctor Image" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="name"><i class="fas fa-user"></i> Doctor Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="number"><i class="fas fa-phone"></i> Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $doctor->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="speciality"><i class="fas fa-stethoscope"></i> Speciality</label>
                                    <select class="form-control" id="speciality" name="speciality">
                                        <option value="cardiologist" @if($doctor->speciality == 'cardiologist') selected @endif>Cardiologist</option>
                                        <option value="orthopedic" @if($doctor->speciality == 'orthopedic') selected @endif>Orthopedic</option>
                                        <option value="dermatologist" @if($doctor->speciality == 'dermatologist') selected @endif>Dermatologist</option>
                                        <option value="neurologist" @if($doctor->speciality == 'neurologist') selected @endif>Neurologist</option>
                                        <!-- Add more specialty options as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="room"><i class="fas fa-bed"></i> Room No</label>
                                    <input type="text" class="form-control" id="room" name="room" value="{{ $doctor->room }}">
                                </div>
                               
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-check"></i> Update
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>        
    </div>
   
    @include('admin.script') 
  </body>
</html>