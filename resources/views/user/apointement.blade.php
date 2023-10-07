<div class="page-section">
    <div class="container">
      @if(session('message'))
      <script>
          alert("{{ session('message') }}");
      </script>
  @endif
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <form class="main-form" action="{{ url('appoitement') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5">
            <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                <input type="text" class="form-control" name="name" placeholder="Full name">
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                <input type="text" class="form-control" name="email" placeholder="Email address..">
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                <input type="date" class="form-control" name="date">
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                <select name="doctor" id="doctor" class="custom-select">
                    <option value="">--select doctor--</option>
                    @foreach($doctor as $doctor)
                        <option value="{{ $doctor->name }}">{{ $doctor->name }}---Speciality---{{ $doctor->specialty }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                <input type="text" class="form-control" placeholder="Number.." name="phone">
            </div>
            <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
    </form>
    
    </div>
  </div>