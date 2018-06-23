app.controller('RequestReviewController', function($scope, $http) {
    $scope.slugs = {!! $slugs !!};
    $scope.slugIndex = -1;
    $scope.intervalTime = {!! $intervalTime !!};
    $scope.tmpIntervalTime = {!! $intervalTime !!};
    $scope.isEditingTime = false;
    $scope.isSaving = false;

    $scope.getScores = function() {
        if ($scope.slugIndex == $scope.slugs.length - 1) {
            $scope.slugIndex = -1;
            $scope.setRequestInterval();
            return;
        }

        var slug = $scope.slugs[++($scope.slugIndex)];
        $http.get('/download/store-reviews/' + slug).then($scope.getScores, $scope.getScores)
    }

    $scope.openChangeTime = function() {
        $scope.tmpIntervalTime = $scope.intervalTime;
        $scope.isEditingTime = true;
    }

    $scope.saveIntervalTime = function() {
        if (!$scope.tmpIntervalTime) {
            return alert('You must inform a time in minutes')
        }

        var trimmedValue = $scope.tmpIntervalTime.toString();
        var value = trimmedValue.replace(/[^0-9]/g, '')
        console.log(trimmedValue, value)
        if (trimmedValue == '' || value != trimmedValue) {
            return alert('Wrong value')
        }

        $scope.isSaving = true;

        $http.post('/download/configure-time-interval', { minutes: value }).then(function(response) {
            $scope.isSaving = false;
            $scope.isEditingTime = false;
            $scope.tmpIntervalTime = parseInt(value);
            $scope.intervalTime = parseInt(value);
        }, function(error) {
            $scope.isSaving = false;
            $scope.isEditingTime = false;
            $scope.tmpIntervalTime = $scope.intervalTime;
            alert('There is an error on update')
        })
    }

    $scope.cancelEditing = function() {
        $scope.isEditingTime = false;
    }

    $scope.setRequestInterval = function() {
        Rx.Observable.timer($scope.intervalTime * 1000 * 60).subscribe($scope.getScores);
    }

    $scope.getScores()
})