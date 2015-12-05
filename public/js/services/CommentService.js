(function(){
	angular.module('Check-in').factory('Comments', ['$resource', function($resource){
		var resource = $resource(
			'/api/comments/:id',
			{
				id: '@id'
			}, {
				read: {   method: 'GET' },    // /api/comments/#
				update: { method: 'POST' },   // /api/comments/#
				delete: { method: 'DELETE' }, // /api/comments/#
			}
		);

		return resource;
	}]);
})();