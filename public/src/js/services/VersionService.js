(function(){
	angular.module('Check-in').factory('Versions', ['$resource', function($resource){
		var resource = $resource(
			'/api/versions/:id/:model/:action',
			{
				id: '@id'
			}, {
				read: {   method: 'GET' },    // /api/versions/#
				update: { method: 'POST' },   // /api/versions/#
				delete: { method: 'DELETE' }, // /api/versions/#

				comments:       { method: 'GET',  model: 'comments' }, // /api/versions/#/comments
				create_comment: { method: 'POST', model: 'comments' }, // /api/versions/#/comments

				approve: { method: 'POST', action: 'approve' }, // /api/versions/#/approve
				reject: {  method: 'POST', action: 'reject' },  // /api/versions/#/reject
			}
		);

		return resource;
	}]);
})();