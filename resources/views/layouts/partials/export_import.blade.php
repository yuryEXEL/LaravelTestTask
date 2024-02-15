<div class="d-flex justify-content-between">
    <a class="btn btn-warning" href="{{ route('users.export') }}">Export User</a>
    <a href="{{ asset('file/example.csv') }}" class="btn btn-primary">Download Example</a>
    <form id="uploadForm" enctype="multipart/form-data" class="ml-auto">
        @csrf
        <div class="input-group">
            <input type="file" name="file" class="form-control" id="upload_file">
            <div class="input-group-append">
                <button class="btn btn-success btn-upload-submit" type="submit">Import User Data</button>
            </div>
        </div>
    </form>
</div>
<div id="errorMessage" class="text-center" style="color: red;"></div>
