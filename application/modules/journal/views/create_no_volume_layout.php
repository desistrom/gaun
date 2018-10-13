<form role="form">
<div class="col col-md-12 col-sm-12 col-xs-12" style="padding-top: 1em;">
  <div class="panel ">
      <div class="panel-header" style="background-color:  #F5F5F5;">
        <div class="box-header with-border">
        <h3 class="box-title">Volume</h3>
      </div>
    </div>
    <div class="panel-body col col-md-6 col-sm-6 col-xs-12">
      <!-- textarea -->
      <div class="form-group">
        <label>No Volume</label>
        <input type="text" name="noro" class="form-control new-input" placeholder="No Volume" id="nomor">
        <div class="error" id="ntf_volume"></div>
      </div>
      <div class="form-group">
        <label>Jurnal</label>
        <select class="form-control new-input" name="journal" id="journal">
          <option value="">-- Pilih Journal --</option>
            <option value="#">journal 1</option>
            <option value="#">journal 1</option>
            <option value="#">journal 1</option>
        </select>
        <div class="error" id="ntf_journal"></div>
      </div>
      <div class="form-group">
        <label>Volume</label>
        <select class="form-control new-input" name="volume" id="volume">
          <option value="">-- Pilih Volume --</option>
          <option value="">volume 1</option>
          <option value="">volume 1</option>

        </select>
        <div class="error" id="ntf_volume"></div>
      </div>
       <div class="box-footer">
                <button type="submit" class="btn btn-success btn-green pull-right ">Save</button>
              </div>
    </div>


</div>
</div>
  </form>