(function(){
	angular.module('Check-in').factory('Designs', ['$resource', function($resource){
		var resource = $resource(
			'/api/designs/:id/:model',
			{
				id: '@id'
			}, {
				read:   { method: 'GET' },    // /api/designs/#
				update: { method: 'POST' },   // /api/designs/#
				delete: { method: 'DELETE' }, // /api/designs/#

				versions:       { method: 'GET',  model: 'versions' }, // /api/designs/#/versions
				// create_version: { method: 'POST', model: 'versions' }, NOTE: no create version yet. Still need to figure out file uploading first.

				comments:       { method: 'GET',  model: 'comments' }, // /api/designs/#/comments
				create_comment: { method: 'POST', model: 'comments' }, // /api/designs/#/comments

				requirements:       { method: 'GET',  model: 'requirements'}, // /api/designs/#/requirements
				create_requirement: { method: 'POST', model: 'requirements'}, // /api/designs/#/requirements
			}
		);

		return resource;
	}]);
})();