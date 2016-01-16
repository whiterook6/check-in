(function(){
	angular.module('Check-in').factory('Design', ['$resource', 'Version', function($resource, Version){
		var _resource = $resource(
			'/api/designs/:id/:model',
			{
				id: '@id'
			}, {
				update:         { method: 'POST' },   // /api/designs/#
				versions:       { method: 'GET',  params: { model: 'versions' }, isArray: true }, // /api/designs/#/versions
				create_version: { method: 'POST', params: { model: 'versions' }}, // /api/designs/#/versions
			}
		);

		function Design(data){
			angular.extend(this, data);
		}

		Design.prototype = {
			constructor: Design,
			versions: {},

			update: function(){
				var self = this;
				var promise = _resource.update(self).$promise;

				promise.then(function(response){
					angular.extend(self, response);
					return self;
				});

				return promise;
			},
			
			index_versions: function(){
				var self = this;
				var promise = _resource.versions({
					id: self.id
				}).$promise;

				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var version = new Version(response[i]);
						version.design = self;
						self.versions[version.id] = version;
					}
				});

				return promise;
			},

			create_version: function(version){
				var self = this;
				var promise = _resource.create_version(version).$promise;

				promise.then(function(response){
					angular.extend(version, new Version(response));
					version.design = self;
					self.versions[version.id] = version;

					return version;
				});

				return promise;
			}
		};

		return Design;
	}]);
})();