(function(){
	angular.module('Check-in').factory('Users', ['$resource', function($resource){
		var _resource = $resource(
			'/api/users/:id/:fn',
			{
				id: '@id'
			}, {
				index: {    method: 'GET', isArray: true },    // /api/users
				create: {   method: 'POST' },   // /api/users
				read: {     method: 'GET' },    // /api/users/#
				update: {   method: 'POST' },   // /api/users/#
				delete: {   method: 'DELETE' }, // /api/users/#

				comments: { method: 'GET', params: { model: 'comments' }, isArray: true }, // /api/users/#/comments
				current: {  method: 'GET', params: { fn: 'current' }} // /api/users/current
			}
		);

		var users = {
			_resource: _resource,
			all: {},

			index: function(){
				var promise = _resource.index().$promise;
				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var user = response[i];
						users.all[user.id] = user;
					}
				});

				return promise;
			},

			create: function(user){
				var promise = _resource.create(users).$promise;
				promise.then(function(response){
					angular.extend(users, response);
					projects.all[users.id] = users;
				});

				return promise;
			},

			read: function(user){
				var promise = _resource.read(user).$promise;
				promise.then(function(response){
					angular.extend(user, response);
					projects.all[user.id] = user;
				});

				return promise;
			},

			update: function(user){
				var promise = _resource.update(user).$promise;
				promise.then(function(response){
					angular.extend(user, response);
					projects.all[user.id] = user;
				});
				return promise;
			},

			delete: function(user){
				var promise = _resource.delete(user).$promise;
				delete projects.all[user.id];
				
				return promise;
			},

			current: function(){
				var promise = _resource.current().$promise;
				promise.then(function(response){
					projects.all[user.id] = response;
				});
				return promise;
			}
		};

		return projects;
	}]);
})();
