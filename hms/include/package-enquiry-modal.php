<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="addTestimony">Package Enquiry</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="packageEnquiryForm">
                <div class="row cf-ro">
                    <div class="col-sm-3"><label>Enter Name :</label></div>
                    <div class="col-sm-8"><input type="text" placeholder="Enter Name" name="name"
                            class="form-control input-sm" required></div>
                </div>
                <div class="row cf-ro">
                    <div class="col-sm-3"><label>Email Address :</label></div>
                    <div class="col-sm-8"><input type="text" name="email" placeholder="Enter Email Address"
                            class="form-control input-sm" required></div>
                </div>
                <div class="row cf-ro">
                    <div class="col-sm-3"><label>Mobile Number:</label></div>
                    <div class="col-sm-8"><input type="text" name="contact_no" placeholder="Enter Mobile Number"
                            class="form-control input-sm" required></div>
                </div>
                <div class="row cf-ro">
                    <div class="col-sm-3"><label>Package For Enquiry:</label></div>
                    <div class="col-sm-8">
                        <select name="enquiry_on_package" class="form-control" required="true">
                            <option value="">Select Package</option>
                            <?php $ret=mysqli_query($con,"select * from packages");
                            while($row=mysqli_fetch_array($ret))
                            {
                            ?>
                            <option
                                value="<?php echo htmlentities($row['id']);?>">
                                <?php echo htmlentities($row['specialization'] .' - '. $row['treatmentName']);?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row cf-ro">
                    <div class="col-sm-3"><label>Enquiry Note:</label></div>
                    <div class="col-sm-8">
                        <textarea rows="5" placeholder="Enter Your Message" class="form-control input-sm"
                            name="enquiry_note" required></textarea>
                    </div>
                </div>
                <div class="row cf-ro">
                    <div class="col-sm-3"><label></label></div>
                    <div class="col-sm-8">
                        <button class="btn btn-success btn-sm" type="submit" name="enquiry_submit">Submit Enquiry</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </div> -->