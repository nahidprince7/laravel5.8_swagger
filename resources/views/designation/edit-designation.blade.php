<div class="modal fade" id="editModal{{$designation->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('designation/update/'.$designation->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Parent</label>
                        <select name="parent_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($designationList as $desigKey=>$designationL)
                                @if($desigKey == $designation->parent_id)
                                    <option value="{{$desigKey}}" selected>{{$designationL}}</option>
                                @else
                                    <option value="{{$desigKey}}">{{$designationL}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Designation Title</label>
                        <input type="text" value="{{$designation->title}}" name="designation_name" class="form-control"
                               placeholder="Enter Department Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Designation</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
