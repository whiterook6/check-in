(function(){
	angular.module('Check-in').factory('Design', ['$resource', function($resource){
		var _resource = $resource(
			'/api/designs/:id/:model',
			{
				id: '@id'
			}, {
				versions:       { method: 'GET',  params: { model: 'versions' }, isArray: true }, // /api/designs/#/versions
				create_version: { method: 'POST', params: { model: 'versions' }}, // /api/designs/#/versions

				comments:       { method: 'GET',  params: { model: 'comments' }, isArray: true }, // /api/designs/#/comments
				create_comment: { method: 'POST', params: { model: 'comments' }}, // /api/designs/#/comments

				requirements:       { method: 'GET',  params: { model: 'requirements' }, isArray: true }, // /api/designs/#/requirements
				create_requirement: { method: 'POST', params: { model: 'requirements' }}, // /api/designs/#/requirements
			}
		);

		function Design(data){
			angular.extend(this, data);
		}

		Design.prototype = {
			constructor: Design,

			versions: {},
			requirements: {},
			comments: {},
			
			index_versions: function(){
				var self = this;
				var promise = _resource.versions({
					id: self.id
				}).$promise;

				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var version = response[i];
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
					angular.extend(version, response);
					version.design = self;
					self.versions[version.id] = version;
				});

				return promise;
			}
		};

		return Design;
	}]);
})();