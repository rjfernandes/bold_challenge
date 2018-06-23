@extends('layout')
@section('title', 'Update Reviews')
@section('content')
    <div class="row" ng-controller="RequestReviewController">
        <div class="col-md-12">
            <div class="appHeader" ng-hide="isEditingTime">
                Theses apps will be update at each @{{ intervalTime }} minutes <a class="linkColor" href="javascript:void(0)" ng-click="openChangeTime()">(change)</a>
                <br />
                <small>
                    (keep this page opened to update reviews)
                </small>
            </div>
            <div class="row" ng-show="isEditingTime">
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-4">
                    <form ng-submit="saveIntervalTime()" class="box-form">
                        <div class="form-group">
                            <label><strong>Update Interval Time</strong></label>
                            <input type="number" class="form-control" placeholder="Interval time in minutes" ng-model="tmpIntervalTime">
                        </div>
                        <button type="submit" class="btn btn-primary" ng-enabled="!isSaving">
                            <i class="fa fa-cog fa-spin" ng-show="isSaving"></i> @{{ isSaving ? 'Updating...' : 'Update' }}
                        </button>
                        <button type="button" ng-click="cancelEditing()" class="btn btn-default" ng-enabled="!isSaving">
                            Cancel
                        </button>
                    </form>

                </div>
            </div>
            <div class="appHeader" ng-hide="isEditingTime">
                <a href="/" class="linkColor" target="_blank">Open Search Reviews Page</a>
            </div>
            <h4>Apps</h4>
            <ul>
                <li ng-repeat="slug in slugs track by $index">
                    <div ng-class="{'current' : $index == slugIndex, 'done': $index < slugIndex, 'toDo': $index > slugIndex }">
                        @{{ slug }} <i class="fa" ng-class="{'fa-cog fa-spin': $index == slugIndex, 'fa-check': $index < slugIndex}"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('js_style')
    <style>
        .toDo {
            color: #999;
        }
        .done {
            color: #006600;
        }
        .current {
            color: #000066;
            font-weight: bold;
        }
        .box-form {
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 1em
        }
    </style>
    <script src="/download/app.js"></script>
@endsection