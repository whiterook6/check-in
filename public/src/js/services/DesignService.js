(function(){
	angular.module('Check-in').factory('Designs', ['$resource', 'Design', function($resource, Design){
		var _resource = $resource(
			'/api/designs/:id',
			{
				id: '@id'
			}, {
				index:  { method: 'GET', isArray: true }, // /api/designs
				read:   { method: 'GET' },    // /api/designs/#
				update: { method: 'POST' },   // /api/designs/#
				delete: { method: 'DELETE' }, // /api/designs/#
			}
		);

		var designs = {
			_resource: _resource,
			all: {},

			index: function(filter){
				var promise = _resource.index(filter).$promise;
				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var design = new Design(response[i]);
						designs.all[design.id] = design;
					}
				});

				return promise;
			},
			
			read: function(design){
				var promise = _resource.read(design).$promise;
				promise.then(function(response){
					angular.merge(design, response);
					designs.all[design.id] = design;
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