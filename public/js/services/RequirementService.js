(function(){
	angular.module('Check-in').factory('Requirements', ['$resource', function($resource){
		var resource = $resource(
			'/api/requirements/:id',
			{
				id: '@id'
			}, {
				read: {   method: 'GET' },    // /api/requirements/#
				update: { method: 'POST' },   // /api/requirements/#
				delete: { method: 'DELETE' }, // /api/requirements/#
			}
		);

		return resource;
	}]);
})();