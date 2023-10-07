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
        <!-- partial:partials/_navbar.html -->
    @include('admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="container mt-5">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Doctor Name</th>
                            <th>Phone</th>
                            <th>Speciality</th>
                            <th>Room No</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctor as $doctor)
                        <tr>
                            <td style="color: beige"><img src="doctorimage/{{$doctor->image}}" alt=""> </td>
                            <td style="color: beige">{{$doctor->name}}</td>
                            <td style="color: beige">{{$doctor->phone}}</td>
                            <td style="color: beige">{{$doctor->specialty}}</td>
                            <td style="color: beige">{{$doctor->room}}</td>
                            <td style="color: beige">
                                <a href="{{url('Update_doctor',$doctor->id)}}" class="btn btn-outline-success">
                                    <i class="fas fa-check-circle"></i> Update
                                </a>
                            </td>
                            <td style="color: beige">
                                <a onclick="return confirm('Are you sure to delete this?')" href="{{url('delete_doctor',$doctor->id)}}" class="btn btn-outline-danger">
                                    <i class="fas fa-times-circle"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script') 
  </body>
</html>