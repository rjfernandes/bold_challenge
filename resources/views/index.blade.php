@extends('layout')
@section('title', 'Search Reviews')
@section('content')
    <div class="appHeader">
        <a href="/download" class="linkColor">Go to Update Apps Page</a>
    </div>
    <div class="row" ng-controller="ReviewController">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Search:</span>
                        </div>
                        <input type="text" class="form-control" ng-model="searchText" />
                    </div>
                </div>
                <div class="col-md-2" ng-show="reviews.length > 0 && filteredReviews.length !== reviews.length">
                    <button type="button" ng-click="clearFilter()" class="btn btn-dark col-md">Clear filter</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div ng-hide="slugs.length">
                        <div class="alert alert-warning">
                            There are no apps
                        </div>
                        <div><a href="/download" class="downloadLink linkColor">Click here to start download reviews</a></div>
                    </div>
                    <div class="nav flex-column nav-pills">
                        <a ng-repeat="slug in slugs" href="javascript:void(0)" ng-click="downloadAppReviews(slug)" ng-class="{'active': slug == currentSlug}" class="nav-link">@{{ slug }}</a>
                    </div>
                </div>
                
                <div class="col-md">
                    <p class="amountReviews" ng-show="reviews">
                        @{{ reviews.length === 1 ? 'There is' : 'There are' }} <strong>@{{ reviews.length }}</strong> @{{ reviews.length === 1 ? 'review' : 'reviews' }} for <strong>@{{ currentSlug }}</strong>.
                    </p>
                    <table class="table">
                        <tr>
                            <th>Shopify Domain</th>
                            <th>Current Review</th>
                            <th>Past Review</th>
                            <th>Created At</th>
                        </tr>

                        <tbody>
                            <tr ng-repeat="review in filteredReviews = (reviews | filter:searchText) | orderBy: review.created_at">
                                <td>@{{ review.shopify_domain }}</td>
                                <td class="score">@{{ review.star_rating }}</td>
                                <td class="score">@{{ review.previous_star_rating || '-' }}</td>
                                <td>@{{ formatDate(review.created_at) }}</td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="alert alert-warning" ng-hide="reviews">
                        <i class="fa fa-spin"></i> Requesting...
                    </div>
                    <div class="alert alert-warning" ng-show="reviews && filteredReviews.length === 0">
                        No Results
                    </div>
                    <div class="alert alert-danger" ng-show="errorMessage">
                        <i class="fa fa-exclamation-circle"></i> @{{ errorMessage }}
                    </div>
                </div>
            </div>
            

        </div>
    </div>
@endsection

@section('js_style')
    <style>
        .slug {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .active {
            background-color: #CE4533 !important;
            font-weight: bold;
        }
        a.nav-link {
            color: #000;
        }
        a.downloadLink {
            font-size: 13px;
            display:block;
            text-align: center;
        }
        .score {
            text-align: center;
        }
        .amountReviews {
            color: #CE4533;
        }
    </style>
    <script src="/app.js"></script>
@endsection