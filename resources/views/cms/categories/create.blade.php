@extends('cms.parent')

@section('title', '')
@section('page-big-title', 'Create Categorey')
@section('page-main-title', 'Create Categorey')
@section('page-sub-title', 'Categoreies')


@section('styles')
    
@endsection



@section('content')
       <!-- Main content -->
       <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Create Categorey</h3>
                </div> 
                <!-- /.card-header -->
                <!-- form start -->
                <form id="create-form">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name </label>
                      <input type="text" class="form-control"  id="name"  placeholder="Enter name">
                    </div>


                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" id="description" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status">
                        <label class="custom-control-label" for="status">Visible</label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="button"  onclick="store()" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) --> 
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection


@section('scripts')
    <script>
        function store(){
            axios.post('/cms/admin/categories',{
              name: document.getElementById('name').value,
              description: document.getElementById('description').value,
              status: document.getElementById('status').checked,
            })
            .then(function (response) {
              console.log(response);
              document.getElementById('create-form').reset();
              toastr.success(response.data.message);
            })
            .catch(function (error) {
              console.log(error);
              toastr.error(error.response.data.message);
            });
        }

        function showMessage(data){
          Swal.fire({
            // position: 'top-end',
            icon: data.icon,
            title: data.title,
            showConfirmButton: false,
            timer: 1500
        })        
      }
    </script>
@endsection