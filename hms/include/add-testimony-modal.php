<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="addTestimony">Add Testimonials</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form role="form" name="addTestimony" method="post" enctype="multipart/form-data" onSubmit="return valid();">
                <div class="form-group">
                    <label for="witnessImage">Profile Pic</label>
                    <input type="file" class="form-control-file" id="witnessImage" name="witness_image">
                </div>
                <div class="form-group">
                    <label for="witnessName">Name</label>
                    <input type="text" class="form-control" id="witnessName" name="witness_name">
                </div>
                <div class="form-group">
                    <label for="witnessDesignation">Designation</label>
                    <input type="text" class="form-control" id="witnessDesignation" name="witness_designation">
                </div>
                <div class="form-group">
                    <label for="testimony_textarea">Testimonial</label>
                    <textarea class="form-control canvas-text-editor" name="testimony" id="testimony_textarea" cols="10" rows="10" placeholder="Type here..."></textarea>
                    <div id="wordCountMessage" style="color: red; margin-top: 5px;"></div>
                </div>
                <div class="form-group">
                    <label for="rating">Rating (1-5)</label>
                    <input type="number" class="form-control" id="rating" name="rating" max="5" min="0">
                </div>
                <div class="modal-footer testimony-footer">
                    <button type="button" class="btn btn-o btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="testimony_submit" id="testimony_submit" class="btn btn-o btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </div> -->