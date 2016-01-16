(function(){
	angular.module('Check-in').factory('Versions', ['$resource', 'Version', function($resource, Version){
		var _resource = $resource(
			'/api/versions/:id',
			{
				id: '@id'
			}, {
				index:  { method: 'GET', isArray: true }, // /api/versions
				read:   { method: 'GET' },    // /api/versions/#
				update: { method: 'POST' },   // /api/versions/#
				delete: { method: 'DELETE' }, // /api/versions/#
			}
		);

		var versions = {
			_resource: _resource,
			all: {},

			index: function(filter){
				var promise = _resource.index(filter).$promise;
				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var version = new Version(response[i]);
						versions.all[version.id] = version;
					}
				});

				return promise;
			},
			
			read: function(version){
				var promise = _resource.read(version).$promise;
				promise.then(function(response){
					angular.merge(version, response);
					versions.all[version.id] = version;
				});

				return promise;
			},

			delete: function(version){
				var promise = _resource.delete(version).$promise;
				delete versions.all[version.id];

				return promise;
			}
		}

		return versions;
	}]);
})();