angular.module("sampleApp", [])
    .controller("sampleController", ["$scope",
    function($scope) {
        $scope.currentName = "";
        $scope.fullNames = [
            {name: "Аистов Кирилл Константинович"},
            {name: "Воротников Алексей Сергеевич"},
            {name: "Гордеева Ангелина Сергеевна"}
        ];

    }
]);