<div class="modal fade" id="modal-form-koperasi" role="dialog" aria-labelledby="addOrgLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 60%; height: 100%">
        <div class="card card-wizard" id="wizardCardReset">
            <form id="form-koperasi" method="POST" action="" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="header text-center">
                    <h3 class="title" id="title-form"></h3>
                </div>
                <input type="hidden" class="form-control"  name="id" required="true" id="input-id">
                <div class="content">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 ">
                            <div class="form-group">
                                <label for="id_" class="control-label">Nama <star>*</star></label>
                                <input type="text" class="form-control"  name="name" required="true" id="input-name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 ">
                            <div class="form-group">
                                <label for="id_" class="control-label">End Point <star>*</star></label>
                                <input type="text" class="form-control"  name="end_point" required="true" id="input-end-point">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-fill pull-right" style="margin-bottom: 2.5%" >Simpan</button>
                <button data-dismiss="modal"   class="btn btn-secondary btn-fill pull-right" style="margin-bottom: 2.5%" >Cancel</button>
                <div class="clearfix"></div>

            </form>

        </div>
    </div>
</div>