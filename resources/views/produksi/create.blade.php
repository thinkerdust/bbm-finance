@extends('index')

@section('title', 'Produksi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <form method="post" action="https://material-dashboard-laravel.creative-tim.com/profile" autocomplete="off" class="form-horizontal">
            <input type="hidden" name="_token" value="68FXrTswX9VLwXi6eggy6mieqLibRwrJ7H0HlN97">            
            <input type="hidden" name="_method" value="put">
            <div class="card ">
                <div class="card-header card-header-success">
                <h4 class="card-title">Edit Profile</h4>
                <p class="card-category">User information</p>
                </div>
                <div class="card-body ">
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-7">
                    <div class="form-group">
                        <input class="form-control" name="name" id="input-name" type="text" placeholder="Name" value="Admin Admin" required="true" aria-required="true"/>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-7">
                    <div class="form-group">
                        <input class="form-control" name="email" id="input-email" type="email" placeholder="Email" value="admin@material.com" required />
                                            </div>
                    </div>
                </div>
                </div>
                <div class="row card-footer ml-auto mr-auto">
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" onclick="window.history.back()">Cancel</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection