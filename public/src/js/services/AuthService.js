(function(){
	angular.module('Check-in').factory('Auth', ['$resource', function($resource){
		var _resource = $resource(
			'/auth/:fn',
			{},
			{
				login:  { method: 'POST', params: { fn: 'login' }}, // /auth/login
				logout: { method: 'POST', params: { fn: 'logout' }}, // /auth/logout
			}
		);

		var auth = {
			_resource: _resource,

			login: function(data){
				return _resource.login(data).$promise;
			},

			logout: function(data){
				return _resource.logout(data).$promise;
			}
		};

		return auth;
	}]);
})();