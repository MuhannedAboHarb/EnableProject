@extends('cms.parent')

@section('title', '')
@section('page-big-title', 'Edit Categorey')
@section('page-main-title', 'Edit Categorey')
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
                  <h3 class="card-title">Edit Categorey</h3>
                </div> 
                <!-- /.card-header -->
                <!-- form start -->
                <form id="edit-form">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name </label>
                      <input type="text" class="form-control" value="{{$category->name}}"  id="name"  placeholder="Enter name">
                    </div>


                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" id="description" rows="3" placeholder="Enter ...">{{$category->description}}</textarea>
                    </div>
                    
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" 
                            @if ($category->status)
                              checked
                            @endif >
                        <label class="custom-control-label" for="status">Visible</label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="button"  onclick="update({{$category->id}})" class="btn btn-primary">Submit</button>
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
        function update(id){
            axios.put('/cms/admin/categories/'+id,{
              name: document.getElementById('name').value,
              description: document.getElementById('description').value,
              status: document.getElementById('status').checked,
            })
            .then(function (response) {
              console.log(response);
              document.getElementById('edit-form').reset();
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