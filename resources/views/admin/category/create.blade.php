@extends('app.master')
@section('title','Create Category')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.css" integrity="sha512-iVAPZRCMdOOiZWYKdeY78tlHFUKf/PqAJEf/0bfnkxJ8MHQHqNXB/wK2y6RH/LmoQ0avRlGphSn06IMMxSW+xw==" crossorigin="anonymous" referrerpolicy="no-referrer" />@endpush
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="row" style="justify-content: center;">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Category</h4>
                    <p class="card-description"> Enter Category Details </p>
                    <form id="create_category" class="forms-sample" action="{{route('admin.category.store')}}">
                      <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-4" style="align-content: center;">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="status" id="statusRadios1" value="1" checked=""> Active <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-5" style="align-content: center;">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="status" id="statusRadios2" value="2"> Inactive <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="parent_category">Parent Category</label>
                        <select class="w-100" id="parent_category" name="parent_category" placeholder="Select Parent Category">
                            <option selected value="">None</option>
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>                      
                        </div>
                      <button type="submit" class="btn btn-primary me-2" id="submit_form" style="float: right">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.js" integrity="sha512-jfp1Gv+A3dHho9qOUUWOrZA6NWR08j7GYVn8VXcRI0FsDb3xe0hQHVwasi2UarjZzPYOxT5uvmlHrWLXQ+M4AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#parent_category').select2();
    });
    $("#create_category").on('submit', function(e){
        e.preventDefault();
        if(!$("#name").val().trim()){
            Toast.fire({
                icon: "error",
                title: "Please Enter category name."
            });
            return;
        }
        $.ajax({
            type: 'POST',
            url: '{{route("admin.category.store")}}',
            data: {
                name: $("#name").val(),
                status: $('[name="status"]:checked').val(),
                parent_id: $('#parent_category').val()
            },
            dataType: 'json',
            beforeSend: function() {
                $('#submit_form').html("Please Wait....");
                $('#submit_form').attr('disabled','')
            },
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
                    $('#submit_form').removeAttr('disabled')
                    $('#submit_form').html('Submit');
                    Toast.fire({
                        icon: "error",
                        title: response.message
                    });
                }
            },
            error: function(xhr, status, error){
                $('#submit_form').text('Submit');
                $('#submit_form').removeAttr('disabled');
                Toast.fire({
                    icon: "error",
                    title: "Something went wrong, Please try again."
                });
            }
        })
    });
</script>
@endpush