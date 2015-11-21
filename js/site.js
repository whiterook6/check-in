(function(){
	angular
		.module('Check-in', ['ngResource'])
		.factory('Projects', ['$resource', function($resource){
			return $resource('/api/projects/:id', {
				id: '@id'
			}, {
				list: { method: 'GET' },
				create: { method: 'POST' },
				find: { method: 'GET' },
				update: { method: 'POST' },
				delete: { method: 'DELETE' }
			});
		}])
		.factory('Designs', ['$resource', function($resource){
			return $resource('/api/designs/:id', {
				id: '@id'
			}, {
				find: { method: 'GET' },
				update: { method: 'POST' },
				delete: { method: 'DELETE' }
			});
		}])
		.factory('Versions', ['$resource', function($resource){
			return $resource('/api/versions/:id', {
				id: '@id'
			}, {
				find: { method: 'GET' },
				update: { method: 'POST' },
				delete: { method: 'DELETE' }
			});
		}])


		.controller('CheckinController', [function(){
			var ctrl = this;
			
			ctrl.projects = {
				forms: {
					add: {
						visible: false,
						active: false,
						promise: null
					}
				}
			};
		}]);
})();
