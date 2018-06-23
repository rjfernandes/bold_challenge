app.controller('ReviewController', function($scope, $http) {
    $scope.searchText = '';
    $scope.errorMessage = null;
    $scope.slugs = {!! $slugs !!};
    $scope.currentSlug = '{!! $currentSlug !!}';
    $scope.reviews = {!! $reviews !!};
    
    $scope.formatDate = function (date) {
        return moment(date).format('MM/DD/YYYY HH:mm:ss');
    }

    $scope.clearFilter = function() {
        $scope.searchText = '';
    }

    $scope.downloadAppReviews = function(slug) {
        $scope.currentSlug = slug
        $scope.reviews = null;
        $scope.errorMessage = null;
        $http.get('/reviews/' + slug).then(function(result) {
            $scope.reviews = result.data;
        }, function(error) {
            $scope.errorMessage = 'An error ocurred';
        })
    }
});