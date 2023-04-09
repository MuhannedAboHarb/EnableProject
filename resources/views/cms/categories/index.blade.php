@extends('cms.parent')

@section('title', '')
@section('page-big-title', '')
@section('page-main-title', '')
@section('page-sub-title', '')


@section('styles')
    
@endsection



@section('content')
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Responsive Hover Table</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores tempora consequuntur nobis est delectus labore modi ex architecto, exercitationem, dolorem beatae cumque corporis, ipsam quia praesentium porro veritatis aliquid perferendis.
            
                          </p>
                          <div class="niceman">
                            <header>
                              <nav>
                                <ul>
                                  <li>About</li>
                                </ul>
                              </nav>
                            </header>
                          </div>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Visible</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Settings</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- <span class="tag tag-success">Approved</span> --}}
                      @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                     <td> <span class="badge @if ($category->status) bg-success @else bg-danger @endif">{{$category->visibility}}</span></td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td>
                          <div class="btn-group">
                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" onclick="confirmDestroy('{{$category->id}}',this)" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content --> 
@endsection


@section('scripts')
    <script>
      function confirmDestroy(id,reference){
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
                if (result.isConfirmed) {
                  destroy(id,reference);
                }
              })
      }


      function destroy(id,reference){
        //JS Axios
        // Make a request for a user with a given ID
        axios.delete('/cms/admin/categories/'+id)
            .then(function (response) {
              // handle success
              console.log(response);
              reference.closest('tr').remove();
              showMessage(response.data);
          })
            .catch(function (error) {
              // handle error
              console.log(error);
              showMessage(error.response.data);
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