@extends('admin.layout')
@section('section')
    <form class="py-4">

        <div class="mx-auto border py-5 px-4" style="width: 36rem; border-radius: 0.9rem;">
            <div class="text-h6 text-capitalize my-2">Add new branch</div>
            <div class="py-2 px-0">
                <input type="text" name="branch_name" class="form-control" placeholder="Branch Name">
            </div>
            <div class="py-2 px-0">
                <select name="branch_region" class="form-control">
                    <option>Region</option>
                </select>
            </div>
            <div class="py-2">
                <select name="branch_town" class="form-control">
                    <option>Town</option>
                </select>
            </div>
            <div class="py-2 px-0">
                <select name="branch_street" class="form-control">
                    <option>Street</option>
                </select>
            </div>
            <div class="py-2 px-0">
                <select name="branch_manager" class="form-control">
                    <option>Managed By</option>
                </select>
            </div>
            <div class="px-2 py-2">
                <input type="tel" name="branch_phone" class="form-control input-flied telephone" placeholder="Business Phone">
            </div>
            <div class="py-2 d-flex">
                <button type="submit" class="btn-primary btn-sm mx-3">save</button>
                <a href="{{ URL::previous() }}" class="btn-light btn-sm mx-3">cancel</a>
            </div>
        </div>

    </form>
@endsection