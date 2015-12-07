(function(){
	angular.module('Check-in').factory('Projects', ['$resource', function($resource){
		var _resource = $resource(
			'/api/projects/:id/:model',
			{
				id: '@id'
			}, {
				index: {          method: 'GET', isArray: true },    // /api/projects
				create: {         method: 'POST' },   // /api/projects
				read: {           method: 'GET' },    // /api/projects/#
				update: {         method: 'POST' },   // /api/projects/#
				delete: {         method: 'DELETE' }, // /api/projects/#

				designs:       { method: 'GET',  model: 'designs', isArray: true }, // /api/projects/#/designs
				create_design: { method: 'POST', model: 'designs' }, // /api/projects/#/designs

				comments:       { method: 'GET',  model: 'comments', isArray: true }, // /api/projects/#/comments
				create_comment: { method: 'POST', model: 'comments' }, // /api/projects/#/comments

				requirements:       { method: 'GET',  model: 'requirements', isArray: true }, // /api/projects/#/requirements
				create_requirement: { method: 'POST', model: 'requirements' }, // /api/projects/#/requirements
			}
		);

		var projects = {
			_resource: _resource,
			all: {},

			index: function(){
				var promise = _resource.index().$promise;
				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var project = response[i];
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

			update: function(project){
				var promise = _resource.update(project).$promise;
				promise.then(function(response){
					angular.extend(project, response);
					projects.all[project.id] = project;
				});
				return promise;
			},

			delete: function(project){
				var promise = _resource.delete(project).$promise;
				delete projects.all[project.id];
				
				return promise;
			}
		};

		projects.index();
		return projects;
	}]);
})();