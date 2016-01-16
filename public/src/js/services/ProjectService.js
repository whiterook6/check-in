(function(){
	angular.module('Check-in').factory('Projects', ['$resource', 'Project', function($resource, Project){
		var _resource = $resource(
			'/api/projects/:id',
			{
				id: '@id'
			}, {
				index:  { method: 'GET', isArray: true },    // /api/projects
				create: { method: 'POST' },   // /api/projects
				read:   { method: 'GET' },    // /api/projects/#
				delete: { method: 'DELETE' }  // /api/projects/#
			}
		);

		var projects = {
			_resource: _resource,
			all: {},

			index: function(filter){
				var promise = _resource.index(filter).$promise;
				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var project = new Project(response[i]);
						projects.all[project.id] = project;
					}
				});

				return promise;
			},

			create: function(project){
				var promise = _resource.create(project).$promise;
				promise.then(function(response){
					angular.extend(project, response);
					projects.all[project.id] = project;
				});

				return promise;
			},

			read: function(project){
				var promise = _resource.read(project).$promise;
				promise.then(function(response){
					angular.extend(project, response);
					projects.all[project.id] = project;
				});

				return promise;
			},

			delete: function(project){
				var promise = _resource.delete(project).$promise;
				delete projects[project.id];
				
				return promise;
			}
		};

		return projects;
	}]);
})();