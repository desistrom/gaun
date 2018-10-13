<form role="form">
  <div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
    <div class="panel ">
        <div class="panel-header" style="background-color:  #F5F5F5;">
          <div class="box-header with-border">
          <h3 class="box-title">Volume</h3>
        </div>
      </div>
      <div class="panel-body col col0md-6 col-sm-6 col-xs-12 ">
        <!-- textarea -->
        <div class="form-group">
          <label>Volume</label>
          <input type="text" name="volume" class="form-control new-input" placeholder="No Volume" id="volume">
          <div class="error" id="ntf_volume"></div>
        </div>
        <div class="form-group">
          <label>Jurnal</label>
          <select class="form-control new-input" name="journal" id="journal">
            <option value="">-- Pilih Journal --</option>
              <option value="">journal 1</option>
              <option value="">journal 2</option>
              <option value="">journal 3</option>
          </select>
          <div class="error" id="ntf_journal"></div>
        </div>
          <div class="box-footer">
                <button type="submit" class="btn btn-success btn-green pull-right ">Save</button>
              </div>
      </div>


    </div>
  </div>
</form>