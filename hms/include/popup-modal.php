<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover data-tables">

                    <form method="post" name="submit">

                        <tr>
                            <th>Blood Pressure :</th>
                            <td>
                                <input name="bp" placeholder="Blood Pressure" class="form-control wd-450"
                                    required="true">
                            </td>
                        </tr>
                        <tr>
                            <th>Blood Sugar :</th>
                            <td>
                                <input name="bs" placeholder="Blood Sugar" class="form-control wd-450" required="true">
                            </td>
                        </tr>
                        <tr>
                            <th>Weight :</th>
                            <td>
                                <input name="weight" placeholder="Weight" class="form-control wd-450" required="true">
                            </td>
                        </tr>
                        <tr>
                            <th>Body Temprature :</th>
                            <td>
                                <input name="temp" placeholder="Blood Sugar" class="form-control wd-450"
                                    required="true">
                            </td>
                        </tr>

                        <tr>
                            <th>Prescription :</th>
                            <td>
                                <textarea name="pres" placeholder="Medical Prescription" rows="12" cols="14"
                                    class="form-control wd-450" required="true"></textarea>
                            </td>
                        </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>