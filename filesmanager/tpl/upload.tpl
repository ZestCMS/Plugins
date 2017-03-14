<form method="post" action="{{ROOT}}admin/filesmanager/upload" enctype="multipart/form-data">
    <div>
        {{error}}{{success}}
        <label for="file">{{LANG.filesmanager_file_label}} :</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
        <input type="file" name="uploaded_file" id="uploaded_file" /><br />
    </div>
    <div class="buttons">
        <button type="submit" name="upload_file">{{LANG.form_submit}}</button>
    </div>
</form>
