techweb.controller('HomeController', ['$scope', '$http', function($scope, $http) {
    var getProject = function() {
        $http({
            method: 'GET',
            url: '/all-project'
        }).then(function(response) {
            $scope.projects = response.data.projects;
            console.log(response.data.projects);
        }, function(response) {
            console.log(response.data);
        });
    };
    getProject();

    $scope.newProject = function () {
        formData = $scope.form;

        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

        $http({
            method: 'POST',
            url: '/post-project',
            data: { 'form' : formData }
        }).then(function(response) {
            console.log(response.data);

        }, function(response) {
            console.log(response.data);
        });

        getProject();
    };
    $scope.toggleFilter = function(item) {
        item.toggle = !item.toggle;
    };

    $scope.searchUser = function(query) {
        $http({
            method: 'POST',
            url: '/search',
            data: {'query' : query }
        }).then(function(response) {
            $scope.autousers = response.data.autousers;
            console.log(response.data.autousers);
        }, function(response) {
            console.log(response.data);
        });
    };

    $scope.addUser = function(user, project) {
        console.log(project);
        $http({
            method: 'POST',
            url: '/add-user-project',
            data: {'user' : user, 'project':project}
        }).then(function(response) {
            console.log(response.data);
        }, function(response) {
            console.log(response.data);
        });
        getProject();
    };
}]);

techweb.controller('ProjectController', ['$scope','$stateParams', '$http', function($scope, $stateParams, $http) {
    projectId = $stateParams.projectId;
    var getCategories = function() {
        $http({
            method: 'POST',
            url: '/find-project-id',
            data: {'projectId' : projectId }
        }).then(function(response) {
            console.log(response.data);

            $scope.project = response.data.project;

        }, function(response) {
            console.log(response.data);
        });
    }
    getCategories();

    $scope.addCategory = function(project) {
        category = $scope.form.category;
        console.log(category);
        $http({
            method: 'POST',
            url: '/add-category',
            data: {'projectId' : projectId, 'category': category }
        }).then(function(response) {
            console.log(response.data);

            $scope.project = response.data.project;

        }, function(response) {
            console.log(response.data);
        });
        getCategories();

    }

    $scope.addTask = function(task, categoryId) {
        console.log(categoryId);
        $http({
            method: 'POST',
            url: '/add-task',
            data: {'categoryId': categoryId, 'task':task }
        }).then(function(response) {
            console.log(response.data);

            $scope.project = response.data.project;

        }, function(response) {
            console.log(response.data);
        });
        getCategories();

    }
}]);