<div class="modal fade needhelpModal" id="needHelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-tools mr-2"></i>Need Help
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_type" value="2">
                    <label for="problem">Title</label>
                    <input type="text" class="form-control" name="title"/>
    
                    <label for="problem">Vehicle Type</label>
                    <select name="vehicle_type_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($vehicletypes as $vehicle_type)
                            <option value="{{ $vehicle_type->id }}">{{ $vehicle_type->type }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="city"><input type="text" name="district">

                    <label for="problem">Problem</label>
                    <input type="text" class="form-control" name="problem"/>

                    <label for="inputImages" class="mt-2">Image File <small>(Max size : 2MB)</small></label>
                    <input type="file" class="form-control" id="customFile" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
            </form>
          </div>
    </div>
</div>