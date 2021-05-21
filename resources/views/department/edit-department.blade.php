<div class="modal fade" id="editModal{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('department/update/'.$department->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
{{--                        <input type="text" value="{{$department->id}}" name="id" class="form-control" id="exampleInputEmail1" >--}}
                        <label for="exampleInputEmail1">Department Name</label>
                        <input type="text" value="{{$department->label}}" name="label" class="form-control" placeholder="Enter Department Name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Department</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
