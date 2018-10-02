var app = angular.module('formExample', []);

app.controller("formCtrl", ['$scope', '$http', function ($scope, $http) {
        $scope.url = 'contact.php';
        $scope.formsubmit = function (isValid) {

            if (isValid) {

                $http.post($scope.url, {"name": $scope.name, "email": $scope.email, "message": $scope.message}).
                        success(function (data, status) {
                            $scope.status = status;
                            $scope.data = data;
                            $scope.result = data; // Show result from server in our <pre></pre> element
                        })
            } else {
                alert('Form is not valid');
            }

        }

    }]);