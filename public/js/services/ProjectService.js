(function(){
	angular.module('Check-in').factory('Projects', ['$resource', function($resource){
		var resource = $resource(
			'/api/projects/:id/:model',
			{
				id: '@id'
			}, {
				index: {          method: 'GET' },    // /api/projects
				create: {         method: 'POST' },   // /api/projects
				read: {           method: 'GET' },    // /api/projects/#
				update: {         method: 'POST' },   // /api/projects/#
				delete: {         method: 'DELETE' }, // /api/projects/#

				designs:       { method: 'GET',  model: 'designs' }, // /api/projects/#/designs
				create_design: { method: 'POST', model: 'designs' }, // /api/projects/#/designs

				comments:       { method: 'GET',  model: 'comments' }, // /api/projects/#/comments
				create_comment: { method: 'POST', model: 'comments' }, // /api/projects/#/comments

				requirements:       { method: 'GET',  model: 'requirements'}, // /api/projects/#/requirements
				create_requirement: { method: 'POST', model: 'requirements'}, // /api/projects/#/requirements
			}
		);

		resource.save = function(project){
			if (project.id){
				return this.update(project);
			} else{
				return this.create(project);
			}
		};

		return resource;
	}]);
})();