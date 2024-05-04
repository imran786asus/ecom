@extends('app.master')
@section('title','Category List')
@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />
@endpush
@section('content')
{{-- <table id="table_id" class=".table-striped ">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table> --}}
<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-description" style="display: ruby-text;">
                <h4 class="card-title">Category List</h4>
                <a href="{{route('admin.category.create')}}" class="btn btn-primary btn-icon-text">
                <i class="ti-plus btn-icon-prepend"></i> Add Category </a>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> Name </th>
                    <th> Status </th>
                    <th> Parent Category </th>
                    <th> Created date </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($categories))
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->status == 1 ? 'Active':'Inactive'}}</td>
                        <td>{{$category->parent_category->name ?? 'Not Available'}}</td>
                        <td> {{date('d-m-Y',strtotime($category->created_at))}} </td>
                        <td>
                            <a type="button" class="btn btn-success btn-icon btn-sm" href="{{route('admin.category.edit',$category->id)}}">Edit<i class="ti-pencil" style="margin-left: 4px;"></i></a>
                            <button type="button" class="btn btn-success btn-icon btn-sm" onclick="deleteCategory(this)" data-url="{{route('admin.category.destroy',$category->id)}}">Delete<i class="ti-trash" style="margin-left: 4px;"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">No Categories Found</td>
                    </tr>
                    @endif
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {!! $categories->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });
    function deleteCategory(item){
        let url = $(item).data('url');
        console.log(url);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    dataType: 'json',
                    success: function(response){ 
                        if(response.status == 200){
                            Toast.fire({
                                icon: "success",
                                title: response.message
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        }else{
                            Toast.fire({
                                icon: "error",
                                title: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        Toast.fire({
                            icon: "error",
                            title: "Something went wrong, Please try again."
                        });
                    }
                });
            }
        });
    }
</script>
@endpush