<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    @include('admin.navbar')
      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <div class="container mt-5">

            <div class="card">
                <div class="card-header bg-dark text-white">
                    Appointments
                </div>
                <div class="card-body">
                    @foreach ($appointment as $appointment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$appointment->name}}</h5>
                            <p class="card-text"><i class="fas fa-envelope"></i> {{$appointment->email}}</p>
                            <p class="card-text"><i class="fas fa-phone"></i> {{$appointment->phone}}</p>
                            <p class="card-text"><i class="fas fa-user-md"></i> {{$appointment->doctor}}</p>
                            <p class="card-text"><i class="far fa-calendar-alt"></i> {{$appointment->date}}</p>
                            <p class="card-text"><i class="fas fa-comment"></i> {{$appointment->message}}</p>
                            <span class="status-badge badge {{$appointment->status == 'In progress' ? 'badge-primary' : ($appointment->status == 'Approved' ? 'badge-success' : 'badge-danger')}}">
                                {{$appointment->status == 'In progress' ? 'In Progress' : ($appointment->status == 'Approved' ? 'Approved' : 'Canceled')}}
                            </span>
                        </div>
                        <div class="card-footer">
                            <a onclick="return confirm('Are you sure to approve this appointment?')" href="{{url('approve',$appointment->id)}}" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> Approve
                            </a>
                            <a onclick="return confirm('Are you sure to cancel this appointment?')" href="{{url('cancel',$appointment->id)}}" class="btn btn-danger">
                                <i class="fas fa-times-circle"></i> Cancel
                            </a>
                            <a href="{{url('emailView',$appointment->id)}}" class="btn btn-primary">
                                <i class="far fa-envelope"></i> Send Mail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
       
        </div>
        

      </div>
  
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script') 
  </body>
</html>