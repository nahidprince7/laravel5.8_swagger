<div class="modal fade" id="editModal{{$division->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Division</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('division/update/'.$division->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        {{--                        <input type="text" value="{{$department->id}}" name="id" class="form-control" id="exampleInputEmail1" >--}}
                        <label >Division Name</label>
                        <input type="text" value="{{$division->label}}" name="label" class="form-control" placeholder="Enter Department Name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Division</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
