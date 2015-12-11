(function(){
	angular.module('Check-in').factory('ProjectResource', ['$resource', function($resource){
		return $resource(
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
	}]);
})();