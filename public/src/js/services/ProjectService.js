(function(){
	angular.module('Check-in').factory('Projects', ['ProjectResource', 'DesignResource', 'Project', function(ProjectResource, DesignResource, Project){
		var projects = {
			all: {},

			index: function(){
				var promise = ProjectResource.index().$promise;
				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var project = new Project(response[i]);
						projects.all[project.id] = project;
					}
				});

				return promise;
			},

			create: function(name, description){
				var promise = ProjectResource.create({
					name: name,
					description: description
				}).$promise;

				promise.then(function(response){
					projects.all[response.id] = new Project(response);
				});

				return promise;
			},

			read: function(project){
				var promise = ProjectResource.read(project).$promise;
				promise.then(function(response){
					angular.extend(project, response);
					projects.all[project.id] = project;
				});

				return promise;
			},

			update: function(project){
				return ProjectResource.update(project).$promise;
			},

			delete: function(project){
				var promise = ProjectResource.delete(project).$promise;

				promise.then(function(response){
					delete projects.all[project.id];
				});

				return promise;
			}
		};

		projects.index();
		return projects;
	}]);
})();