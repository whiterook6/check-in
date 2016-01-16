(function(){
	angular.module('Check-in').factory('Version', ['$resource', function($resource){
		var _resource = $resource(
			'/api/versions/:id/:action',
			{
				id: '@id'
			}, {
				update:         { method: 'POST' },   // /api/versions/#
				approve:        { method: 'POST', action: 'approve' }, // /api/versions/#/approve
				reject:         { method: 'POST', action: 'reject' },  // /api/versions/#/reject
			}
		);

		function Version(data){
			angular.extend(this, data);
		}

		Version.prototype = {
			constructor: Version,

			requirements: {},
			comments: {},

			update: function(){
				var self = this;
				var promise = _resource.update(self).$promise;

				promise.then(function(response){
					angular.extend(self, response);

					return self;
				});

				return promise;
			},

			approve: function(){
				var self = this;
				var promise = _resource.approve(self).$promise;

				promise.then(function(response){
					angular.extend(self, response);

					return self;
				});

				return promise;
			},

			reject: function(){
				var self = this;
				var promise = _resource.reject(self).$promise;

				promise.then(function(response){
					angular.extend(self, response);

					return self;
				});

				return promise;
			}
		};

		return Version;
	}]);
})();