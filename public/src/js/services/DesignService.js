(function(){
	angular.module('Check-in').factory('Designs', ['$resource', function($resource){
		var _resource = $resource(
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

		var designs = {
			_resource: _resource,
			all: {},
			
			read: function(design){
				var promise = _resource.read(design).$promise;
				promise.then(function(response){
					angular.merge(design, response);
					designs.all[design.id] = design;
				});

				return promise;
			},

			update: function(design){
				var promise = _resource.update(design).$promise;
				promise.then(function(response){

				});

				return promise;
			},

			delete: function(design){
				var promise = _resource.delete(design).$promise;
				delete designs.all[design.id];

				return promise;
			}
		};
		return resource;
	}]);
})();